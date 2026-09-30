<?php

namespace Tests\Feature;

use App\Models\DataGuru;
use App\Models\DataSekolah;
use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EraporCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'admin']);
    }

    private function actingAsAdmin()
    {
        return $this->actingAs($this->user);
    }

    /*
    |--------------------------------------------------------------------------
    | DATA SEKOLAH
    |--------------------------------------------------------------------------
    */

    public function test_sekolah_tersimpan_ke_database(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-sekolah.store'), [
                'nama_sekolah' => 'SMK Negeri 1',
                'npsn' => '20202021',
                'kode_pos' => '30123',
                'alamat' => 'Jl. Merdeka',
                'telepon' => '0711-222333',
                'email' => 'sekolah@contoh.sch.id',
                'website' => 'https://contoh.sch.id',
                'kepala_sekolah' => 'Budi, S.Pd.',
                'nip_kepala_sekolah' => '196805121994031005',
            ])
            ->assertRedirect(route('data-sekolah'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('data_sekolah', [
            'nama_sekolah' => 'SMK Negeri 1',
            'npsn' => '20202021',
        ]);
    }

    public function test_sekolah_wajib_punya_nama(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-sekolah.store'), ['nama_sekolah' => ''])
            ->assertSessionHasErrors('nama_sekolah');

        $this->assertDatabaseCount('data_sekolah', 0);
    }

    public function test_sekolah_bisa_diubah_dan_dihapus(): void
    {
        $sekolah = DataSekolah::create(['nama_sekolah' => 'SMK Lama']);

        $this->actingAsAdmin()
            ->put(route('data-sekolah.update', $sekolah), ['nama_sekolah' => 'SMK Baru'])
            ->assertRedirect(route('data-sekolah'));

        $this->assertDatabaseHas('data_sekolah', ['id' => $sekolah->id, 'nama_sekolah' => 'SMK Baru']);

        $this->actingAsAdmin()
            ->delete(route('data-sekolah.destroy', $sekolah));

        $this->assertDatabaseMissing('data_sekolah', ['id' => $sekolah->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | DATA GURU
    |--------------------------------------------------------------------------
    */

    public function test_guru_tersimpan_ke_database(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-guru.store'), [
                'nip' => '198501012010011001',
                'nama_guru' => 'Budi Santoso, S.Pd.',
                'nik' => '1671000000000001',
                'email' => 'budi@contoh.sch.id',
                'no_telepon' => '081234567890',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '1985-01-01',
                'alamat' => 'Palembang',
            ])
            ->assertRedirect(route('data-guru'));

        $this->assertDatabaseHas('data_guru', [
            'nip' => '198501012010011001',
            'nama_guru' => 'Budi Santoso, S.Pd.',
            'jenis_kelamin' => 'L',
        ]);
    }

    public function test_guru_email_tidak_valid_ditolak(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-guru.store'), [
                'nama_guru' => 'Guru Uji',
                'email' => 'bukan-email',
            ])
            ->assertSessionHasErrors('email');

        $this->assertDatabaseCount('data_guru', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | ROMBEL + ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function test_rombel_dan_anggota_tersimpan(): void
    {
        $sekolah = DataSekolah::create(['nama_sekolah' => 'SMK 1']);
        $guru = DataGuru::create(['nama_guru' => 'Wali']);
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);

        $this->actingAsAdmin()
            ->post(route('rombel.store'), [
                'nama_rombel' => 'XI RPL 1',
                'tingkat' => 'XI',
                'sekolah_id' => $sekolah->id,
                'wali_kelas_id' => $guru->id,
                'siswa_id' => [$siswa->id, ''],
                'tahun_ajaran' => ['2026/2027', ''],
                'semester' => ['Ganjil', ''],
            ])
            ->assertRedirect(route('rombel'));

        $this->assertDatabaseHas('rombel', [
            'nama_rombel' => 'XI RPL 1',
            'tingkat' => 'XI',
            'sekolah_id' => $sekolah->id,
            'wali_kelas_id' => $guru->id,
        ]);

        // Baris kosong harus dilewati
        $this->assertDatabaseCount('anggota_rombel', 1);

        $this->assertDatabaseHas('anggota_rombel', [
            'rombel_id' => Rombel::first()->id,
            'siswa_id' => $siswa->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);
    }

    public function test_rombel_boleh_tanpa_anggota(): void
    {
        $this->actingAsAdmin()
            ->post(route('rombel.store'), ['nama_rombel' => 'X RPL 1'])
            ->assertRedirect(route('rombel'));

        $this->assertDatabaseHas('rombel', ['nama_rombel' => 'X RPL 1']);
        $this->assertDatabaseCount('anggota_rombel', 0);
    }

    public function test_update_rombel_mengganti_anggota(): void
    {
        $rombel = Rombel::create(['nama_rombel' => 'Lama']);
        $siswaLama = DataSiswa::create(['nama_siswa' => 'Lama']);
        $siswaBaru = DataSiswa::create(['nama_siswa' => 'Baru']);

        $rombel->anggota()->create(['siswa_id' => $siswaLama->id]);

        $this->actingAsAdmin()
            ->put(route('rombel.update', $rombel), [
                'nama_rombel' => 'Baru',
                'siswa_id' => [$siswaBaru->id],
                'semester' => ['Ganjil'],
            ])
            ->assertRedirect(route('rombel'));

        $this->assertDatabaseHas('rombel', ['id' => $rombel->id, 'nama_rombel' => 'Baru']);
        $this->assertDatabaseMissing('anggota_rombel', ['rombel_id' => $rombel->id, 'siswa_id' => $siswaLama->id]);
        $this->assertDatabaseHas('anggota_rombel', ['rombel_id' => $rombel->id, 'siswa_id' => $siswaBaru->id]);
    }

    public function test_hapus_rombel_ikut_menghapus_anggota(): void
    {
        $rombel = Rombel::create(['nama_rombel' => 'Dihapus']);
        $rombel->anggota()->create(['siswa_id' => DataSiswa::create(['nama_siswa' => 'S'])->id]);

        $this->actingAsAdmin()->delete(route('rombel.destroy', $rombel));

        $this->assertDatabaseMissing('rombel', ['id' => $rombel->id]);
        $this->assertDatabaseCount('anggota_rombel', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | MATA PELAJARAN + GURU MENGAJAR
    |--------------------------------------------------------------------------
    */

    public function test_mata_pelajaran_dan_guru_mengajar_tersimpan(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Pengampu']);
        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 1']);

        $this->actingAsAdmin()
            ->post(route('mata-pelajaran.store'), [
                'kode_mata_pelajaran' => 'RPL001',
                'nama_mata_pelajaran' => 'Pemrograman Web',
                'kelompok' => 'C',
                'guru_id' => [$guru->id, ''],
                'rombel_id' => [$rombel->id, ''],
                'tahun_ajaran' => ['2026/2027', ''],
                'semester' => ['Ganjil', ''],
            ])
            ->assertRedirect(route('mata-pelajaran'));

        $mapel = MataPelajaran::first();

        $this->assertSame('Pemrograman Web', $mapel->nama_mata_pelajaran);
        $this->assertDatabaseHas('guru_mengajar', [
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);

        $this->assertDatabaseCount('guru_mengajar', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS
    |--------------------------------------------------------------------------
    */

    public function test_wali_kelas_tersimpan(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Wali']);
        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 2']);

        $this->actingAsAdmin()
            ->post(route('wali-kelas.store'), [
                'guru_id' => $guru->id,
                'rombel_id' => $rombel->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ])
            ->assertRedirect(route('wali-kelas'));

        $this->assertDatabaseHas('wali_kelas', [
            'guru_id' => $guru->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);
    }

    public function test_wali_kelas_duplikat_ditolak(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Wali']);
        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 2']);

        $data = [
            'guru_id' => $guru->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ];

        $this->actingAsAdmin()->post(route('wali-kelas.store'), $data);
        $this->actingAsAdmin()->post(route('wali-kelas.store'), $data);

        $this->assertDatabaseCount('wali_kelas', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | NILAI
    |--------------------------------------------------------------------------
    */

    public function test_nilai_siswa_tersimpan(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    $siswa->id => [$mapel->id => 87.5],
                ],
            ])
            ->assertRedirect(route('input-nilai'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('nilai_siswa', [
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => 87.5,
        ]);
    }

    public function test_input_nilai_kosong_diabaikan(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    $siswa->id => [$mapel->id => ''],
                ],
            ]);

        $this->assertDatabaseCount('nilai_siswa', 0);
    }

    public function test_input_nilai_ulang_memperbarui_bukan_menambah(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $payload = [
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => [$siswa->id => [$mapel->id => 80]],
        ];

        $this->actingAsAdmin()->post(route('input-nilai.store'), $payload);

        $payload['nilai'][$siswa->id][$mapel->id] = 95;

        $this->actingAsAdmin()->post(route('input-nilai.store'), $payload);

        $this->assertDatabaseCount('nilai_siswa', 1);
        $this->assertDatabaseHas('nilai_siswa', ['nilai' => 95]);
    }

    public function test_nilai_dibatasi_0_sampai_100(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [$siswa->id => [$mapel->id => 150]],
            ]);

        $this->assertDatabaseHas('nilai_siswa', ['nilai' => 100]);
    }

    public function test_halaman_input_nilai_menampilkan_data_nilai(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad Fauzan']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()->post(route('input-nilai.store'), [
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => [$siswa->id => [$mapel->id => 88]],
        ]);

        $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->assertSee('Ahmad Fauzan')
            ->assertSee('Matematika')
            ->assertSee('name="nilai['.$siswa->id.']['.$mapel->id.']"', false)
            ->assertSee('value="88"', false);
    }

    public function test_tiap_baris_siswa_punya_tombol_tambah_nilai(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad Fauzan']);

        $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->assertSee('Tambah Nilai')
            ->assertSee('tambahNilaiBaris(this)', false)
            ->assertSee('data-siswa="' . $siswa->id . '"', false)
            ->assertSee('daftar-nilai-' . $siswa->id, false);
    }

    public function test_tambah_nilai_menyimpan_nilai_mata_pelajaran_baru(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapelA = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);
        $mapelB = MataPelajaran::create(['nama_mata_pelajaran' => 'Basis Data']);

        // Baris tambahan meniru format nilai biasa: nilai[siswa][mapel]
        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    $siswa->id => [
                        $mapelA->id => 80,
                        $mapelB->id => 93, //mapel dari baris tambahan
                    ],
                ],
            ])
            ->assertRedirect(route('input-nilai'));

        $this->assertDatabaseCount('nilai_siswa', 2);
        $this->assertDatabaseHas('nilai_siswa', [
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapelB->id,
            'nilai' => 93,
        ]);
    }

    public function test_mapel_tidak_dikenal_akan_dilewati(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    $siswa->id => [
                        $mapel->id => 70,
                        999999 => 100, // id mapel palsu
                    ],
                ],
            ]);

        $this->assertDatabaseCount('nilai_siswa', 1);
        $this->assertDatabaseHas('nilai_siswa', ['nilai' => 70]);
    }

    public function test_siswa_tidak_dikenal_akan_dilewati(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Ahmad']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [
                    999999 => [$mapel->id => 90],
                    $siswa->id => [$mapel->id => 85],
                ],
            ]);

        $this->assertDatabaseCount('nilai_siswa', 1);
        $this->assertDatabaseHas('nilai_siswa', ['siswa_id' => $siswa->id, 'nilai' => 85]);
    }

    public function test_daftar_mapel_tersedia_dikirim_ke_javascript(): void
    {
        DataSiswa::create(['nama_siswa' => 'Siswa Punya Mapel']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Basis Data']);

        $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->assertSee('pilihanMapel', false)
            ->assertSee('"' . $mapel->id . '":"Basis Data"', false);
    }

    public function test_mapel_yang_sudah_dinilai_tidak_ditawarkan(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Uji']);
        $sudahDinilai = MataPelajaran::create(['nama_mata_pelajaran' => 'Sudah Dinilai']);
        $belumDinilai = MataPelajaran::create(['nama_mata_pelajaran' => 'Belum Dinilai']);

        NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $sudahDinilai->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => 90,
        ]);

        $html = $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->getContent();

        $this->assertSame(1, preg_match('/const pilihanMapel = (.*?);\n/s', $html, $cocok));

        $pilihan = json_decode($cocok[1], true);

        $namaDitawarkan = array_values($pilihan[$siswa->id] ?? []);

        $this->assertContains('Belum Dinilai', $namaDitawarkan);
        $this->assertNotContains('Sudah Dinilai', $namaDitawarkan);
    }

    public function test_hapus_nilai_siswa_hanya_pada_periode_terpilih(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Hapus']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Mapel Hapus']);

        $dihapus = NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => 80,
        ]);

        $dipertahankan = NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => $mapel->id,
            'tahun_ajaran' => '2025/2026',
            'semester' => 'Genap',
            'nilai' => 75,
        ]);

        $this->actingAsAdmin()
            ->delete(route('input-nilai.destroy', $siswa->id), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ])
            ->assertRedirect();

        $this->assertDatabaseMissing('nilai_siswa', ['id' => $dihapus->id]);
        $this->assertDatabaseHas('nilai_siswa', ['id' => $dipertahankan->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | AKSES
    |--------------------------------------------------------------------------
    */

    public function test_tsemua_halaman_menampilkan_data_dari_database(): void
    {
        DataSekolah::create(['nama_sekolah' => 'SMK Database']);
        DataGuru::create(['nama_guru' => 'Guru Database']);
        DataSiswa::create(['nama_siswa' => 'Siswa Database']);
        Rombel::create(['nama_rombel' => 'Rombel Database']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Mapel Database']);

        $this->actingAsAdmin()->get(route('data-sekolah'))->assertSee('SMK Database');
        $this->actingAsAdmin()->get(route('data-guru'))->assertSee('Guru Database');
        $this->actingAsAdmin()->get(route('data-siswa'))->assertSee('Siswa Database');
        $this->actingAsAdmin()->get(route('rombel'))->assertSee('Rombel Database');
        $this->actingAsAdmin()->get(route('mata-pelajaran'))->assertSee('Mapel Database');
    }

    public function test_halaman_edit_menampilkan_data_lama(): void
    {
        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 1', 'tingkat' => 'XI']);
        $siswa = DataSiswa::create(['nama_siswa' => 'Anggota Satu']);
        $rombel->anggota()->create(['siswa_id' => $siswa->id, 'semester' => 'Genap']);

        $this->actingAsAdmin()
            ->get(route('rombel.edit', $rombel))
            ->assertOk()
            ->assertSee('value="XI RPL 1"', false)
            ->assertSee('Anggota Satu');
    }
}
