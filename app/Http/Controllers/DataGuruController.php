<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataGuruController extends Controller
{
    public function index(): View
    {
        return view('data-guru.index', [
            'guru' => DataGuru::orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('data-guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nip' => ['nullable', 'string', 'max:30'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        DataGuru::create($data);

        return redirect()
            ->route('data-guru')
            ->with('status', 'Data Guru berhasil disimpan.');
    }

    public function edit(DataGuru $guru): View
    {
        return view('data-guru.edit', [
            'guru' => $guru,
        ]);
    }

    public function update(Request $request, DataGuru $guru): RedirectResponse
    {
        $data = $request->validate([
            'nip' => ['nullable', 'string', 'max:30'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        $guru->update($data);

        return redirect()
            ->route('data-guru')
            ->with('status', 'Data Guru berhasil diperbarui.');
    }

    public function destroy(DataGuru $guru): RedirectResponse
    {
        $guru->delete();

        return redirect()
            ->route('data-guru')
            ->with('status', 'Data Guru berhasil dihapus.');
    }
}
