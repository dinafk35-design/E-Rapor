<?php

namespace Tests\Feature;

use App\Models\DataGuru;
use App\Models\GuruMengajar;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Aturan penghapusan data guru dan alur resolutionsinya.
 */
class HapusDataGuruTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /*
    |--------------------------------------------------------------------------
    | PEMBLOKIRAN PENGHAPUSAN
    |--------------------------------------------------------------------------
    */

    public function test_guru_yang_masih_mengajar_tidak_bisa_dihapus(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Mengajar']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);
        $rombel = Rombel::create(['nama_rombel' => 'X IPA 1']);

        GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->actingAs($this->admin)
            ->delete(route('data-guru.destroy', $guru))
            ->assertRedirect(route('data-guru.relasi', $guru->id))
            ->assertSessionHasErrors('guru');

        $this->assertDatabaseHas('data_guru', ['id' => $guru->id]);

        // Pesan yang tampil harus bisa dibaca admin, bukan error SQL mentah.
        $pesan = session('errors')->first('guru');
        $this->assertStringContainsString('tidak dapat dihapus', $pesan);
        $this->assertStringContainsString('Mata Pelajaran', $pesan);
    }

    public function test_guru_yang_masih_menjadi_wali_kelas_tidak_bisa_dihapus(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Wali']);

        WaliKelas::create([
            'guru_id' => $guru->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XI TKJ 2'])->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);

        $this->actingAs($this->admin)
            ->delete(route('data-guru.destroy', $guru))
            ->assertRedirect(route('data-guru.relasi', $guru->id))
            ->assertSessionHasErrors('guru');

        $this->assertDatabaseHas('data_guru', ['id' => $guru->id]);
    }

    public function test_guru_tanpa_relasi_tetap_bisa_dihapus(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Bebas']);

        $this->actingAs($this->admin)
            ->delete(route('data-guru.destroy', $guru))
            ->assertRedirect(route('data-guru'))
            ->assertSessionHas('status')
            ->assertSessionMissing('errors');

        $this->assertDatabaseMissing('data_guru', ['id' => $guru->id]);
    }

    public function test_model_melarang_hapus_guru_yang_masih_relasi(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Terpakai']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Fisika']);
        $rombel = Rombel::create(['nama_rombel' => 'XII IPA 1']);

        GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->expectException(\App\Exceptions\DataGuruMasihDipakai::class);

        $guru->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | ALUR LEPAS RELASI
    |--------------------------------------------------------------------------
    */

    public function test_admin_bisa_melepas_relasi_tanpa_menghapus_mata_pelajaran(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Lama']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Sejarah']);
        $rombel = Rombel::create(['nama_rombel' => 'XII IPS 1']);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->actingAs($this->admin)
            ->delete(route('guru-mengajar.destroy', $pengajar))
            ->assertSessionHas('status');

        // Relasi hilang, mata pelajaran tetap ada.
        $this->assertDatabaseMissing('guru_mengajar', ['id' => $pengajar->id]);
        $this->assertDatabaseHas('mata_pelajaran', ['id' => $mapel->id]);
    }

    public function test_guru_bisa_dihapus_setelah_semua_relasi_dilepas(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Sudah Lepas']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Biologi']);
        $rombel = Rombel::create(['nama_rombel' => 'XI IPA 2']);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->actingAs($this->admin)
            ->delete(route('guru-mengajar.destroy', $pengajar));

        $this->actingAs($this->admin)
            ->delete(route('data-guru.destroy', $guru))
            ->assertRedirect(route('data-guru'));

        $this->assertDatabaseMissing('data_guru', ['id' => $guru->id]);
        $this->assertDatabaseHas('mata_pelajaran', ['id' => $mapel->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | ALUR GANTI GURU
    |--------------------------------------------------------------------------
    */

    public function test_ganti_guru_hanya_mengubah_guru_pengajar(): void
    {
        $guruLama = DataGuru::create(['nama_guru' => 'Guru Lama']);
        $guruBaru = DataGuru::create(['nama_guru' => 'Guru Pengganti']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Informatika']);
        $rombel = Rombel::create(['nama_rombel' => 'XII RPL 1']);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guruLama->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);

        $mapelId = $pengajar->mata_pelajaran_id;
        $rombelId = $pengajar->rombel_id;

        $this->actingAs($this->admin)
            ->put(route('guru-mengajar.update', $pengajar), ['guru_id' => $guruBaru->id])
            ->assertRedirect(route('guru-mengajar'))
            ->assertSessionHas('status');

        // Relasi tetap ada, hanya guru pengajarnya yang berubah.
        $this->assertDatabaseHas('guru_mengajar', [
            'id' => $pengajar->id,
            'guru_id' => $guruBaru->id,
            'mata_pelajaran_id' => $mapelId,
            'rombel_id' => $rombelId,
        ]);

        $this->assertDatabaseHas('mata_pelajaran', ['id' => $mapelId]);
    }

    public function test_ganti_guru_menolak_guru_yang_sama(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Tetap']);
        $pengajar = GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => MataPelajaran::create(['nama_mata_pelajaran' => 'PKN'])->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'X IPA 3'])->id,
        ]);

        $this->actingAs($this->admin)
            ->from(route('guru-mengajar.edit', $pengajar))
            ->put(route('guru-mengajar.update', $pengajar), ['guru_id' => $guru->id])
            ->assertRedirect(route('guru-mengajar.edit', $pengajar))
            ->assertSessionHasErrors('guru_id');

        $this->assertDatabaseHas('guru_mengajar', ['guru_id' => $guru->id]);
    }

    public function test_ganti_guru_wajib_memilih_guru_pengganti(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Asli']);
        $pengajar = GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => MataPelajaran::create(['nama_mata_pelajaran' => 'Olahraga'])->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII TKJ 1'])->id,
        ]);

        $this->actingAs($this->admin)
            ->from(route('guru-mengajar.edit', $pengajar))
            ->put(route('guru-mengajar.update', $pengajar), [])
            ->assertSessionHasErrors('guru_id');

        $this->assertDatabaseHas('guru_mengajar', ['guru_id' => $guru->id]);
    }

    public function test_ganti_guru_ditolak_bila_guru_pengganti_sudah_mengajar_penugasan_sama(): void
    {
        $guruLama = DataGuru::create(['nama_guru' => 'Guru Lama']);
        $guruBentrok = DataGuru::create(['nama_guru' => 'Guru Bentrok']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Seni Budaya']);
        $rombel = Rombel::create(['nama_rombel' => 'XII DKV 1']);

        // Periode wajib sama supaya menabrak unique key guru_mengajar_unik.
        GuruMengajar::create([
            'guru_id' => $guruBentrok->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guruLama->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);

        $this->actingAs($this->admin)
            ->from(route('guru-mengajar.edit', $pengajar))
            ->put(route('guru-mengajar.update', $pengajar), ['guru_id' => $guruBentrok->id])
            ->assertRedirect(route('guru-mengajar.edit', $pengajar))
            ->assertSessionHasErrors('guru_id');

        // Penugasan lama tidak berubah.
        $this->assertDatabaseHas('guru_mengajar', [
            'id' => $pengajar->id,
            'guru_id' => $guruLama->id,
        ]);
    }

    public function test_guru_lama_bisa_dihapus_setelah_guru_pengganti_ditetapkan(): void
    {
        $guruLama = DataGuru::create(['nama_guru' => 'Guru Pensiun']);
        $guruBaru = DataGuru::create(['nama_guru' => 'Guru Baru']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);
        $rombel = Rombel::create(['nama_rombel' => 'XII IPA 1']);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guruLama->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->actingAs($this->admin)
            ->put(route('guru-mengajar.update', $pengajar), ['guru_id' => $guruBaru->id]);

        $this->actingAs($this->admin)
            ->delete(route('data-guru.destroy', $guruLama))
            ->assertRedirect(route('data-guru'));

        $this->assertDatabaseMissing('data_guru', ['id' => $guruLama->id]);
        $this->assertDatabaseHas('guru_mengajar', [
            'id' => $pengajar->id,
            'guru_id' => $guruBaru->id,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DATA NILAI SISWA TETAP AMAN
    |--------------------------------------------------------------------------
    */

    public function test_ganti_guru_tidak_mengubah_data_nilai_siswa(): void
    {
        $guruLama = DataGuru::create(['nama_guru' => 'Guru Penilai Lama']);
        $guruBaru = DataGuru::create(['nama_guru' => 'Guru Penilai Baru']);
        $siswa = \App\Models\DataSiswa::create(['nama_siswa' => 'Siswa Satu']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $nilai = NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapel->id,
            'guru_id' => $guruLama->id,
            'nilai' => 87.50,
        ]);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guruLama->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII IPA 2'])->id,
        ]);

        $this->actingAs($this->admin)
            ->put(route('guru-mengajar.update', $pengajar), ['guru_id' => $guruBaru->id]);

        // Nilai siswa tetap utuh, tidak tersentuh sama sekali.
        $this->assertDatabaseHas('nilai_siswa', [
            'id' => $nilai->id,
            'nilai' => 87.50,
            'mata_pelajaran_id' => $mapel->id,
            'siswa_id' => $siswa->id,
        ]);
    }

    public function test_edit_guru_tidak_mengubah_relasi_dan_nilai(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Asli', 'nip' => '198001012005011001']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Ekonomi']);
        $pengajar = GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XI AKL 1'])->id,
        ]);

        $this->actingAs($this->admin)
            ->put(route('data-guru.update', $guru), [
                'nama_guru' => 'Guru Nama Baru',
                'nip' => '198001012005011001',
            ])
            ->assertRedirect(route('data-guru'));

        $this->assertDatabaseHas('data_guru', ['id' => $guru->id, 'nama_guru' => 'Guru Nama Baru']);

        // Relasi guru mengajar tetap menunjuk guru yang sama.
        $this->assertDatabaseHas('guru_mengajar', [
            'id' => $pengajar->id,
            'guru_id' => $guru->id,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILAN HALAMAN
    |--------------------------------------------------------------------------
    */

    public function test_halaman_relasi_menampilkan_mata_pelajaran_yang_masih_diajar(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Pengampu']);
        $mapel = MataPelajaran::create([
            'kode_mata_pelajaran' => 'MTK',
            'nama_mata_pelajaran' => 'Matematika Peminatan',
        ]);

        GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII MIPA 1'])->id,
        ]);

        $this->actingAs($this->admin)
            ->get(route('data-guru.relasi', $guru))
            ->assertOk()
            ->assertSee('Matematika Peminatan')
            ->assertSee('XII MIPA 1')
            ->assertSee('Ganti Guru')
            ->assertSee('Lepas Relasi');
    }

    public function test_halaman_daftar_guru_mengajar_dapat_disaring_per_guru(): void
    {
        $guruA = DataGuru::create(['nama_guru' => 'Guru Alpha']);
        $guruB = DataGuru::create(['nama_guru' => 'Guru Beta']);

        GuruMengajar::create([
            'guru_id' => $guruA->id,
            'mata_pelajaran_id' => MataPelajaran::create(['nama_mata_pelajaran' => 'Geografi'])->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII IPS 2'])->id,
        ]);

        GuruMengajar::create([
            'guru_id' => $guruB->id,
            'mata_pelajaran_id' => MataPelajaran::create(['nama_mata_pelajaran' => 'Antropologi'])->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII IPS 3'])->id,
        ]);

        $this->actingAs($this->admin)
            ->get(route('guru-mengajar', ['guru_id' => $guruA->id]))
            ->assertOk()
            // Difilter: hanya penugasan Guru Alpha.
            ->assertViewHas('pengajar', fn ($pengajar) => $pengajar->count() === 1);

        // Tanpa filter, kedua penugasan muncul.
        $this->actingAs($this->admin)
            ->get(route('guru-mengajar'))
            ->assertOk()
            ->assertViewHas('pengajar', fn ($pengajar) => $pengajar->count() === 2);
    }

    public function test_formulir_ganti_guru_menampilkan_daftar_guru_pengganti(): void
    {
        $guruLama = DataGuru::create(['nama_guru' => 'Guru Lama', 'nip' => '197501012005011002']);
        $guruPengganti = DataGuru::create(['nama_guru' => 'Calon Pengganti', 'nip' => '198901012014011003']);
        $mapel = MataPelajaran::create([
            'kode_mata_pelajaran' => 'PAI',
            'nama_mata_pelajaran' => 'Pendidikan Agama Islam',
        ]);

        $pengajar = GuruMengajar::create([
            'guru_id' => $guruLama->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XI PAI 1'])->id,
        ]);

        $this->actingAs($this->admin)
            ->get(route('guru-mengajar.edit', $pengajar))
            ->assertOk()
            ->assertSee('Pendidikan Agama Islam')
            ->assertSee('Guru Lama')
            // Guru pengganti bisa dipilih.
            ->assertSee('Calon Pengganti')
            ->assertSee('198901012014011003');
    }

    public function test_daftar_guru_menampilkan_jumlah_relasi(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Sibuk']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Kimia']);

        GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => Rombel::create(['nama_rombel' => 'XII IPA 4'])->id,
        ]);

        $this->actingAs($this->admin)
            ->get(route('data-guru'))
            ->assertOk()
            ->assertSee('Guru Sibuk')
            ->assertSee('1 Mapel');
    }
}