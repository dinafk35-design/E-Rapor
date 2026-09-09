@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-0">

    <!-- ===== HEADER ===== -->
    <div class="top-header">
        <h2 class="page-title">Dashboard</h2>
        <div class="header-actions">
            <button class="btn btn-success btn-sm" id="toggleInputBtn" onclick="toggleInputNilai()" style="border-radius:8px; padding:8px 18px; font-weight:600;">
                <i class="fas fa-pen me-1"></i> Input nilai oleh Guru dan Wali Dibuka
            </button>
            <button class="btn btn-outline-custom" onclick="showPanduan()">
                <i class="fas fa-book me-1"></i> Panduan
            </button>
        </div>
    </div>

    <!-- ===== JUDUL E-RAPOR ===== -->
    <div class="mb-4">
        <h4 style="font-weight:800; color:#1a2332; font-size:20px;">
            E-RAPOR SMK TAHUN AJARAN 2026/2027
        </h4>
    </div>

    <!-- ===== REKAP DATA CARDS ===== -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-number">{{ number_format($total_pengguna) }}</div>
                <div class="stat-label">Pengguna</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-number">{{ number_format($total_rombel) }}</div>
                <div class="stat-label">Rombel</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-number">{{ number_format($total_aktif) }}</div>
                <div class="stat-label">Aktif</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-number">{{ number_format($total_pembelajaran) }}</div>
                <div class="stat-label">Pembelajaran</div>
            </div>
        </div>
    </div>

    <!-- ===== LINK FORM PENDATAAN ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header">
                    <i class="fas fa-link"></i> Link Form Pendataan dan Panduan Aplikasi
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="link-form-item" onclick="showLaporan()">
                            <i class="fas fa-file-alt text-primary"></i> Laporan Sebagai Pengguna Aplikasi e-Rapor
                        </a>
                        <a href="#" class="link-form-item" onclick="showPanduanAplikasi()">
                            <i class="fas fa-book text-info"></i> Panduan Penggunaan Aplikasi E-Rapor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== DUA KOLOM ===== -->
    <div class="row">
        <!-- KOLOM KIRI: Status Kerja Administrator -->
        <div class="col-lg-6 mb-4">
            <div class="custom-card">
                <div class="card-header">
                    <i class="fas fa-tasks"></i> Status Kerja Administrator
                </div>
                <div class="card-body">
                    <h6 style="font-weight:700; font-size:14px; color:#1a2332; margin-bottom:12px;">
                        Aktivitas Terbaru
                    </h6>
                    <ul class="activity-list">
                        @foreach($aktivitas_terbaru as $aktivitas)
                            <li>
                                <span class="dot"></span>
                                {{ $aktivitas }}
                            </li>
                        @endforeach
                    </ul>

                    <hr style="margin: 18px 0;">

                    <h6 style="font-weight:700; font-size:14px; color:#1a2332; margin-bottom:12px;">
                        Jenis Pekerjaan
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <th style="width:120px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($status_pekerjaan as $pekerjaan)
                                    <tr>
                                        <td>{{ $pekerjaan['nama'] }}</td>
                                        <td>
                                            @php
                                                $badgeClass = '';
                                                if($pekerjaan['status'] == 'Selesai') $badgeClass = 'badge-selesai';
                                                elseif($pekerjaan['status'] == 'Berjalan') $badgeClass = 'badge-berjalan';
                                                elseif($pekerjaan['status'] == 'Return') $badgeClass = 'badge-return';
                                            @endphp
                                            <span class="badge-status {{ $badgeClass }}">
                                                {{ $pekerjaan['status'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: STATUS KERJA ADMINISTRATOR -->
        <div class="col-lg-6 mb-4">
            <div class="custom-card">
                <div class="card-header">
                    <i class="fas fa-clipboard-list"></i> STATUS KERJA ADMINISTRATOR
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h6 style="font-weight:700; font-size:14px; color:#1a2332; margin:0;">
                            Rincian Kerja Utama Administrator
                        </h6>
                        <div class="d-flex gap-1">
                            <button class="btn-action" onclick="copyTable()" title="Copy">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="btn-action" onclick="exportExcel()" title="Excel">
                                <i class="fas fa-file-excel" style="color:#217346;"></i>
                            </button>
                            <button class="btn-action" onclick="exportPDF()" title="PDF">
                                <i class="fas fa-file-pdf" style="color:#dc3545;"></i>
                            </button>
                            <button class="btn-action" onclick="printTable()" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom" id="rincianTable">
                            <thead>
                                <tr>
                                    <th style="width:50px;">No</th>
                                    <th>Nama Pekerjaan</th>
                                    <th style="width:110px;">Status</th>
                                    <th style="width:120px;">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rincian_pekerjaan as $item)
                                    <tr>
                                        <td>{{ $item['no'] }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>
                                            @php
                                                $badgeClass = '';
                                                if($item['status'] == 'Selesai') $badgeClass = 'badge-selesai';
                                                elseif($item['status'] == 'Berjalan') $badgeClass = 'badge-berjalan';
                                                elseif($item['status'] == 'Return') $badgeClass = 'badge-return';
                                            @endphp
                                            <span class="badge-status {{ $badgeClass }}">
                                                {{ $item['status'] }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Table -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                        <span class="text-muted" style="font-size:13px;">
                            <i class="fas fa-eye me-1"></i> Show 10 rows
                        </span>
                        <div class="d-flex gap-1">
                            <button class="btn-action" onclick="prevPage()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn-action" onclick="nextPage()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // ===== TOGGLE INPUT NILAI =====
    function toggleInputNilai() {
        const btn = document.getElementById('toggleInputBtn');
        if (btn.innerHTML.includes('Dibuka')) {
            btn.innerHTML = '<i class="fas fa-times me-1"></i> Tutup Input nilai';
            btn.className = 'btn btn-danger btn-sm';
            btn.style.borderRadius = '8px';
            btn.style.padding = '8px 18px';
            btn.style.fontWeight = '600';
            showNotification('Input nilai ditutup');
        } else {
            btn.innerHTML = '<i class="fas fa-pen me-1"></i> Input nilai oleh Guru dan Wali Dibuka';
            btn.className = 'btn btn-success btn-sm';
            btn.style.borderRadius = '8px';
            btn.style.padding = '8px 18px';
            btn.style.fontWeight = '600';
            showNotification('Input nilai dibuka');
        }
    }

    // ===== NOTIFICATION =====
    function showNotification(message) {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 20px; right: 20px; 
            background: #1a2332; color: #fff; 
            padding: 12px 24px; border-radius: 10px; 
            font-weight: 600; font-size: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'slideOut