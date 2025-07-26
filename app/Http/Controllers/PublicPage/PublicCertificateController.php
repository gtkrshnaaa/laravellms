<?php

// File: app/Http/Controllers/PublicPage/PublicCertificateController.php
namespace App\Http\Controllers\PublicPage;

use App\Http\Controllers\Controller;
use App\Models\StudentCertificate;

class PublicCertificateController extends Controller
{
    /**
     * Menampilkan halaman verifikasi sertifikat publik.
     */
    public function show(string $token)
    {
        // Cari sertifikat berdasarkan token, jika tidak ada akan 404
        $certificate = StudentCertificate::where('verification_token', $token)
            ->with(['student', 'course']) // Eager load untuk efisiensi
            ->firstOrFail();

        // Tampilkan view sertifikat dengan data yang ditemukan
        return view('student.certificate.show', compact('certificate'));
    }
}