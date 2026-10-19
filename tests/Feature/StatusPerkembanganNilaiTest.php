<?php

namespace Tests\Feature;

use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Status Penilaian dan Perkembangan Nilai harus membaca data yang sama
 * dengan Input Nilai, yaitu tabel nilai_siswa.
 */
class StatusPerkembanganNilaiTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private DataSiswa $siswa;

    private DataSiswa $siswaLain;

    private MataPelajaran $mapel;

    private MataPelajaran $mapelKosong;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 1']);

        $this->siswa = DataSiswa::create([
            'nama_siswa' => 'Andi Pratama',
            'nisn' => '10001',
            'rombel_id' => $rombel->id,
        ]);

        $this->siswaLain = DataSiswa::create([
            'nama_siswa' => 'Bela Putri',
            'nisn' => '10002',
            'rombel_id' => $rombel->id,
        ]);

        $this->mapel = MataPelajaran::create([
            'nama_mata_pelajaran' => 'Matematika',
            'kode_mata_pelajaran' => 'MTK',
        ]);

        $this->mapelKosong = MataPelajaran::create([
            'nama_mata_pelajaran' => 'Bahasa Inggris',
            'kode_mata_pelajaran' => 'BIG',
        ]);
    }

    protected function nilai(
        DataSiswa $siswa,
        MataPelajaran $mapel,
        string $semester,
        float $angka,
        string $tahun = '2026/2027'
    ): void {
        NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapel->id,
            'tahun_ajaran' => $tahun,
            'semester' => $semester,
            'nilai' => $angka,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function test_status_penilaian_menandai_yang_sudah_dan_belum_dinilai(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 85);

        $response = $this->actingAs($this->admin)
            ->get(route('status-penilaian', [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ]));

        $response->assertOk()
            ->assertSee('Andi Pratama')
            ->assertSee('Sudah Dinilai')
            ->assertSee('Belum Dinilai')
            // Matematika sudah dinilai, Bahasa Inggris belum.
            ->assertSeeInOrder(['MTK', 'Sudah Dinilai']);

        // 2 siswa x 2 mapel = 4 baris, hanya 1 yang terisi.
        $this->assertSame(4, count($response->viewData('statusPenilaian')));
        $this->assertSame(1, $response->viewData('sudahDinilai'));
        $this->assertSame(3, $response->viewData('belumDinilai'));
    }

    public function test_status_penilaian_membaca_nilai_periode_terpilih(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 85);
        $this->nilai($this->siswa, $this->mapel, 'Genap', 90);

        // Nilai Genap tidak boleh ikut dihitung saat memfilter semester Ganjil.
        $ganjil = $this->actingAs($this->admin)
            ->get(route('status-penilaian', [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ]));

        $this->assertSame(1, $ganjil->viewData('sudahDinilai'));

        $genap = $this->actingAs($this->admin)
            ->get(route('status-penilaian', [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Genap',
            ]));

        $this->assertSame(1, $genap->viewData('sudahDinilai'));
    }

    public function test_tahun_ajaran_default_diambil_dari_nilai_tersimpan(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Genap', 88, '2025/2026');

        $response = $this->actingAs($this->admin)->get(route('status-penilaian'));

        // Tahun terbaru yang ada nilainya harus langsung terpilih.
        $this->assertSame('2025/2026', $response->viewData('tahunAjaran'));
        $response->assertSee('2025/2026', false);
    }

    public function test_status_penilaian_dapat_difilter_kelas_dan_mapel(): void
    {
        $rombelLain = Rombel::create(['nama_rombel' => 'XII RPL 1']);
        $siswaKelasLain = DataSiswa::create([
            'nama_siswa' => 'Citra Lestari',
            'nisn' => '10003',
            'rombel_id' => $rombelLain->id,
        ]);

        $this->nilai($siswaKelasLain, $this->mapel, 'Ganjil', 77);

        $response = $this->actingAs($this->admin)
            ->get(route('status-penilaian', [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'rombel_id' => $rombelLain->id,
                'filter_mata_pelajaran' => $this->mapel->id,
            ]));

        $response->assertOk()->assertSee('Citra Lestari');

        $baris = $response->viewData('statusPenilaian');

        $this->assertCount(1, $baris);
        $this->assertSame('Sudah Dinilai', $baris[0]->status);
    }

    public function test_pencarian_menyaring_siswa_pada_status_penilaian(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 85);

        $cari = $this->actingAs($this->admin)
            ->get(route('status-penilaian', ['q' => 'Bela']));

        $cari->assertOk()->assertSee('Bela Putri')->assertDontSee('Andi Pratama');
    }

    /*
    |--------------------------------------------------------------------------
    | PERKEMBANGAN NILAI
    |--------------------------------------------------------------------------
    */

    public function test_perkembangan_membandingkan_ganjil_dan_genap(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 80);
        $this->nilai($this->siswa, $this->mapel, 'Genap', 87.5);

        $response = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']));

        $response->assertOk()
            ->assertSee('Andi Pratama')
            ->assertSee('Meningkat')
            ->assertSee('+7.5');

        $baris = $response->viewData('perkembangan');

        $this->assertCount(1, $baris);
        $this->assertSame(80.0, $baris[0]->nilai_ganjil);
        $this->assertSame(87.5, $baris[0]->nilai_genap);
        $this->assertSame(7.5, $baris[0]->selisih);
        $this->assertSame('Meningkat', $baris[0]->status);
    }

    public function test_semua_mata_pelajaran_dan_siswa_muncul_di_perkembangan(): void
    {
        $mapelKetiga = MataPelajaran::create([
            'nama_mata_pelajaran' => 'Basis Data',
            'kode_mata_pelajaran' => 'BSD',
        ]);

        // 2 siswa x 3 mapel, semua punya nilai Ganjil dan Genap.
        foreach ([$this->siswa, $this->siswaLain] as $s) {
            foreach ([$this->mapel, $this->mapelKosong, $mapelKetiga] as $m) {
                $this->nilai($s, $m, 'Ganjil', 80);
                $this->nilai($s, $m, 'Genap', 85);
            }
        }

        $baris = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']))
            ->viewData('perkembangan');

        // Guard supaya satu mapel tidak menimpa mapel lain.
        $this->assertCount(6, $baris);

        $namaMapel = $baris
            ->map(fn ($b) => $b->mataPelajaran->nama_mata_pelajaran)
            ->unique()
            ->sort()
            ->values()
            ->all();

        $this->assertSame(
            ['Bahasa Inggris', 'Basis Data', 'Matematika'],
            $namaMapel
        );

        $this->assertCount(
            2,
            $baris->map(fn ($b) => $b->siswa->id)->unique()
        );
    }

    public function test_perkembangan_menandai_nilai_menurun_dan_tetap(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 90);
        $this->nilai($this->siswa, $this->mapel, 'Genap', 85);
        $this->nilai($this->siswaLain, $this->mapel, 'Ganjil', 70);
        $this->nilai($this->siswaLain, $this->mapel, 'Genap', 70);

        $baris = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']))
            ->viewData('perkembangan');

        $status = $baris->pluck('status')->all();

        $this->assertContains('Menurun', $status);
        $this->assertContains('Tetap', $status);
    }

    public function test_perkembangan_menandai_semester_yang_belum_diisi(): void
    {
        // Hanya nilai Ganjil yang tersimpan.
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 80);

        $baris = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']))
            ->viewData('perkembangan');

        $this->assertCount(1, $baris);
        $this->assertSame(80.0, $baris[0]->nilai_ganjil);
        $this->assertNull($baris[0]->nilai_genap);
        $this->assertNull($baris[0]->selisih);
        $this->assertSame('Belum Lengkap', $baris[0]->status);
    }

    public function test_ringkasan_perkembangan_dihitung_dari_nilai_tersimpan(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 80);
        $this->nilai($this->siswa, $this->mapel, 'Genap', 90);
        $this->nilai($this->siswaLain, $this->mapel, 'Ganjil', 60);

        $response = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']));

        // Rata-rata dari 80, 90, dan 60.
        $this->assertSame(76.67, $response->viewData('rataRata'));
        $this->assertSame(90.0, $response->viewData('nilaiTertinggi'));
        $this->assertSame(60.0, $response->viewData('nilaiTerendah'));
    }

    public function test_perkembangan_tidak_menampilkan_pasangan_yang_kosong(): void
    {
        // mapelKosong tidak punya nilai sama sekali.
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 80);

        $response = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']));

        $response->assertOk();

        $baris = $response->viewData('perkembangan');

        $this->assertCount(1, $baris);
        $this->assertSame(
            'Matematika',
            $baris[0]->mataPelajaran->nama_mata_pelajaran
        );
    }

    public function test_halaman_kosih_tidak_menampilkan_rata_rata_palsu(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']));

        $response->assertOk()->assertSee('Belum ada data perkembangan nilai');

        $this->assertNull($response->viewData('rataRata'));
        $this->assertNull($response->viewData('nilaiTertinggi'));
        $this->assertNull($response->viewData('nilaiTerendah'));
    }

    /*
    |--------------------------------------------------------------------------
    | HUBUNGAN DENGAN INPUT NILAI
    |--------------------------------------------------------------------------
    */

    public function test_nilai_baru_dari_input_nilai_langsung_terlihat(): void
    {
        // Replikasi alur Input Nilai: simpan nilai lewat controller.
        $this->actingAs($this->admin)
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    $this->siswa->id => [$this->mapel->id => 91],
                ],
            ])
            ->assertRedirect();

        $status = $this->actingAs($this->admin)
            ->get(route('status-penilaian', [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'rombel_id' => $this->siswa->rombel_id,
                'filter_mata_pelajaran' => $this->mapel->id,
            ]));

        $this->assertSame(1, $status->viewData('sudahDinilai'));
        $status->assertOk()->assertSee('91');

        // Nilai semester Genap belum ada, jadi belum bisa dihitung perkembangannya.
        $perkembangan = $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai', ['tahun_ajaran' => '2026/2027']))
            ->viewData('perkembangan');

        $this->assertCount(1, $perkembangan);
        $this->assertSame('Belum Lengkap', $perkembangan[0]->status);
    }

    public function test_halaman_penilaian_menampilkan_tahun_dari_nilai_tersimpan(): void
    {
        $this->nilai($this->siswa, $this->mapel, 'Ganjil', 75, '2025/2026');

        // Tahun yang ada datanya harus muncul sebagai pilihan filter.
        $this->actingAs($this->admin)
            ->get(route('perkembangan-nilai'))
            ->assertOk()
            ->assertSee('2025/2026');
    }
}