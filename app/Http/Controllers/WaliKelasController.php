<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\Rombel;
use App\Models\WaliKelas;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WaliKelasController extends Controller
{
    public function index(): View
    {
        return view('wali-kelas.index', [
            'waliKelas' => WaliKelas::with(['guru', 'rombel'])
                ->orderBy('id')
                ->get(),
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function create(): View
    {
        return view('wali-kelas.create', [
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'guru_id' => ['required', 'integer', 'exists:data_guru,id'],
            'rombel_id' => ['required', 'integer', 'exists:rombel,id'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
        ]);

        try {
            WaliKelas::create($data);
        } catch (QueryException) {
            return back()
                ->withInput()
                ->withErrors([
                    'guru_id' => 'Penugasan ini sudah ada.',
                ]);
        }

        return redirect()
            ->route('wali-kelas')
            ->with('status', 'Data Wali Kelas berhasil disimpan.');
    }

    public function edit(WaliKelas $waliKelas): View
    {
        return view('wali-kelas.edit', [
            'waliKelas' => $waliKelas,
            'guru' => DataGuru::orderBy('nama_guru')->get(),
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function update(Request $request, WaliKelas $waliKelas): RedirectResponse
    {
        $data = $request->validate([
            'guru_id' => ['required', 'integer', 'exists:data_guru,id'],
            'rombel_id' => ['required', 'integer', 'exists:rombel,id'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
        ]);

        $waliKelas->update($data);

        return redirect()
            ->route('wali-kelas')
            ->with('status', 'Data Wali Kelas berhasil diperbarui.');
    }

    public function destroy(WaliKelas $waliKelas): RedirectResponse
    {
        $waliKelas->delete();

        return redirect()
            ->route('wali-kelas')
            ->with('status', 'Data Wali Kelas berhasil dihapus.');
    }
}
