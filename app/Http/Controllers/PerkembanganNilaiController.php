<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PerkembanganNilaiController extends Controller
{
    /**
     * Urutan semester untuk membandingkan perkembangan nilai.
     */
    protected const SEMESTER = ['Ganjil', 'Genap'];

    public function index(Request $request): View
    {
        $daftarTahun = $this->daftarTahun();

        $tahunAjaran = $request->input('tahun_ajaran') ?: ($daftarTahun[0] ?? '2026/2027');
        $rombelId = $request->input('rombel_id');
        $mapelId = $request->input('filter_mata_pelajaran');
        $cari = trim((string) $request->input('q', ''));

        // Semua nilai tahun ajaran ini dikelompokkan per pasangan siswa + mapel
        // lalu dipisah per semester, supaya perbandingan bisa dihitung.
        $perkembangan = collect();

        foreach ($this->ambilNilai($tahunAjaran) as $siswaId => $perMapel) {

            foreach ($perMapel as $idMapel => $perSemester) {

                $nilai = [
                    'Ganjil' => $this->keFloat($perSemester['Ganjil'] ?? null),
                    'Genap' => $this->keFloat($perSemester['Genap'] ?? null),
                ];

                $selisih = $nilai['Ganjil'] !== null && $nilai['Genap'] !== null
                    ? round($nilai['Genap'] - $nilai['Ganjil'], 2)
                    : null;

                $perkembangan->put(
                    $siswaId . '-' . $idMapel,
                    [
                        'siswa_id' => $siswaId,
                        'mata_pelajaran_id' => $idMapel,
                        'nilai' => $nilai,
                        'selisih' => $selisih,
                        'status' => $this->statusPerkembangan($nilai, $selisih),
                    ]
                );
            }
        }

        $siswa = DataSiswa::with('rombel')
            ->when($rombelId, fn ($q) => $q->where('rombel_id', $rombelId))
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($inner) use ($cari) {
                    $inner->where('nama_siswa', 'like', '%' . $cari . '%')
                        ->orWhere('nisn', 'like', '%' . $cari . '%');
                });
            })
            ->orderBy('nama_siswa')
            ->get()
            ->keyBy('id');

        $mataPelajaran = MataPelajaran::orderBy('nama_mata_pelajaran')
            ->when($mapelId, fn ($q) => $q->where('id', $mapelId))
            ->get()
            ->keyBy('id');

        // Hanya pasangan yang benar-benar punya nilai yang ditampilkan,
        // supaya halaman ini tidak jadi duplikat dari Status Penilaian.
        $baris = $perkembangan
            ->filter(function ($item) use ($siswa, $mataPelajaran) {

                if (! $siswa->has($item['siswa_id'])) {
                    return false;
                }

                return $mataPelajaran->has($item['mata_pelajaran_id']);
            })
            ->map(function ($item) use ($siswa, $mataPelajaran, $tahunAjaran) {

                return (object) [
                    'siswa' => $siswa->get($item['siswa_id']),
                    'mataPelajaran' => $mataPelajaran->get($item['mata_pelajaran_id']),
                    'tahun_ajaran' => $tahunAjaran,
                    'nilai_ganjil' => $item['nilai']['Ganjil'],
                    'nilai_genap' => $item['nilai']['Genap'],
                    'selisih' => $item['selisih'],
                    'status' => $item['status'],
                ];
            })
            ->values();

        $semuaNilai = $baris
            ->flatMap(fn ($b) => [$b->nilai_ganjil, $b->nilai_genap])
            ->filter(fn ($n) => $n !== null)
            ->values();

        return view('perkembangan-nilai', [
            'perkembangan' => $baris,
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
            'mataPelajaran' => MataPelajaran::orderBy('nama_mata_pelajaran')->get(),
            'daftarTahun' => $daftarTahun,
            'daftarSemester' => self::SEMESTER,
            'tahunAjaran' => $tahunAjaran,
            'rombelId' => $rombelId,
            'mapelId' => $mapelId,
            'rataRata' => $semuaNilai->isEmpty()
                ? null
                : round($semuaNilai->avg(), 2),
            'nilaiTertinggi' => $semuaNilai->isEmpty() ? null : $semuaNilai->max(),
            'nilaiTerendah' => $semuaNilai->isEmpty() ? null : $semuaNilai->min(),
        ]);
    }

    /**
     * Kelompokkan nilai per siswa, per mata pelajaran, per semester.
     *
     * @return Collection<string, Collection<string, array<string, float|null>>>
     */
    protected function ambilNilai(string $tahunAjaran): Collection
    {
        return NilaiSiswa::where('tahun_ajaran', $tahunAjaran)
            ->whereNotNull('nilai')
            ->orderBy('semester')
            ->get(['siswa_id', 'mata_pelajaran_id', 'semester', 'nilai'])
            ->groupBy('siswa_id')
            ->map(function ($perSiswa) {

                return $perSiswa
                    ->groupBy('mata_pelajaran_id')
                    ->map(function ($perMapel) {

                        return $perMapel
                            ->keyBy('semester')
                            ->map(fn ($n) => $n->nilai)
                            ->all();
                    });
            });
    }

    /**
     * Status perkembangan dilihat dari selisih antara semester ganjil dan genap.
     */
    protected function statusPerkembangan(array $nilai, ?float $selisih): string
    {
        if ($nilai['Ganjil'] === null && $nilai['Genap'] === null) {
            return 'Belum Dinilai';
        }

        if ($nilai['Genap'] === null) {
            return 'Belum Lengkap';
        }

        if ($nilai['Ganjil'] === null) {
            return 'Baru Ada';
        }

        return match (true) {
            $selisih > 0 => 'Meningkat',
            $selisih < 0 => 'Menurun',
            default => 'Tetap',
        };
    }

    protected function keFloat($nilai): ?float
    {
        return $nilai === null ? null : (float) $nilai;
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