<?php

namespace Tests\Feature;

use App\Models\DataGuru;
use App\Models\GuruMengajar;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Alur pemilihan guru pada form tambah data mata pelajaran, serta sistem tambah
 * guru dari halaman edit ketika mata pelajaran belum punya pengajar.
 * dari halaman edit ketika mata pelajaran belum punya pengajar.
 * dari halaman edit ketika mata pelajaran belum punya pengajar.
 */
class GuruMataPelajaranTest extends TestCase
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
    | TAMBAH DATA MATA PELAJARAN + PILIH GURU
    |--------------------------------------------------------------------------
    */

    public function test_halaman_tambah_menampilkan_pilihan_guru_dan_rombel(): void
    {
        DataGuru::create(['nama_guru' => 'Guru Satu']);
        Rombel::create(['nama_rombel' => 'XI RPL 1']);

        $this->actingAs($this->admin)
            ->get(route('mata-pelajaran.create'))
            ->assertOk()
            ->assertSee('Guru Satu')
            ->assertSee('XI RPL 1')
            ->assertSee('Tambah Guru');
    }

    public function test_guru_dipilih_saat_tambah_mata_pelajaran_tersimpan(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Satu']);
        $rombel = Rombel::create(['nama_rombel' => 'XI RPL 1']);

        $this->actingAs($this->admin)
            ->post(route('mata-pelajaran.store'), [
                'nama_mata_pelajaran' => 'Pemrograman Web',
                'guru_id' => [$guru->id],
                'rombel_id' => [$rombel->id],
                'tahun_ajaran' => ['2026/2027'],
                'semester' => ['Ganjil'],
            ])
            ->assertRedirect(route('mata-pelajaran.index'));

        $mapel = MataPelajaran::first();

        $this->assertDatabaseHas('guru_mengajar', [
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);
    }

    public function test_guru_yang_dipilih_tanpa_rombel_ditolak(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Satu']);

        $this->actingAs($this->admin)
            ->post(route('mata-pelajaran.store'), [
                'nama_mata_pelajaran' => 'Pemrograman Web',
                'guru_id' => [$guru->id],
                'rombel_id' => [''],
            ])
            ->assertSessionHasErrors('rombel_id.0');

        $this->assertDatabaseCount('guru_mengajar', 0);
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH GURU DARI HALAMAN EDIT
    |--------------------------------------------------------------------------
    */

    public function test_halaman_edit_menampilkan_tombol_tambah_guru_saat_kosong(): void
    {
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAs($this->admin)
            ->get(route('mata-pelajaran.edit', $mapel))
            ->assertOk()
            ->assertSee('Belum ada guru yang mengajar')
            ->assertSee('Tambah Guru Sekarang')
            ->assertSee(route('mata-pelajaran.guru.store', $mapel), false);
    }

    public function test_guru_bisa_ditambahkan_dari_halaman_edit(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Baru']);
        $rombel = Rombel::create(['nama_rombel' => 'X IPA 2']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAs($this->admin)
            ->post(route('mata-pelajaran.guru.store', $mapel), [
                'guru_id' => $guru->id,
                'rombel_id' => $rombel->id,
                'tahun_ajaran' => '2026/2027',
                'semester' => 'Ganjil',
            ])
            ->assertRedirect(route('mata-pelajaran.edit', $mapel))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('guru_mengajar', [
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
        ]);
    }

    public function test_tambah_guru_tanpa_guru_ditolak(): void
    {
        $rombel = Rombel::create(['nama_rombel' => 'X IPA 2']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $this->actingAs($this->admin)
            ->post(route('mata-pelajaran.guru.store', $mapel), [
                'guru_id' => '',
                'rombel_id' => $rombel->id,
            ])
            ->assertSessionHasErrors('guru_id');

        $this->assertDatabaseCount('guru_mengajar', 0);
    }

    public function test_guru_duplikat_ditolak_dengan_pesan(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Baru']);
        $rombel = Rombel::create(['nama_rombel' => 'X IPA 2']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        $payload = [
            'guru_id' => $guru->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ];

        $this->actingAs($this->admin)->post(route('mata-pelajaran.guru.store', $mapel), $payload);

        $this->actingAs($this->admin)
            ->post(route('mata-pelajaran.guru.store', $mapel), $payload)
            ->assertSessionHasErrors('guru_id');

        $this->assertDatabaseCount('guru_mengajar', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT MATA PELAJARAN TIDAK BOLEH MENGHAPUS GURU
    |--------------------------------------------------------------------------
    */

    public function test_update_mata_pelajaran_tidak_menghapus_guru_yang_mengajar(): void
    {
        $guru = DataGuru::create(['nama_guru' => 'Guru Tetap']);
        $rombel = Rombel::create(['nama_rombel' => 'X IPA 2']);
        $mapel = MataPelajaran::create(['nama_mata_pelajaran' => 'Matematika']);

        GuruMengajar::create([
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $mapel->id,
            'rombel_id' => $rombel->id,
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
        ]);

        $this->actingAs($this->admin)
            ->put(route('mata-pelajaran.update', $mapel), [
                'nama_mata_pelajaran' => 'Matematika Dasar',
            ])
            ->assertRedirect(route('mata-pelajaran.index'));

        $this->assertDatabaseHas('mata_pelajaran', ['nama_mata_pelajaran' => 'Matematika Dasar']);
        $this->assertDatabaseCount('guru_mengajar', 1);
    }
}
