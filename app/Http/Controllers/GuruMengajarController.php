<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\GuruMengajar;
use App\Models\MataPelajaran;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Alur relasi Guru <-> Mata Pelajaran.
 *
 * Halaman ini menjadi tempat admin untuk melihat mata pelajaran yang masih
 * diajar seorang guru, melepas relasinya, atau mengganti gurunya.
 *
 * Yang diubah di sini HANYA kolom guru_id pada tabel guru_mengajar. Data
 * Mata Pelajaran maupun data nilai siswa tidak pernah ikut berubah.
 */
class GuruMengajarController extends Controller
{
    /**
     * Daftar seluruh penugasan guru mengajar, bisa disaring per guru.
     */
    public function index(Request $request): View
    {
        $guruTerpilih = DataGuru::orderBy('nama_guru')->get();

        $pengajar = GuruMengajar::with(['guru', 'mataPelajaran', 'rombel'])
            ->when($request->integer('guru_id'), function ($query, $guruId): void {
                $query->where('guru_id', $guruId);
            })
            ->when($request->integer('mata_pelajaran_id'), function ($query, $mapelId): void {
                $query->where('mata_pelajaran_id', $mapelId);
            })
            ->orderByDesc('id')
            ->get();

        return view('guru-mengajar.index', [
            'pengajar' => $pengajar,
            'guruList' => $guruTerpilih,
            'mapelList' => MataPelajaran::orderBy('nama_mata_pelajaran')->get(),
            'guruDipilih' => $request->integer('guru_id') ?: null,
            'mapelDipilih' => $request->integer('mata_pelajaran_id') ?: null,
        ]);
    }

    /**
     * Formulir ganti guru pengajar.
     *
     * Daftar guru pengganti sengaja tidak memuat guru yang sedang Revision
     * mengajar, karena mengganti guru dengan dirinya sendiri tidak ada artinya.
     */
    public function edit(GuruMengajar $guru_mengajar): View
    {
        $guru_mengajar->load(['guru', 'mataPelajaran', 'rombel']);

        return view('guru-mengajar.edit', [
            'pengajar' => $guru_mengajar,
            'pilihanGuru' => DataGuru::where('id', '!=', $guru_mengajar->guru_id)
                ->orderBy('nama_guru')
                ->get(),
        ]);
    }

    /**
     * Simpan guru pengganti.
     *
     * Hanya kolom guru_id yang berubah. Mata Pelajaran, Rombel, periode, dan
     * seluruh data nilai siswa tetap seperti semula.
     */
    public function update(Request $request, GuruMengajar $guru_mengajar): RedirectResponse
    {
        $data = $request->validate([
            'guru_id' => ['required', 'integer', 'exists:data_guru,id'],
        ], [
            'guru_id.required' => 'Guru pengganti wajib dipilih.',
            'guru_id.exists' => 'Guru pengganti yang dipilih tidak tersedia.',
        ]);

        if ((int) $data['guru_id'] === (int) $guru_mengajar->guru_id) {
            return $this->kembaliDenganAlasanGagal(
                $guru_mengajar,
                'Guru pengganti harus berbeda dari guru yang sedang mengajar.'
            );
        }

        $guru_mengajar->loadMissing(['guru', 'mataPelajaran', 'rombel']);

        $pengganti = DataGuru::findOrFail($data['guru_id']);

        try {
            $guru_mengajar->forceFill(['guru_id' => $pengganti->id])->save();
        } catch (QueryException) {
            // Unique key guru_mengajar_unik menolak karena guru tersebut sudah
            // mengajar mapel yang sama pada rombel dan periode yang sama.
            return $this->kembaliDenganAlasanGagal(
                $guru_mengajar,
                'Guru "' . $pengganti->nama_guru . '" sudah tercatat mengajar '
                    . ($guru_mengajar->mataPelajaran->nama_mata_pelajaran ?? 'mata pelajaran ini')
                    . ' pada '.($guru_mengajar->rombel->nama_romel ?? 'rombel yang sama')
                    . '. Silakan pilih guru lain.'
            );
        }

        return redirect()
            ->route('guru-mengajar')
            ->with('status', 'Guru pengajar ' . ($guru_mengajar->mataPelajaran->nama_mata_pelajaran ?? '')
                . ' berhasil diganti dari "' . ($guru_mengajar->guru?->nama_guru ?? '-')
                . '" menjadi "' . $pengganti->nama_guru . '".');
    }

    /**
     * Lepas relasi guru mengajar.
     *
     * Hanya baris di tabel guru_mengajar yang dihapus. Data Mata Pelajaran
     * dan data nilai siswa tidak tersentuh.
     */
    public function destroy(GuruMengajar $guru_mengajar): RedirectResponse
    {
        $guru_mengajar->loadMissing(['guru', 'mataPelajaran', 'rombel']);

        $namaGuru = $guru_mengajar->guru?->nama_guru ?? '-';
        $namaMapel = $guru_mengajar->mataPelajaran->nama_mata_pelajaran;

        try {
            $guru_mengajar->delete();
        } catch (QueryException) {
            // Jangan tampilkan error SQL mentah kepada admin.
            return redirect()
                ->route('data-guru.relasi', $guru_mengajar->guru_id)
                ->withErrors([
                    'relasi' => 'Relasi guru mengajar tidak dapat dilepas. Silakan coba kembali.',
                ]);
        }

        return redirect()
            ->route('data-guru.relasi', $guru_mengajar->guru_id)
            ->with('status', 'Relasi "' . $namaGuru . ' - ' . $namaMapel . '" berhasil dilepas. '
                . 'Data Mata Pelajaran tetap tersimpan.');
    }

    /**
     * Kembalikan admin ke formulir ganti guru dengan pesan yang jelas.
     */
    protected function kembaliDenganAlasanGagal(GuruMengajar $guru_mengajar, string $pesan): RedirectResponse
    {
        return redirect()
            ->route('guru-mengajar.edit', $guru_mengajar->id)
            ->withInput()
            ->withErrors(['guru_id' => $pesan]);
    }
}