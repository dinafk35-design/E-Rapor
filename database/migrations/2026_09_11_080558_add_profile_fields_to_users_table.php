<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable()->after('id');
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable()->after('username');
            }

            if (!Schema::hasColumn('users', 'login_terakhir')) {
                $table->dateTime('login_terakhir')->nullable();
            }

            if (!Schema::hasColumn('users', 'ip')) {
                $table->string('ip')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Tidak menghapus kolom agar data users yang sudah ada tetap aman.
    }
};