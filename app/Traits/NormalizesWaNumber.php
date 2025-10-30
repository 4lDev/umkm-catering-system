<?php

namespace App\Traits;

trait NormalizesWaNumber
{
    /**
     * Membersihkan dan memformat nomor WhatsApp ke format internasional (62...).
     *
     * @param string $number
     * @return string
     */
    protected function normalizeWa(string $number): string
    {
        // 1. Hapus semua karakter non-numerik (spasi, strip, kurung)
        $number = preg_replace('/[^0-9]/', '', $number);

        // 2. Cek apakah dimulai dengan '0'
        if (substr($number, 0, 1) === '0') {
            // Ganti '0' menjadi '62' (kode negara Indonesia)
            $number = '62' . substr($number, 1);
        }

        // 3. Jika dimulai dengan '+62', hapus '+'
        if (substr($number, 0, 3) === '+62') {
            $number = '62' . substr($number, 3);
        }

        // 4. Pastikan prefix '62' ada
        if (substr($number, 0, 2) !== '62') {
            // Jika nomor terlalu pendek untuk nomor internasional, mungkin ini error, 
            // tapi untuk demo, kita asumsikan prefix 62 hilang.
            // PENTING: Untuk produksi, ini harusnya dilempar ke validasi error.
            $number = '62' . $number;
        }

        return $number;
    }
}