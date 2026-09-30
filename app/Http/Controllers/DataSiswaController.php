<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\Rombel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataSiswaController extends Controller
{
    public function index(): View
    {
        return view('data-siswa.index', [
            'siswa' => DataSiswa::with('rombel')->orderBy('id')->get(),
            'rombelList' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function create(): View
    {
        return view('data-siswa.create', [
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nisn' => ['nullable', 'string', 'max:30'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'rombel_id' => ['nullable', 'integer', 'exists:rombel,id'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        DataSiswa::create($data);

        return redirect()
            ->route('data-siswa')
            ->with('status', 'Data Siswa berhasil disimpan.');
    }

    public function show(DataSiswa $data_siswa): View
    {
        return view('data-siswa.show', [
            'siswa' => $data_siswa->load('rombel'),
        ]);
    }

    public function edit(DataSiswa $data_siswa): View
    {
        return view('data-siswa.edit', [
            'siswa' => $data_siswa,
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function update(Request $request, DataSiswa $data_siswa): RedirectResponse
    {
        $data = $request->validate([
            'nisn' => ['nullable', 'string', 'max:30'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'rombel_id' => ['nullable', 'integer', 'exists:rombel,id'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        $data_siswa->update($data);

        return redirect()
            ->route('data-siswa')
            ->with('status', 'Data Siswa berhasil diperbarui.');
    }

    public function destroy(DataSiswa $data_siswa): RedirectResponse
    {
        $data_siswa->delete();

        return redirect()
            ->route('data-siswa')
            ->with('status', 'Data Siswa berhasil dihapus.');
    }
}
