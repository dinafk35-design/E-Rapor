<?php

namespace Tests\Feature;

use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\KehadiranSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Keterangan izin, sakit, dan alpa pada halaman Cetak Nilai.
 *
 * Data kehadiran disimpan per siswa + periode, lalu dicetak pada bagian
 * Keterangan dokumen.
 */
class CetakNilaiKehadiranTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private DataSiswa $siswa;

    private MataPelajaran $mapel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $wali = DataGuru::create([
            'nama_guru' => 'Budi Santoso, S.Pd',
            'nip' => '198502022010011002',
        ]);

        $rombel = Rombel::create([
            'nama_rombel' => 'XI RPL 1',
            'wali_kelas_id' => $wali->id,
        ]);

        $this->siswa = DataSiswa::create([
            'nama_siswa' => 'Andi Pratama',
            'nisn' => '10001',
            'rombel_id' => $rombel->id,
        ]);

        $this->mapel = MataPelajaran::create([
            'nama_mata_pelajaran' => 'Matematika',
            'kode_mata_pelajaran' => 'MTK',
        ]);
    }

    protected function nilai(string $semester, float $angka, string $tahun = '2026/2027'): void
    {
        NilaiSiswa::create([
            'siswa_id' => $this->siswa->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'tahun_ajaran' => $tahun,
            'semester' => $semester,
            'nilai' => $angka,
        ]);
    }

    protected function urlDokumen(array $tambahan = []): string
    {
        return route('cetak-nilai.create', array_merge([
            'siswa_id' => $this->siswa->id,
            'rombel_id' => $this->siswa->rombel_id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'jenis_cetak' => 'Daftar Nilai',
        ], $tambahan));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CETAK
    |--------------------------------------------------------------------------
    */

    public function test_halaman_cetak_menampilkan_siswa_dari_database(): void
    {
        $this->actingAs($this->admin)
            ->get(route('cetak-nilai'))
            ->assertOk()
            ->assertSee('Andi Pratama')
            ->assertSee('XI RPL 1')
            ->assertSee('Simpan Kehadiran');
    }

    public function test_halaman_cetak_menampilkan_kolom_izin_sakit_alpa(): void
    {
        $this->actingAs($this->admin)
            ->get(route('cetak-nilai'))
            ->assertOk()
            ->assertSee('Keterangan Kehadiran', false)
            ->assertSee('name="izin"', false)
            ->assertSee('name="sakit"', false)
            ->assertSee('name="alpa"', false);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KEHADIRAN
    |--------------------------------------------------------------------------
    */

    public function test_kehadiran_bisa_disimpan(): void
    {
        $this->actingAs($this->admin)
            ->post(route('cetak-nilai.kehadiran.store'), [
                'siswa_id' => $this->siswa->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'izin' => 3,
                'sakit' => 2,
                'alpa' => 1,
            ])
            ->assertRedirect(route('cetak-nilai'));

        $this->assertDatabaseHas('kehadiran_siswa', [
            'siswa_id' => $this->siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'izin' => 3,
            'sakit' => 2,
            'alpa' => 1,
        ]);
    }

    public function test_kolom_kosong_disimpan_sebagai_nol(): void
    {
        $this->actingAs($this->admin)
            ->post(route('cetak-nilai.kehadiran.store'), [
                'siswa_id' => $this->siswa->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ]);

        $this->assertDatabaseHas('kehadiran_siswa', [
            'siswa_id' => $this->siswa->id,
            'izin' => 0,
            'sakit' => 0,
            'alpa' => 0,
        ]);
    }

    public function test_simpan_ulang_memperbarui_bukan_menambah_baris(): void
    {
        $pengguna = $this->actingAs($this->admin);

        foreach ([1, 5] as $izin) {
            $pengguna->post(route('cetak-nilai.kehadiran.store'), [
                'siswa_id' => $this->siswa->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'izin' => $izin,
            ]);
        }

        $this->assertSame(1, KehadiranSiswa::count());

        $this->assertDatabaseHas('kehadiran_siswa', [
            'siswa_id' => $this->siswa->id,
            'izin' => 5,
        ]);
    }

    public function test_kehadiran_terpisah_antar_semester(): void
    {
        $pengguna = $this->actingAs($this->admin);

        $pengguna->post(route('cetak-nilai.kehadiran.store'), [
            'siswa_id' => $this->siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'izin' => 3,
        ]);

        $pengguna->post(route('cetak-nilai.kehadiran.store'), [
            'siswa_id' => $this->siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Genap',
            'alpa' => 2,
        ]);

        $this->assertSame(2, KehadiranSiswa::count());

        $this->assertDatabaseHas('kehadiran_siswa', [
            'semester' => 'Ganjil',
            'izin' => 3,
        ]);

        $this->assertDatabaseHas('kehadiran_siswa', [
            'semester' => 'Genap',
            'alpa' => 2,
        ]);
    }

    public function test_kehadiran_menolak_angka_negatif(): void
    {
        $this->actingAs($this->admin)
            ->post(route('cetak-nilai.kehadiran.store'), [
                'siswa_id' => $this->siswa->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'izin' => -1,
            ])
            ->assertSessionHasErrors('izin');

        $this->assertSame(0, KehadiranSiswa::count());
    }

    /*
    |--------------------------------------------------------------------------
    | DOKUMEN CETAK
    |--------------------------------------------------------------------------
    */

    public function test_dokumen_mencetak_keterangan_kehadiran(): void
    {
        KehadiranSiswa::create([
            'siswa_id' => $this->siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'izin' => 3,
            'sakit' => 2,
            'alpa' => 1,
        ]);

        $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk()
            ->assertSee('Keterangan Kehadiran')
            ->assertSee('Izin')
            ->assertSee('Sakit')
            // Total 3 + 2 + 1.
            ->assertSee('Total tidak hadir:');

        $dokumen = $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk();

        $html = $dokumen->getContent();

        // Angka pada tiap kotak keterangan harus cocok dengan yang disimpan.
        $this->assertSame(1, preg_match_all(
            '#<span class="font-semibold">(\d+)</span>\s*'
            . '<span class="block[^"]*">\s*Izin#s',
            $html,
            $izin
        ));
        $this->assertSame('3', $izin[1][0]);

        $this->assertSame('2', $this->angkaKeterangan($html, 'Sakit'));
        $this->assertSame('1', $this->angkaKeterangan($html, 'Alpa'));

        // Angka pada paragraf catatan harus sama dengan kotak di atas.
        $teks = trim(preg_replace(
            '/\s+/',
            ' ',
            strip_tags($html)
        ));

        $this->assertStringContainsString(
            'siswa izin 3 hari, sakit 2 hari, dan alpa 1 hari',
            $teks
        );

        $this->assertStringContainsString('Total tidak hadir: 6', $teks);
    }

    /**
     * Ambil angka yang tercetak pada kotak keterangan tertentu.
     */
    protected function angkaKeterangan(string $html, string $label): ?string
    {
        preg_match(
            '#<span class="font-semibold">(\d+)</span>\s*'
            . '<span class="block[^"]*">\s*' . $label . '#s',
            $html,
            $cocok
        );

        return $cocok[1] ?? null;
    }

    public function test_dokumen_menampilkan_nol_bila_kehadiran_belum_diinput(): void
    {
        $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk()
            ->assertSee('belum diinput', false);
    }

    public function test_kehadiran_bulan_tertentu_tidak_bocor_ke_semester_lain(): void
    {
        KehadiranSiswa::create([
            'siswa_id' => $this->siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'izin' => 7,
        ]);

        $dokumen = $this->actingAs($this->admin)
            ->get($this->urlDokumen(['semester' => 'Genap']))
            ->assertOk();

        // Rekap Genap belum diisi, jadi angka 7 dari Ganjil tidak boleh ikut.
        $this->assertStringNotContainsString(
            '>7<',
            $dokumen->getContent()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DOKUMEN MEMAKAI DATA ASLI
    |--------------------------------------------------------------------------
    */

    public function test_dokumen_mengambil_nilai_dari_database(): void
    {
        $this->nilai('Ganjil', 88);

        $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk()
            ->assertSee('Andi Pratama')
            ->assertSee('10001')
            ->assertSee('XI RPL 1')
            ->assertSee('Matematika')
            ->assertSee('88');
    }

    public function test_dokumen_bisa_dibatasi_satu_mata_pelajaran(): void
    {
        $lain = MataPelajaran::create([
            'nama_mata_pelajaran' => 'Bahasa Inggris',
            'kode_mata_pelajaran' => 'BIG',
        ]);

        $this->nilai('Ganjil', 88);

        NilaiSiswa::create([
            'siswa_id' => $this->siswa->id,
            'mata_pelajaran_id' => $lain->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => 75,
        ]);

        $dokumen = $this->actingAs($this->admin)
            ->get($this->urlDokumen(['filter_mata_pelajaran' => $this->mapel->id]))
            ->assertOk();

        // Mapel terpilih tampil di identitas dan tabelnya cuma satu baris.
        $dokumen->assertSee('Matematika')->assertDontSee('Bahasa Inggris');
        $this->assertCount(1, $dokumen->viewData('daftarNilai'));
    }

    public function test_dokumen_menampilkan_pesan_saat_nilai_masih_kosong(): void
    {
        // Belum ada nilai sama sekali pada periode ini.
        $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk()
            ->assertSee('Belum ada data nilai pada periode ini.')
            // Tanpa nilai, blok rekap dan catatan nilai ikut disembunyikan.
            ->assertDontSee('Rata-rata')
            ->assertDontSee('Nilai tertinggi adalah');
    }

    public function test_dokumen_menampilkan_wali_kelas_dari_rombel(): void
    {
        $this->actingAs($this->admin)
            ->get($this->urlDokumen())
            ->assertOk()
            ->assertSee('Budi Santoso, S.Pd')
            ->assertSee('198502022010011002');
    }

    public function test_dokumen_menampilkan_judul_berdasarkan_jenis_cetak(): void
    {
        $this->actingAs($this->admin)
            ->get($this->urlDokumen(['jenis_cetak' => 'Rapor Siswa']))
            ->assertOk()
            ->assertSee('RAPOR SISWA');

        $this->actingAs($this->admin)
            ->get($this->urlDokumen(['jenis_cetak' => 'Rekap Nilai']))
            ->assertOk()
            ->assertSee('REKAPITULASI NILAI');
    }

    public function test_dokumen_menolak_siswa_tidak_ada(): void
    {
        $this->actingAs($this->admin)
            ->get(route('cetak-nilai.create', [
                'siswa_id' => 999,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'jenis_cetak' => 'Daftar Nilai',
            ]))
            ->assertSessionHasErrors('siswa_id');
    }

    public function test_halaman_cetak_membutuhkan_login(): void
    {
        $this->get(route('cetak-nilai'))->assertRedirect(route('login'));
    }
}