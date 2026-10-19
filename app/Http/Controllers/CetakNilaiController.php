<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use App\Models\DataSiswa;
use App\Models\KehadiranSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CetakNilaiController extends Controller
{
    /**
     * Keterangan kehadiran yang dicetak pada dokumen.
     */
    public const KETERANGAN = [
        'izin' => 'Izin',
        'sakit' => 'Sakit',
        'alpa' => 'Alpa',
    ];

    public function index(Request $request): View
    {
        $rombelId = $request->input('rombel_id');
        $mapelId = $request->input('filter_mata_pelajaran');

        $rombel = Rombel::orderBy('nama_rombel')->get();

        $siswa = DataSiswa::with('rombel')
            ->when($rombelId, fn ($q) => $q->where('rombel_id', $rombelId))
            ->orderBy('nama_siswa')
            ->get();

        return view('cetak-nilai.index', [
            'siswa' => $siswa,
            'rombel' => $rombel,
            'mataPelajaran' => MataPelajaran::orderBy('nama_mata_pelajaran')->get(),
            'rombelId' => $rombelId,
            'mapelId' => $mapelId,
            'daftarTahun' => $this->daftarTahun(),
        ]);
    }

    /**
     * Simpan rekap kehadiran izin, sakit, dan alpa.
     */
    public function simpanKehadiran(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => ['required', 'integer', 'exists:data_siswa,id'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
            'izin' => ['nullable', 'integer', 'min:0', 'max:400'],
            'sakit' => ['nullable', 'integer', 'min:0', 'max:400'],
            'alpa' => ['nullable', 'integer', 'min:0', 'max:400'],
        ]);

        KehadiranSiswa::updateOrCreate(
            [
                'siswa_id' => $data['siswa_id'],
                'tahun_ajaran' => $data['tahun_ajaran'],
                'semester' => $data['semester'],
            ],
            [
                'izin' => $data['izin'] ?? 0,
                'sakit' => $data['sakit'] ?? 0,
                'alpa' => $data['alpa'] ?? 0,
            ]
        );

        return redirect()
            ->route('cetak-nilai')
            ->with('status', 'Keterangan izin, sakit, dan alpa berhasil disimpan.');
    }

    /**
     * Dokumen siap cetak, datanya diambil dari nilai_siswa dan
     * kehadiran_siswa supaya sama dengan Input Nilai.
     */
    public function create(Request $request): View
    {
        $data = $request->validate([
            'siswa_id' => ['required', 'integer', 'exists:data_siswa,id'],
            'rombel_id' => ['nullable', 'integer', 'exists:rombel,id'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
            'jenis_cetak' => ['required', 'string', 'max:40'],
            'filter_mata_pelajaran' => ['nullable', 'integer', 'exists:mata_pelajaran,id'],
        ]);

        $siswa = DataSiswa::with('rombel')->findOrFail($data['siswa_id']);

        $daftarNilai = NilaiSiswa::with('mataPelajaran')
            ->where('siswa_id', $siswa->id)
            ->where('tahun_ajaran', $data['tahun_ajaran'])
            ->where('semester', $data['semester'])
            ->when(
                $data['filter_mata_pelajaran'] ?? null,
                fn ($q, $id) => $q->where('mata_pelajaran_id', $id)
            )
            ->orderBy('mata_pelajaran_id')
            ->get()
            ->sortBy(fn ($n) => $n->mataPelajaran?->nama_mata_pelajaran ?? '')
            ->values();

        $kehadiran = KehadiranSiswa::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran', $data['tahun_ajaran'])
            ->where('semester', $data['semester'])
            ->first();

        $mapelTerpilih = isset($data['filter_mata_pelajaran'])
            ? MataPelajaran::find($data['filter_mata_pelajaran'])
            : null;

        return view('cetak-nilai.create', [
            'siswa' => $siswa,
            'rombel' => $siswa->rombel,
            'tahunAjaran' => $data['tahun_ajaran'],
            'semester' => $data['semester'],
            'jenisCetak' => $data['jenis_cetak'],
            'filterMapel' => $mapelTerpilih,
            'daftarNilai' => $daftarNilai,
            'kehadiran' => $kehadiran,
            'sekolah' => DataSekolah::orderBy('id')->first(),
        ]);
    }

    protected function daftarTahun(): array
    {
        $tahun = NilaiSiswa::query()
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran')
            ->filter()
            ->values();

        return $tahun
            ->merge(['2026/2027', '2025/2026'])
            ->unique()
            ->values()
            ->all();
    }
}