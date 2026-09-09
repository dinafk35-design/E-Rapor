@extends('layouts.app')

@section('content')

<style>

    .user-page {
        padding: 10px 20px 30px;
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #111;
    }

    .user-card {
        background: white;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .user-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .user-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .btn-tambah {
        display: inline-block;
        padding: 10px 18px;
        background: #496fb1;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-tambah:hover {
        background: #385d9c;
        color: white;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-table th {
        background: #496fb1;
        color: white;
        padding: 13px;
        text-align: left;
        font-size: 14px;
    }

    .user-table td {
        padding: 13px;
        border-bottom: 1px solid #e5e5e5;
        font-size: 14px;
    }

    .user-table tr:hover {
        background: #f7f9fc;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #5146a5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-name {
        font-weight: 700;
    }

    .user-username {
        color: #777;
        font-size: 12px;
        margin-top: 3px;
    }

    .badge-admin {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        background: #e7e4ff;
        color: #403795;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-edit {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 6px;
        background: #e7a53b;
        color: white;
        text-decoration: none;
        font-size: 12px;
    }

    .btn-delete {
        padding: 7px 12px;
        border: none;
        border-radius: 6px;
        background: #dc4c4c;
        color: white;
        font-size: 12px;
        cursor: pointer;
    }

    .success-message {
        padding: 12px 15px;
        margin-bottom: 20px;
        background: #dff5e5;
        color: #21733a;
        border-radius: 8px;
    }

</style>


<div class="user-page">

    <div class="page-title">
        👥 USER DATA
    </div>


    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    <div class="user-card">

        <div class="user-header">

            <h3>
                Data Pengguna Sistem
            </h3>

            <a
                href="{{ route('user-data.create') }}"
                class="btn-tambah"
            >
                + Tambah Pengguna
            </a>

        </div>


        <div class="table-wrapper">

            <table class="user-table">

                <thead>

                    <tr>

                        <th>
                            Pengguna
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Level
                        </th>

                        <th>
                            Login Terakhir
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>

                                <div class="user-info">

                                    <div class="user-avatar">
                                        👤
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-username">
                                            {{ '@' . $user->username }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $user->email }}
                            </td>


                            <td>

                                <span class="badge-admin">
                                    {{ $user->role ?? 'User' }}
                                </span>

                            </td>


                            <td>

                                {{ $user->login_terakhir ?? '-' }}

                            </td>


                            <td>

                                <a
                                    href="{{ route('user-data.edit', $user->id) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('user-data.destroy', $user->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-delete"
                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                style="text-align:center;padding:30px;"
                            >
                                Belum ada data pengguna.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection