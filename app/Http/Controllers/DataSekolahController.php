<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\Request;

class DataSekolahController extends Controller
{
    // Menampilkan semua data sekolah
    public function index()
    {
        $dataSekolah = DataSekolah::all();

        return view('data-sekolah.index', compact('dataSekolah'));
    }


    // Menampilkan form tambah
    public function create()
    {
        return view('data-sekolah.create');
    }


    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'email' => 'nullable|email',
            'telepon' => 'nullable',
        ]);


        DataSekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);


        return redirect()
            ->route('data-sekolah.index')
            ->with('success', 'Data sekolah berhasil ditambahkan.');
    }


    // Menampilkan detail
    public function show(DataSekolah $dataSekolah)
    {
        return view('data-sekolah.show', compact('dataSekolah'));
    }


    // Menampilkan form edit
    public function edit(DataSekolah $dataSekolah)
    {
        return view('data-sekolah.edit', compact('dataSekolah'));
    }


    // Mengupdate data
    public function update(Request $request, DataSekolah $dataSekolah)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'email' => 'nullable|email',
            'telepon' => 'nullable',
        ]);


        $dataSekolah->update([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);


        return redirect()
            ->route('data-sekolah.index')
            ->with('success', 'Data sekolah berhasil diperbarui.');
    }


    // Menghapus data
    public function destroy(DataSekolah $dataSekolah)
    {
        $dataSekolah->delete();

        return redirect()
            ->route('data-sekolah.index')
            ->with('success', 'Data sekolah berhasil dihapus.');
    }
}