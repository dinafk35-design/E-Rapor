<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatusPenilaianController extends Controller
{
    /**
     * Status penilaian berarti "sudah ada nilainya atau belum" untuk setiap
     * pasangan siswa + mata pelajaran pada satu periode.
     */
    public const SUDAH = 'Sudah Dinilai';

    public const BELUM = 'Belum Dinilai';

    public function index(Request $request): View
    {
        $daftarTahun = $this->daftarTahun();

        // Tanpa filter, tampilkan periode terakhir yang datanya sudah tersimpan
        // supaya halaman langsung mencerminkan nilai yang baru diisi di Input Nilai.
        $tahunAjaran = $request->input('tahun_ajaran') ?: ($daftarTahun[0] ?? '2026/2027');
        $semester = $request->input('semester') ?: 'Ganjil';
        $rombelId = $request->input('rombel_id');
        $mapelId = $request->input('filter_mata_pelajaran');
        $cari = trim((string) $request->input('q', ''));

        $siswa = DataSiswa::with('rombel')
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($inner) use ($cari) {
                    $inner->where('nama_siswa', 'like', '%' . $cari . '%')
                        ->orWhere('nisn', 'like', '%' . $cari . '%');
                });
            })
            ->when($rombelId, fn ($q) => $q->where('rombel_id', $rombelId))
            ->orderBy('nama_siswa')
            ->get();

        $mataPelajaran = MataPelajaran::orderBy('nama_mata_pelajaran')
            ->when($mapelId, fn ($q) => $q->where('id', $mapelId))
            ->get();

        // Nilai periode ini dikunci per pasangan siswa + mapel, sama seperti
        // cara Input Nilai menyusun nilainya.
        $terisi = NilaiSiswa::where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->get(['siswa_id', 'mata_pelajaran_id', 'nilai'])
            ->mapWithKeys(fn ($n) => [$n->siswa_id . '-' . $n->mata_pelajaran_id => $n->nilai])
            ->all();

        $statusPenilaian = [];
        $sudahDinilai = 0;
        $belumDinilai = 0;

        foreach ($siswa as $s) {

            foreach ($mataPelajaran as $m) {

                $nilai = $terisi[$s->id . '-' . $m->id] ?? null;
                $sudah = $nilai !== null;

                $sudahDinilai += $sudah ? 1 : 0;
                $belumDinilai += $sudah ? 0 : 1;

                $statusPenilaian[] = (object) [
                    'siswa_id' => $s->id,
                    'mata_pelajaran_id' => $m->id,
                    'tahun_ajaran' => $tahunAjaran,
                    'semester' => $semester,
                    'nilai' => $nilai,
                    'status' => $sudah ? self::SUDAH : self::BELUM,
                    'siswa' => $s,
                    'mataPelajaran' => $m,
                ];
            }
        }

        return view('status-penilaian', [
            'statusPenilaian' => $statusPenilaian,
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
            'mataPelajaran' => MataPelajaran::orderBy('nama_mata_pelajaran')->get(),
            'daftarTahun' => $daftarTahun,
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester,
            'rombelId' => $rombelId,
            'mapelId' => $mapelId,
            'sudahDinilai' => $sudahDinilai,
            'belumDinilai' => $belumDinilai,
            'totalPenilaian' => count($statusPenilaian),
        ]);
    }

    /**
     * Tahun ajaran yang tersedia, diambil dari nilai yang sudah tersimpan
     * lalu digabung dengan tahun bawaan supaya filter tidak pernah kosong.
     */
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