<?php

namespace Tests\Feature;

use App\Models\DataGuru;
use App\Models\DataSekolah;
use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Rombel;
use App\Models\User;
use App\Services\PembuatanAkun;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
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
    | BANTUAN PENGUJIAN INPUT NILAI
    |--------------------------------------------------------------------------
    |
    | Isi daftar nilai satu siswa diambil dari blok <div id="daftar-nilai-...">
    | supaya nama mata pelajaran dari filter atau pilihan tambah nilai tidak
    | ikut terhitung.
    |
    */

    private function ambilDaftarNilai(string $html, int $siswaId): string
    {
        $pola = '/id="daftar-nilai-' . $siswaId . '"(.*?)<button[^>]*tambahNilaiBaris/s';

        return preg_match($pola, $html, $cocok) ? $cocok[1] : '';
    }

    private function pilihanMapelSiswa(string $html, int $siswaId): array
    {
        preg_match('/const pilihanMapel = (.*?);\n/s', $html, $cocok);

        $pilihan = json_decode($cocok[1] ?? '', true) ?: [];

        return array_values($pilihan[$siswaId] ?? []);
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
    | RELASI DATA SISWA / DATA GURU KE TABEL USERS
    |--------------------------------------------------------------------------
    */

    public function test_tambah_siswa_otomatis_membuat_akun_user(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0098765432',
                'nama_siswa' => 'Ahmad Fauzan',
            ])
            ->assertRedirect(route('data-siswa'));

        $siswa = DataSiswa::firstWhere('nama_siswa', 'Ahmad Fauzan');

        $this->assertNotNull($siswa->user_id);

        $this->assertDatabaseHas('users', [
            'id' => $siswa->user_id,
            'name' => 'Ahmad Fauzan',
            'username' => '0098765432',
            'role' => 'siswa',
        ]);

        // Relasi dari sisi siswa maupun sisi user harus menunjuk baris sama.
        $this->assertTrue($siswa->user->is($siswa->user));
        $this->assertTrue(User::find($siswa->user_id)->siswa->is($siswa));
    }

    public function test_tambah_guru_otomatis_membuat_akun_user(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-guru.store'), [
                'nip' => '198501012010011001',
                'nama_guru' => 'Budi Santoso, S.Pd.',
                'email' => 'budi@contoh.sch.id',
            ])
            ->assertRedirect(route('data-guru'));

        $guru = DataGuru::firstWhere('nip', '198501012010011001');

        $this->assertNotNull($guru->user_id);

        $this->assertDatabaseHas('users', [
            'id' => $guru->user_id,
            'name' => 'Budi Santoso, S.Pd.',
            'username' => '198501012010011001',
            'email' => 'budi@contoh.sch.id',
            'role' => 'guru',
        ]);

        $this->assertTrue(User::find($guru->user_id)->guru->is($guru));
    }

    public function test_password_awal_sistem_langsung_bisa_dipakai_login(): void
    {
        $response = $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0055550001',
                'nama_siswa' => 'Siswa Login',
            ]);

        // Password awal hanya muncul sekali, pada pesan sukses.
        $response->assertSessionHas('status');

        $status = session('status');

        $this->assertMatchesRegularExpression('/Password awal: (\S+)/', $status);

        preg_match('/Password awal: (\S+)/', $status, $cocok);

        $passwordAwal = $cocok[1];

        $this->assertTrue(
            Hash::check($passwordAwal, User::firstWhere('username', '0055550001')->password)
        );

        // Akun hasil pembuatan otomatis harus benar-benar bisa login.
        $this->post('/logout');

        $this->post('/login', [
            'username' => '0055550001',
            'password' => $passwordAwal,
        ])->assertRedirect(route('siswa.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_admin_bisa_menentukan_username_dan_password_saat_menambah_siswa(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0011223344',
                'nama_siswa' => 'Siswa Custom',
                'username' => 'siswa.custom',
                'password' => 'rahasia-siswa',
            ]);

        $user = User::firstWhere('username', 'siswa.custom');

        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('rahasia-siswa', $user->password));

        // Password yang dipilih admin tidak perlu ditampilkan lagi.
        $this->assertStringNotContainsString('Password awal', session('status'));
    }

    public function test_username_ganda_ditambahkan_akhiran_otomatis(): void
    {
        User::factory()->create(['username' => '0098765432']);

        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0098765432',
                'nama_siswa' => 'Siswa NISN Sama',
            ]);

        $this->assertDatabaseHas('users', [
            'username' => '0098765432-2',
            'role' => 'siswa',
        ]);
    }

    public function test_siswa_tanpa_nisn_tetap_mendapat_username_dari_nama(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nama_siswa' => 'Budi Santoso',
            ]);

        $this->assertDatabaseHas('users', [
            'username' => 'budi-santoso',
            'role' => 'siswa',
        ]);
    }

    public function test_email_guru_yang_bentrok_tidak_menggagalkan_pembuatan_akun(): void
    {
        User::factory()->create(['email' => 'budi@contoh.sch.id']);

        $this->actingAsAdmin()
            ->post(route('data-guru.store'), [
                'nama_guru' => 'Guru Email Kembar',
                'email' => 'budi@contoh.sch.id',
            ])
            ->assertRedirect(route('data-guru'));

        $guru = DataGuru::firstWhere('nama_guru', 'Guru Email Kembar');

        $this->assertNotNull($guru->user_id);

        // Email users unik, jadi email kembar disimpan kosong.
        $this->assertNull($guru->user->email);
    }

    public function test_gagal_membuat_akun_membatalkan_data_siswa(): void
    {
        // Paksa pembuatan akun meledak untuk memeriksa rollback.
        $this->instance(PembuatanAkun::class, new class extends PembuatanAkun
        {
            public function untukSiswa(DataSiswa $siswa, array $opsi = []): array
            {
                throw new RuntimeException('Gagal membuat akun');
            }
        });

        // Biarkan exception naik ke test supaya bisa diperiksa.
        $this->withoutExceptionHandling();

        try {
            $this->actingAsAdmin()
                ->post(route('data-siswa.store'), ['nama_siswa' => 'Siswa Gagal']);

            $this->fail('Harus melempar exception.');
        } catch (RuntimeException $e) {
            $this->assertSame('Gagal membuat akun', $e->getMessage());
        }

        // Data siswa tidak boleh tertinggal tanpa akun.
        $this->assertDatabaseCount('data_siswa', 0);
    }

    public function test_ubah_nama_siswa_memperbarui_nama_akun(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0077770001',
                'nama_siswa' => 'Nama Lama',
            ]);

        $siswa = DataSiswa::firstWhere('nisn', '0077770001');

        $this->actingAsAdmin()
            ->put(route('data-siswa.update', $siswa), [
                'nisn' => '0077770001',
                'nama_siswa' => 'Nama Baru',
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $siswa->user_id,
            'name' => 'Nama Baru',
        ]);
    }

    public function test_hapus_siswa_ikut_menghapus_akunnya(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0088880001',
                'nama_siswa' => 'Siswa Dihapus',
            ]);

        $siswa = DataSiswa::firstWhere('nisn', '0088880001');
        $userId = $siswa->user_id;

        $this->actingAsAdmin()
            ->delete(route('data-siswa.destroy', $siswa));

        $this->assertDatabaseMissing('data_siswa', ['id' => $siswa->id]);
        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_hapus_guru_ikut_menghapus_akunnya(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-guru.store'), [
                'nip' => '197001012005011001',
                'nama_guru' => 'Guru Dihapus',
            ]);

        $guru = DataGuru::firstWhere('nip', '197001012005011001');
        $userId = $guru->user_id;

        $this->actingAsAdmin()
            ->delete(route('data-guru.destroy', $guru));

        $this->assertDatabaseMissing('data_guru', ['id' => $guru->id]);
        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_hapus_siswa_tanpa_akun_tidak_meneworthy(): void
    {
        // Baris lama yang dibuat sebelum relasi ini ada tidak punya akun.
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Legacy']);

        $this->actingAsAdmin()
            ->delete(route('data-siswa.destroy', $siswa))
            ->assertRedirect(route('data-siswa'));

        $this->assertDatabaseMissing('data_siswa', ['id' => $siswa->id]);
    }

    public function test_halaman_detail_siswa_menampilkan_username_akun(): void
    {
        $this->actingAsAdmin()
            ->post(route('data-siswa.store'), [
                'nisn' => '0044440001',
                'nama_siswa' => 'Siswa Detail',
            ]);

        $siswa = DataSiswa::firstWhere('nisn', '0044440001');

        $this->actingAsAdmin()
            ->get(route('data-siswa.show', $siswa))
            ->assertOk()
            ->assertSee('Akun Login')
            ->assertSee('0044440001');
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

    public function test_mapel_belum_bernilai_tidak_ditampilkan_di_tabel(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Uji Tabel']);
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

        $daftar = $this->ambilDaftarNilai($html, $siswa->id);

        // Hanya mapel yang sudah ada nilainya yang tampil di kolom Nilai
        $this->assertStringContainsString('Sudah Dinilai', $daftar);
        $this->assertStringNotContainsString('Belum Dinilai', $daftar);

        // Mapel kosong tidak punya input nilai
        $this->assertStringContainsString(
            'nilai[' . $siswa->id . '][' . $sudahDinilai->id . ']',
            $daftar
        );

        $this->assertStringNotContainsString(
            'nilai[' . $siswa->id . '][' . $belumDinilai->id . ']',
            $daftar
        );
    }

    public function test_mapel_belum_bernilai_tidak_muncul_di_rincian_detail(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Uji Detail']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Sudah Dinilai']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Belum Dinilai']);

        NilaiSiswa::create([
            'siswa_id' => $siswa->id,
            'mata_pelajaran_id' => 1,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'nilai' => 90,
        ]);

        $html = $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->getContent();

        preg_match('/const rincianNilai = (.*?);\n/s', $html, $cocok);

        $rincian = json_decode($cocok[1] ?? '', true) ?: [];

        $namaMapel = array_column($rincian[$siswa->id]['nilai'] ?? [], 'mapel');

        $this->assertContains('Sudah Dinilai', $namaMapel);
        $this->assertNotContains('Belum Dinilai', $namaMapel);
    }

    public function test_siswa_tanpa_nilai_menampilkan_kosong(): void
    {
        DataSiswa::create(['nama_siswa' => 'Siswa Kosong']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->assertSee('Belum ada nilai.');
    }

    public function test_mapel_ditambahkan_lalu_hilang_dari_pilihan_tambah_nilai(): void
    {
        $siswa = DataSiswa::create(['nama_siswa' => 'Siswa Pilihan']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Basis Data']);

        // Sebelum ada nilai, mapel masih ditawarkan
        $html = $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->getContent();

        $this->assertContains('Basis Data', $this->pilihanMapelSiswa($html, $siswa->id));

        // Baris tambahan memakai format nilai yang sama dengan tabel
        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
                'nilai' => [$siswa->id => [$mapel->id => 77]],
            ])
            ->assertRedirect(route('input-nilai'));

        $html = $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->getContent();

        // Mapel yang sudah dinilai tampil di kolom Nilai
        $this->assertStringContainsString(
            'Basis Data',
            $this->ambilDaftarNilai($html, $siswa->id)
        );

        // Mapel yang sudah dinilai hilang dari pilihan tambah nilai
        $this->assertNotContains('Basis Data', $this->pilihanMapelSiswa($html, $siswa->id));
    }

    public function test_simpan_nilai_tanpa_input_tidak_gagal(): void
    {
        DataSiswa::create(['nama_siswa' => 'Siswa Kosong']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        // Kolom Nilai kosong-kosong, tidak ada input yang ikut terkirim
        $this->actingAsAdmin()
            ->post(route('input-nilai.store'), [
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ])
            ->assertRedirect(route('input-nilai'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('nilai_siswa', 0);
    }

    public function test_mapel_yang_sudah_dipakai_baris_tambahan_disingkirkan(): void
    {
        DataSiswa::create(['nama_siswa' => 'Siswa Baris']);
        MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAsAdmin()
            ->get(route('input-nilai'))
            ->assertOk()
            ->assertSee('mapelTerpakai', false)
            ->assertSee('segarkanPilihanMapel(idSiswa)', false)
            ->assertSee('segarkanPilihanDariInput(this)', false);
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
