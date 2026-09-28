<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BackupTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        $folder = storage_path('app/backups');

        if (File::isDirectory($folder)) {
            File::delete(File::files($folder));
        }

        parent::tearDown();
    }

    public function test_guest_diarahkan_ke_login(): void
    {
        $this->get(route('backup.index'))->assertRedirect(route('login'));
    }

    public function test_admin_dapat_membuka_halaman_backup(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.index'))
            ->assertOk()
            ->assertSee('Backup &amp; Restore', false)
            ->assertSee('Backup Seluruh Database')
            ->assertSee('Restore Data');
    }

    public function test_halaman_backup_menampilkan_daftar_tabel(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.index'))
            ->assertOk()
            ->assertSee('data_siswa')
            ->assertSee('data_guru')
            ->assertSee('nilai_siswa')
            ->assertSee('users');
    }

    public function test_form_restore_mengandung_field_file(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.index'))
            ->assertOk()
            ->assertSee('name="file_backup"', false)
            ->assertSee(route('backup.restore'), false);
    }

    public function test_backup_database_menghasilkan_file_sql(): void
    {
        User::factory()->create(['username' => 'penguji']);

        $response = $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.download'));

        $response->assertOk();

        $isi = $response->streamedContent()
            ?: $response->getContent();

        // Isi dump minimal harus memuat definisi tabel dan data pengguna

        $this->assertStringContainsString('CREATE TABLE', $isi);
        $this->assertStringContainsString('penguji', $isi);
        $this->assertStringContainsString('INSERT INTO', $isi);
    }

    public function test_ekspor_tabel_menghasilkan_csv(): void
    {
        User::factory()->create(['username' => 'siswa_tes']);

        $response = $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.table', 'users'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

        $csv = $response->getContent();

        $this->assertStringContainsString('"username"', $csv);
        $this->assertStringContainsString('siswa_tes', $csv);
    }

    public function test_ekspor_tabel_di_luar_daftar_ditolak(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.table', 'migrations'))
            ->assertNotFound();
    }

    public function test_ekspor_tabel_kosong_tetap_berhasil(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.table', 'data_siswa'))
            ->assertOk();
    }

    public function test_restore_mengembalikan_data(): void
    {
        $sql = "INSERT INTO data_siswa (nisn, nama_siswa, created_at, updated_at) "
            ."VALUES ('1234567890', 'Ahmad Fauzan', '2026-01-01 00:00:00', '2026-01-01 00:00:00');";

        $response = $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->post(route('backup.restore'), [
                'file_backup' => UploadedFile::fake()->createWithContent('backup.sql', $sql),
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('data_siswa', [
            'nisn' => '1234567890',
            'nama_siswa' => 'Ahmad Fauzan',
        ]);
    }

    public function test_restore_menolak_ekstensi_bukan_sql(): void
    {
        $response = $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->post(route('backup.restore'), [
                'file_backup' => UploadedFile::fake()->create('virus.exe', 10),
            ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('file_backup');
    }

    public function test_restore_wajib_memilih_file(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->post(route('backup.restore'))
            ->assertSessionHasErrors('file_backup');
    }

    public function test_restore_membuat_cadangan_otomatis(): void
    {
        $sql = "INSERT INTO data_guru (nip, nama_guru, created_at, updated_at) "
            ."VALUES ('1985', 'Budi Santoso', '2026-01-01 00:00:00', '2026-01-01 00:00:00');";

        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->post(route('backup.restore'), [
                'file_backup' => UploadedFile::fake()->createWithContent('cadangan.sql', $sql),
            ]);

        $this->assertTrue(
            File::isDirectory(storage_path('app/backups')),
            'Folder backup harus dibuat otomatis.'
        );
    }

    public function test_file_backup_dapat_dihapus(): void
    {
        $folder = storage_path('app/backups');

        File::ensureDirectoryExists($folder);
        File::put($folder . '/erapor-backup-20260101-000000.sql', '-- contoh');

        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->delete(route('backup.destroy', 'erapor-backup-20260101-000000.sql'))
            ->assertRedirect();

        $this->assertFileDoesNotExist($folder . '/erapor-backup-20260101-000000.sql');
    }

    public function test_hapus_file_tidak_boleh_keluar_dari_folder(): void
    {
        $response = $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->delete(route('backup.destroy', '../../../composer.json'));

        // Aman baik berupa redirect (ditolak controller) maupun 404 (ditolak router)

        $this->assertContains(
            $response->getStatusCode(),
            [302, 404],
            'Permintaan traversal harus ditolak.'
        );

        $this->assertFileExists(base_path('composer.json'));
    }

    public function test_halaman_backup_menampilkan_daftar_file_tersimpan(): void
    {
        $folder = storage_path('app/backups');

        File::ensureDirectoryExists($folder);
        File::put($folder . '/erapor-backup-20260101-000000.sql', str_repeat('-- data', 50));

        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get(route('backup.index'))
            ->assertOk()
            ->assertSee('erapor-backup-20260101-000000.sql')
            ->assertSee('File Backup Tersimpan');
    }

    public function test_semua_peran_boleh_membuka_halaman_backup(): void
    {
        foreach (['admin', 'guru', 'siswa'] as $role) {
            $this->actingAs(User::factory()->create(['role' => $role]))
                ->get(route('backup.index'))
                ->assertOk();
        }
    }
}
