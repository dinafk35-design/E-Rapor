<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik dari gambar pertama
        $data = [
            'total_pengguna' => 1205,
            'total_rombel' => 50,
            'total_aktif' => 205,
            'total_pembelajaran' => 215,
            
            // Data status pekerjaan
            'status_pekerjaan' => [
                ['nama' => 'Menyimpan data koneksi webservice', 'status' => 'Selesai'],
                ['nama' => 'Memahami data administrator', 'status' => 'Return'],
                ['nama' => 'Generate User Guru dan Siswa', 'status' => 'Selesai'],
                ['nama' => 'Edit data kepala sekolah', 'status' => 'Berjalan'],
                ['nama' => 'Update data Siswa', 'status' => 'Selesai'],
            ],
            
            // Data rincian pekerjaan utama
            'rincian_pekerjaan' => [
                ['no' => 1, 'nama' => 'Menyimpan data koneksi webservice', 'status' => 'Selesai', 'tanggal' => '2026-01-15'],
                ['no' => 2, 'nama' => 'Memahami data administrator', 'status' => 'Return', 'tanggal' => '2026-01-14'],
                ['no' => 3, 'nama' => 'Generate User Guru dan Siswa', 'status' => 'Selesai', 'tanggal' => '2026-01-13'],
                ['no' => 4, 'nama' => 'Edit data kepala sekolah', 'status' => 'Berjalan', 'tanggal' => '2026-01-12'],
                ['no' => 5, 'nama' => 'Update data Siswa', 'status' => 'Selesai', 'tanggal' => '2026-01-11'],
            ],
            
            'aktivitas_terbaru' => ['Aktivitas Operator dan Guru dalam sistem']
        ];

        return view('dashboard', $data);
    }
}