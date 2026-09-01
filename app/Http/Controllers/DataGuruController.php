<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    /**
     * Menampilkan semua data guru
     */
    public function index()
    {
        $dataGuru = DataGuru::latest()->get();

        return view('data-guru.index', compact('dataGuru'));
    }

    /**
     * Menampilkan form tambah guru
     */
    public function create()
    {
        return view('data-guru.create');
    }

    /**
     * Menyimpan data guru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'nik' => 'nullable',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
        ]);

        DataGuru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('data-guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail guru
     */
    public function show(DataGuru $dataGuru)
    {
        return view('data-guru.show', compact('dataGuru'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit(DataGuru $dataGuru)
    {
        return view('data-guru.edit', compact('dataGuru'));
    }

    /**
     * Menyimpan perubahan data
     */
    public function update(Request $request, DataGuru $dataGuru)
    {
        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'nik' => 'nullable',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
        ]);

        $dataGuru->update([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('data-guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Menghapus data guru
     */
    public function destroy(DataGuru $dataGuru)
    {
        $dataGuru->delete();

        return redirect()
            ->route('data-guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}