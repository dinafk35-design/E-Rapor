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
use Illuminate\View\View;

class MataPelajaranController extends Controller
{
    public function index(): View
    {
        return view('mata-pelajaran.index', [
            'mataPelajaran' => MataPelajaran::with('sekolah')
                ->with('guruMengajar.guru')
                ->withCount('guruMengajar')
                ->orderBy('nama_mata_pelajaran')
                ->get(),
            'sekolahList' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guruList' => DataGuru::orderBy('nama_guru')->get(),
        ]);
    }

    public function create(): View
    {
        return view('mata-pelajaran.create', [
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

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
        ]);

        $mataPelajaran = MataPelajaran::create([
            'kode_mata_pelajaran' => $data['kode_mata_pelajaran'] ?? null,
            'nama_mata_pelajaran' => $data['nama_mata_pelajaran'],
            'kelompok' => $data['kelompok'] ?? null,
            'sekolah_id' => $data['sekolah_id'] ?? null,
        ]);

        $this->simpanGuruMengajar($mataPelajaran, $data);

        return redirect()
            ->route('mata-pelajaran')
            ->with('status', 'Data Mata Pelajaran berhasil disimpan.');
    }

    public function edit(MataPelajaran $mataPelajaran): View
    {
        $mataPelajaran->load('guruMengajar');

        return view('mata-pelajaran.edit', [
            'mataPelajaran' => $mataPelajaran,
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function update(Request $request, MataPelajaran $mataPelajaran): RedirectResponse
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
        ]);

        $mataPelajaran->update([
            'kode_mata_pelajaran' => $data['kode_mata_pelajaran'] ?? null,
            'nama_mata_pelajaran' => $data['nama_mata_pelajaran'],
            'kelompok' => $data['kelompok'] ?? null,
            'sekolah_id' => $data['sekolah_id'] ?? null,
        ]);

        $mataPelajaran->guruMengajar()->delete();

        $this->simpanGuruMengajar($mataPelajaran, $data);

        return redirect()
            ->route('mata-pelajaran')
            ->with('status', 'Data Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mataPelajaran): RedirectResponse
    {
        $mataPelajaran->guruMengajar()->delete();

        $mataPelajaran->delete();

        return redirect()
            ->route('mata-pelajaran')
            ->with('status', 'Data Mata Pelajaran berhasil dihapus.');
    }

    /**
     * Simpan baris guru mengajar dari input array.
     */
    protected function simpanGuruMengajar(MataPelajaran $mataPelajaran, array $data): void
    {
        $guru = $data['guru_id'] ?? [];
        $rombel = $data['rombel_id'] ?? [];
        $tahun = $data['tahun_ajaran'] ?? [];
        $semester = $data['semester'] ?? [];

        foreach ($guru as $i => $idGuru) {

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
                // Lewati baris duplikat
                continue;
            }
        }
    }
}
