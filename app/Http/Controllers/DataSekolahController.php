<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataSekolahController extends Controller
{
    public function index(): View
    {
        return view('data-sekolah.index', [
            'sekolah' => DataSekolah::orderBy('nama_sekolah')->get(),
        ]);
    }

    public function create(): View
    {
        return view('data-sekolah.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:20'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'nip_kepala_sekolah' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        DataSekolah::create($data);

        return redirect()
            ->route('data-sekolah')
            ->with('status', 'Data Sekolah berhasil disimpan.');
    }

    public function edit(DataSekolah $sekolah): View
    {
        return view('data-sekolah.edit', [
            'sekolah' => $sekolah,
        ]);
    }

    public function update(Request $request, DataSekolah $sekolah): RedirectResponse
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:20'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'nip_kepala_sekolah' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        $sekolah->update($data);

        return redirect()
            ->route('data-sekolah')
            ->with('status', 'Data Sekolah berhasil diperbarui.');
    }

    public function destroy(DataSekolah $sekolah): RedirectResponse
    {
        $sekolah->delete();

        return redirect()
            ->route('data-sekolah')
            ->with('status', 'Data Sekolah berhasil dihapus.');
    }
}
