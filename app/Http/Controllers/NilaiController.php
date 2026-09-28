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
}
