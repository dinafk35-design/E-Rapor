<?php

namespace App\Http\Controllers;

use App\Models\AnggotaRombel;
use App\Models\DataGuru;
use App\Models\DataSekolah;
use App\Models\DataSiswa;
use App\Models\Rombel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RombelController extends Controller
{
    public function index(): View
    {
        return view('rombel.index', [
            'rombel' => Rombel::with('sekolah')
                ->withCount('anggota')
                ->orderBy('id')
                ->get(),
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'siswa' => DataSiswa::orderBy('nama_siswa')->get(),
        ]);
    }

    public function create(): View
    {
        return view('rombel.create', [
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'siswa' => DataSiswa::orderBy('nama_siswa')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_rombel' => ['required', 'string', 'max:255'],
            'tingkat' => ['nullable', 'string', 'max:20'],
            'sekolah_id' => ['nullable', 'integer', 'exists:data_sekolah,id'],
            'wali_kelas_id' => ['nullable', 'integer', 'exists:data_guru,id'],
            'siswa_id' => ['nullable', 'array'],
            'siswa_id.*' => ['nullable', 'integer', 'exists:data_siswa,id'],
            'tahun_ajaran' => ['nullable', 'array'],
            'tahun_ajaran.*' => ['nullable', 'string', 'max:20'],
            'semester' => ['nullable', 'array'],
            'semester.*' => ['nullable', 'string', 'max:20'],
        ]);

        $rombel = Rombel::create([
            'nama_rombel' => $data['nama_rombel'],
            'tingkat' => $data['tingkat'] ?? null,
            'sekolah_id' => $data['sekolah_id'] ?? null,
            'wali_kelas_id' => $data['wali_kelas_id'] ?? null,
        ]);

        $this->simpanAnggota($rombel, $data);

        return redirect()
            ->route('rombel')
            ->with('status', 'Data Rombel berhasil disimpan.');
    }

    public function edit(Rombel $rombel): View
    {
        $rombel->load('anggota');

        return view('rombel.edit', [
            'rombel' => $rombel,
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'siswa' => DataSiswa::orderBy('nama_siswa')->get(),
        ]);
    }

    public function update(Request $request, Rombel $rombel): RedirectResponse
    {
        $data = $request->validate([
            'nama_rombel' => ['required', 'string', 'max:255'],
            'tingkat' => ['nullable', 'string', 'max:20'],
            'sekolah_id' => ['nullable', 'integer', 'exists:data_sekolah,id'],
            'wali_kelas_id' => ['nullable', 'integer', 'exists:data_guru,id'],
            'siswa_id' => ['nullable', 'array'],
            'siswa_id.*' => ['nullable', 'integer', 'exists:data_siswa,id'],
            'tahun_ajaran' => ['nullable', 'array'],
            'tahun_ajaran.*' => ['nullable', 'string', 'max:20'],
            'semester' => ['nullable', 'array'],
            'semester.*' => ['nullable', 'string', 'max:20'],
        ]);

        $rombel->update([
            'nama_rombel' => $data['nama_rombel'],
            'tingkat' => $data['tingkat'] ?? null,
            'sekolah_id' => $data['sekolah_id'] ?? null,
            'wali_kelas_id' => $data['wali_kelas_id'] ?? null,
        ]);

        // Ganti seluruh anggota dengan data terbaru
        $rombel->anggota()->delete();

        $this->simpanAnggota($rombel, $data);

        return redirect()
            ->route('rombel')
            ->with('status', 'Data Rombel berhasil diperbarui.');
    }

    public function destroy(Rombel $rombel): RedirectResponse
    {
        $rombel->anggota()->delete();

        $rombel->delete();

        return redirect()
            ->route('rombel')
            ->with('status', 'Data Rombel berhasil dihapus.');
    }

    /**
     * Simpan baris anggota rombel dari input array.
     */
    protected function simpanAnggota(Rombel $rombel, array $data): void
    {
        $siswa = $data['siswa_id'] ?? [];
        $tahun = $data['tahun_ajaran'] ?? [];
        $semester = $data['semester'] ?? [];

        foreach ($siswa as $i => $idSiswa) {

            if (blank($idSiswa)) {
                continue;
            }

            try {
                AnggotaRombel::create([
                    'rombel_id' => $rombel->id,
                    'siswa_id' => $idSiswa,
                    'tahun_ajaran' => $tahun[$i] ?? null,
                    'semester' => $semester[$i] ?? null,
                ]);
            } catch (\Illuminate\Database\QueryException) {
                // Lewati baris duplikat
                continue;
            }
        }
    }
}
