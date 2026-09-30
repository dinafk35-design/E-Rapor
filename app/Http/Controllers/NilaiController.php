<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NilaiController extends Controller
{
    /**
     * Data acuan untuk form input nilai.
     */
    public function index(Request $request): View
    {
        $tahunAjaran = $request->input('tahun_ajaran', '2026/2027');
        $semester = $request->input('semester', 'Ganjil');
        $rombelId = $request->input('rombel_id');
        $filterMapel = $request->input('filter_mata_pelajaran');

        $siswa = DataSiswa::with('rombel')
            ->when($rombelId, fn ($q) => $q->where('rombel_id', $rombelId))
            ->orderBy('nama_siswa')
            ->get();

        $mataPelajaran = MataPelajaran::orderBy('nama_mata_pelajaran')
            ->when($filterMapel, fn ($q) => $q->where('id', $filterMapel))
            ->get();

        // Nilai yang sudah tersimpan, dikunci per siswa + mapel
        $tersimpan = NilaiSiswa::where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->get()
            ->mapWithKeys(fn ($n) => [$n->siswa_id . '-' . $n->mata_pelajaran_id => $n->nilai])
            ->all();

        // Mata pelajaran yang belum dinilai, untuk setiap siswa.
        // Mapel yang sudah dinilai tidak ikut offered lagi.
        $semuaMapel = MataPelajaran::orderBy('nama_mata_pelajaran')
            ->pluck('nama_mata_pelajaran', 'id');

        $sudahDinilai = NilaiSiswa::where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->get(['siswa_id', 'mata_pelajaran_id'])
            ->groupBy('siswa_id')
            ->map(fn ($rows) => $rows->pluck('mata_pelajaran_id')->all());

        $pilihanMapel = [];

        foreach ($siswa as $s) {

            // Key dari $semuaMapel adalah id mapel, jadi yang dibandingkan
            // adalah key-nya, bukan nama mapelnya.
            $sudahTerisi = array_map('strval', $sudahDinilai[$s->id] ?? []);

            $pilihanMapel[$s->id] = $semuaMapel
                ->reject(fn ($nama, $id) => in_array((string) $id, $sudahTerisi, true))
                ->all();
        }

        // Rincian nilai per siswa untuk tombol Detail
        $rincianNilai = [];

        foreach ($siswa as $s) {

            $rincianNilai[$s->id] = [
                'nama' => $s->nama_siswa,
                'nisn' => $s->nisn ?? '-',
                'kelas' => $s->rombel?->nama_rombel ?? '-',
                'nilai' => [],
            ];

            foreach ($mataPelajaran as $mapel) {

                $nilai = $tersimpan[$s->id . '-' . $mapel->id] ?? null;

                $rincianNilai[$s->id]['nilai'][$mapel->id] = [
                    'mapel' => $mapel->nama_mata_pelajaran,
                    'nilai' => $nilai === null
                        ? null
                        : rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.'),
                ];
            }
        }

        // Guru pengampu per mata pelajaran (jika ada penugasan)
        $guruPerMapel = DB::table('guru_mengajar')
            ->select('mata_pelajaran_id', 'guru_id')
            ->get()
            ->groupBy('mata_pelajaran_id')
            ->map(fn ($rows) => $rows->pluck('guru_id')->first());

        return view('input-nilai', [
            'siswa' => $siswa,
            'mataPelajaran' => $mataPelajaran,
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester,
            'rombelId' => $rombelId,
            'filterMapel' => $filterMapel,
            'nilaiTersimpan' => $tersimpan,
            'guruPerMapel' => $guruPerMapel,
            'pilihanMapel' => $pilihanMapel,
            'rincianNilai' => $rincianNilai,
        ]);
    }

    /**
     * Simpan nilai siswa.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
            'rombel_id' => ['nullable', 'integer', 'exists:rombel,id'],
            'nilai' => ['required', 'array'],
            'nilai.*' => ['array'],
            'nilai.*.*' => ['nullable', 'numeric'],
        ]);

        // Kunci array tidak bisa divalidasi dengan aturan wildcard,
        // jadi id siswa dan id mata pelajaran dicek langsung.
        $idSiswaValid = DataSiswa::pluck('id')->flip();
        $idMapelValid = MataPelajaran::pluck('id')->flip();

        $tahun = $data['tahun_ajaran'];
        $semester = $data['semester'];
        $tersimpan = 0;

        DB::transaction(function () use ($data, $tahun, $semester, $idSiswaValid, $idMapelValid, &$tersimpan) {

            foreach ($data['nilai'] as $siswaId => $perMapel) {

                // Abaikan siswa yang tidak dikenal
                if (! isset($idSiswaValid[$siswaId])) {
                    continue;
                }

                foreach ((array) $perMapel as $mapelId => $angka) {

                    // Abaikan input kosong dan id mata pelajaran yang tidak valid
                    if ($angka === null || $angka === '' || ! isset($idMapelValid[$mapelId])) {
                        continue;
                    }

                    $nilai = max(0, min(100, round((float) $angka, 2)));

                    $guruId = DB::table('guru_mengajar')
                        ->where('mata_pelajaran_id', $mapelId)
                        ->value('guru_id');

                    // Simpan / perbarui berdasarkan kombinasi unik
                    NilaiSiswa::updateOrCreate(
                        [
                            'siswa_id' => $siswaId,
                            'mata_pelajaran_id' => $mapelId,
                            'tahun_ajaran' => $tahun,
                            'semester' => $semester,
                        ],
                        [
                            'guru_id' => $guruId,
                            'nilai' => $nilai,
                        ]
                    );

                    $tersimpan++;
                }
            }
        });

        return redirect()
            ->route('input-nilai')
            ->with('status', $tersimpan . ' nilai berhasil disimpan.');
    }

    /**
     * Hapus seluruh nilai seorang siswa pada periode yang sedang dibuka.
     */
    public function destroy(Request $request, DataSiswa $siswa): RedirectResponse
    {
        $tahun = $request->input('tahun_ajaran');
        $semester = $request->input('semester');

        $jumlah = NilaiSiswa::where('siswa_id', $siswa->id)
            ->when($tahun, fn ($q) => $q->where('tahun_ajaran', $tahun))
            ->when($semester, fn ($q) => $q->where('semester', $semester))
            ->delete();

        return redirect()
            ->route('input-nilai', array_filter([
                'tahun_ajaran' => $tahun,
                'semester' => $semester,
                'rombel_id' => $request->input('rombel_id'),
            ]))
            ->with('status', $jumlah > 0
                ? $jumlah . ' nilai ' . $siswa->nama_siswa . ' berhasil dihapus.'
                : 'Tidak ada nilai yang dapat dihapus untuk ' . $siswa->nama_siswa . '.');
    }
}
