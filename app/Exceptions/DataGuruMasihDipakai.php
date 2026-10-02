<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Dilempar ketika data guru masih dipakai oleh relasi lain sehingga tidak
 * boleh dihapus.
 *
 * Dipakai oleh model DataGuru sebagai jaring pengaman, supaya penghapusan
 * data guru tidak bisa dilakukan diam-diam dari tempat lain. Controller
 * menangkap exception ini lalu menampilkan pesan yang mudah dipahami
 * kepada admin.
 */
class DataGuruMasihDipakai extends RuntimeException
{
    /**
     * Buat exception dari penjelasan alasan penghapusan ditolak.
     */
    public static function dariAlasan(string $alasan): self
    {
        return new self($alasan);
    }
}