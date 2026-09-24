<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-title">
        Dashboard {{ ucfirst(auth()->user()?->role ?? 'E-Rapor') }}
    </div>

    <div class="admin-info">
        <div class="admin-avatar">
            <i class="ph ph-user"></i>
        </div>

        <div>
            <div class="admin-name">
                {{ auth()->user()?->name ?? auth()->user()?->username ?? 'Pengguna' }}
            </div>

            <div class="admin-role">
                {{ ucfirst(auth()->user()?->role ?? 'Pengguna') }} E-Rapor
            </div>
        </div>
    </div>
</div>
