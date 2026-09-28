<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sekolah boleh kosong: form input mata pelajaran dan rombel
     * menyediakan pilihan "-- Pilih Sekolah --".
     */
    public function up(): void
    {
        if (! Schema::hasTable('mata_pelajaran')) {
            return;
        }

        Schema::table('mata_pelajaran', function (Blueprint $table): void {
            $table->unsignedBigInteger('sekolah_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('mata_pelajaran')) {
            return;
        }

        Schema::table('mata_pelajaran', function (Blueprint $table): void {
            $table->unsignedBigInteger('sekolah_id')->nullable(false)->change();
        });
    }
};
