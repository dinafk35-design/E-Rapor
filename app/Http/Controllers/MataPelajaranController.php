<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\DataSekolah;
use App\Models\GuruMengajar;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MataPelajaranController extends Controller
{
    /**
     * Menampilkan daftar Mata Pelajaran
     */
    public function index(): View
    {
        return view('mata-pelajaran.index', [
            'mataPelajaran' => MataPelajaran::with(['sekolah', 'guruMengajar.guru', 'guruMengajar.rombel'])
                ->withCount('guruMengajar')
                ->orderBy('nama_mata_pelajaran')
                ->get(),

            'sekolahList' => DataSekolah::orderBy('nama_sekolah')->get(),

            'guruList' => DataGuru::orderBy('nama_guru')->get(),
        ]);
    }

    /**
     * Menampilkan form tambah Mata Pelajaran
     */
    public function create(): View
    {
        return view('mata-pelajaran.create', [
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),

            'guru' => DataGuru::orderBy('nama_guru')->get(),

            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    /**
     * Menyimpan Mata Pelajaran baru
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode_mata_pelajaran' => ['nullable', 'string', 'max:50'],

            'nama_mata_pelajaran' => ['required', 'string', 'max:255'],

            'kelompok' => ['nullable', 'string', 'max:50'],

            'sekolah_id' => ['nullable', 'integer', 'exists:data_sekolah,id'],

            'guru_id' => ['nullable', 'array'],

            'guru_id.*' => ['nullable', 'integer', 'exists:data_guru,id'],

            'rombel_id' => ['nullable', 'array'],

            'rombel_id.*' => ['nullable', 'integer', 'exists:rombel,id'],

            'tahun_ajaran' => ['nullable', 'array'],

            'tahun_ajaran.*' => ['nullable', 'string', 'max:20'],

            'semester' => ['nullable', 'array'],

            'semester.*' => ['nullable', 'string', 'max:20'],
        ], $this->pesanValidasiGuru());

        $this->validasiRombelWajib($request);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN MATA PELAJARAN
        |--------------------------------------------------------------------------
        */

        $mataPelajaran = MataPelajaran::create([
            'kode_mata_pelajaran' => $data['kode_mata_pelajaran'] ?? null,

            'nama_mata_pelajaran' => $data['nama_mata_pelajaran'],

            'kelompok' => $data['kelompok'] ?? null,

            'sekolah_id' => $data['sekolah_id'] ?? null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN GURU MENGAJAR
        |--------------------------------------------------------------------------
        */

        $this->simpanGuruMengajar($mataPelajaran, $data);

        return redirect()->route('mata-pelajaran.index')->with('status', 'Data Mata Pelajaran berhasil disimpan.');
    }

    /**
     * Menampilkan form edit Mata Pelajaran
     *
     * Sekaligus mengambil guru yang berelasi
     * dengan Mata Pelajaran tersebut.
     */
    public function edit(MataPelajaran $mataPelajaran): View
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD RELASI
        |--------------------------------------------------------------------------
        |
        | guruMengajar
        |      ↓
        |    guru
        |
        */

        $mataPelajaran->load(['sekolah', 'guruMengajar.guru', 'guruMengajar.rombel']);

        return view('mata-pelajaran.edit', [
            'mataPelajaran' => $mataPelajaran,

            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),

            'guru' => DataGuru::orderBy('nama_guru')->get(),

            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    /**
     * Memperbarui Mata Pelajaran
     *
     * Relasi guru yang mengajar TIDAK ikut disentuh di sini. Guru vacancies
     * diatur lewat endpoint tambahGuru(), updateGuru(), dan hapusGuru() supaya
     * mengedit kolom mata pelajaran tidak ikut menghapus penugasan guru.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran): RedirectResponse
    {
        $data = $request->validate([
            'kode_mata_pelajaran' => ['nullable', 'string', 'max:50'],

            'nama_mata_pelajaran' => ['required', 'string', 'max:255'],

            'kelompok' => ['nullable', 'string', 'max:50'],

            'sekolah_id' => ['nullable', 'integer', 'exists:data_sekolah,id'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA MATA PELAJARAN
        |--------------------------------------------------------------------------
        */

        $mataPelajaran->update([
            'kode_mata_pelajaran' => $data['kode_mata_pelajaran'] ?? null,

            'nama_mata_pelajaran' => $data['nama_mata_pelajaran'],

            'kelompok' => $data['kelompok'] ?? null,

            'sekolah_id' => $data['sekolah_id'] ?? null,
        ]);

        return redirect()->route('mata-pelajaran.index')->with('status', 'Data Mata Pelajaran berhasil diperbarui.');
    }

    /**
     * Menambah guru yang mengajar mata pelajaran
     *
     * Dipakai dari halaman edit ketika mata pelajaran belum punya guru,
     * atau ketika masih perlu guru tambahan untuk rombel lain.
     */
    public function tambahGuru(Request $request, MataPelajaran $mataPelajaran): RedirectResponse
    {
        $data = $request->validate([
            'guru_id' => ['required', 'integer', 'exists:data_guru,id'],

            'rombel_id' => ['required', 'integer', 'exists:rombel,id'],

            'tahun_ajaran' => ['nullable', 'string', 'max:20'],

            'semester' => ['nullable', 'string', 'max:20'],
        ], $this->pesanValidasiGuru());

        $guru = DataGuru::findOrFail($data['guru_id']);

        $rombel = Rombel::findOrFail($data['rombel_id']);

        try {
            GuruMengajar::create([
                'guru_id' => $guru->id,

                'mata_pelajaran_id' => $mataPelajaran->id,

                'rombel_id' => $rombel->id,

                'tahun_ajaran' => $data['tahun_ajaran'] ?? null,

                'semester' => $data['semester'] ?? null,
            ]);
        } catch (QueryException) {
            /*
            |--------------------------------------------------------------------------
            | GURU SUDAH MENGAJAR KOMBINASI YANG SAMA
            |--------------------------------------------------------------------------
            |
            | Unique key guru_mengajar_unik menolak guru yang sama untuk mapel,
            | rombel, dan periode yang sama. Pesan dibuat ramah admin.
            |
            */

            return redirect()
                ->route('mata-pelajaran.edit', $mataPelajaran->id)
                ->withInput()
                ->withErrors([
                    'guru_id' => 'Guru "' . $guru->nama_guru . '" sudah tercatat mengajar '
                        . $mataPelajaran->nama_mata_pelajaran . ' pada ' . $rombel->nama_rombel . '. '
                        . 'Silakan pilih rombel lain.',
                ]);
        }

        return redirect()
            ->route('mata-pelajaran.edit', $mataPelajaran->id)
            ->with('status', 'Guru "' . $guru->nama_guru . '" berhasil ditambahkan untuk '
                . $mataPelajaran->nama_mata_pelajaran . '.');
    }

    /**
     * Mengganti guru yang mengajar mata pelajaran
     */
    public function updateGuru(Request $request, MataPelajaran $mataPelajaran, GuruMengajar $guruMengajar): RedirectResponse
    {
        $data = $request->validate([
            'guru_id' => ['required', 'integer', 'exists:data_guru,id'],

            'rombel_id' => ['required', 'integer', 'exists:rombel,id'],

            'tahun_ajaran' => ['nullable', 'string', 'max:20'],

            'semester' => ['nullable', 'string', 'max:20'],
        ]);

        // Pastikan relasi tersebut memang milik mata pelajaran ini
        if ($guruMengajar->mata_pelajaran_id != $mataPelajaran->id) {
            abort(404);
        }

        $guruMengajar->update([
            'guru_id' => $data['guru_id'],
            'rombel_id' => $data['rombel_id'],
            'tahun_ajaran' => $data['tahun_ajaran'] ?? null,
            'semester' => $data['semester'] ?? null,
        ]);

        return redirect()->route('mata-pelajaran.edit', $mataPelajaran->id)->with('status', 'Guru yang mengajar berhasil diperbarui.');
    }

    /**
     * Menghapus guru dari mata pelajaran
     */
    public function hapusGuru(MataPelajaran $mataPelajaran, GuruMengajar $guruMengajar): RedirectResponse
    {
        // Pastikan relasi tersebut memang milik mata pelajaran ini
        if ($guruMengajar->mata_pelajaran_id != $mataPelajaran->id) {
            abort(404);
        }

        $guruMengajar->delete();

        return redirect()->route('mata-pelajaran.edit', $mataPelajaran->id)->with('status', 'Guru berhasil dihapus dari mata pelajaran.');
    }

    /**
     * Menghapus Mata Pelajaran
     */
    public function destroy(MataPelajaran $mataPelajaran): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS RELASI GURU
        |--------------------------------------------------------------------------
        */

        $mataPelajaran->guruMengajar()->delete();

        /*
        |--------------------------------------------------------------------------
        | HAPUS MATA PELAJARAN
        |--------------------------------------------------------------------------
        */

        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')->with('status', 'Data Mata Pelajaran berhasil dihapus.');
    }

    /**
     * Menyimpan data Guru Mengajar
     */
    protected function simpanGuruMengajar(MataPelajaran $mataPelajaran, array $data): void
    {
        $guru = $data['guru_id'] ?? [];

        $rombel = $data['rombel_id'] ?? [];

        $tahun = $data['tahun_ajaran'] ?? [];

        $semester = $data['semester'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | LOOP DATA GURU
        |--------------------------------------------------------------------------
        */

        foreach ($guru as $i => $idGuru) {
            /*
            |--------------------------------------------------------------------------
            | JIKA GURU ATAU ROMBEL KOSONG
            |--------------------------------------------------------------------------
            */

            if (blank($idGuru) || blank($rombel[$i] ?? null)) {
                continue;
            }

            try {
                GuruMengajar::create([
                    'guru_id' => $idGuru,

                    'mata_pelajaran_id' => $mataPelajaran->id,

                    'rombel_id' => $rombel[$i],

                    'tahun_ajaran' => $tahun[$i] ?? null,

                    'semester' => $semester[$i] ?? null,
                ]);
            } catch (QueryException) {
                /*
                |--------------------------------------------------------------------------
                | JIKA RELASI DUPLIKAT
                |--------------------------------------------------------------------------
                |
                | Baris tersebut dilewati.
                |
                */

                continue;
            }
        }
    }

    /**
     * Pastikan tiap guru yang dipilih pada form tambah data sudah punya rombel.
     *
     * Baris yang guru dan rombelnya kosong tetap diabaikan, jadi admin boleh
     * menyisakan baris kosong. Yang ditolak hanya baris yang gurunya sudah
     * dipilih tapi rombelnya lupa diisi.
     */
    protected function validasiRombelWajib(Request $request): void
    {
        $guru = (array) $request->input('guru_id', []);

        $rombel = (array) $request->input('rombel_id', []);

        foreach ($guru as $i => $idGuru) {
            if (blank($idGuru)) {
                continue;
            }

            if (blank($rombel[$i] ?? null)) {
                throw ValidationException::withMessages([
                    'rombel_id.' . $i => 'Rombel wajib dipilih untuk setiap guru yang ditambahkan.',
                ]);
            }
        }
    }

    /**
     * Pesan validasi berbahasa Indonesia untuk kolom guru.
     *
     * @return array<string, string>
     */
    protected function pesanValidasiGuru(): array
    {
        return [
            'guru_id.required' => 'Guru wajib dipilih.',
            'guru_id.exists' => 'Guru yang dipilih tidak tersedia.',
            'rombel_id.required' => 'Rombel wajib dipilih.',
            'rombel_id.exists' => 'Rombel yang dipilih tidak tersedia.',
        ];
    }
}
