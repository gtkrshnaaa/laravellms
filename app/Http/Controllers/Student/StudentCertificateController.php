<?php

// File: app/Http/Controllers/Student/StudentCertificateController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCertificateController extends Controller
{
    /**
     * Menampilkan halaman daftar semua sertifikat yang dimiliki siswa.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Ambil semua sertifikat milik siswa, eager load relasi course
        $certificates = StudentCertificate::where('student_id', $student->id)
            ->with('course')
            ->latest('completed_at') // Urutkan dari yang terbaru
            ->paginate(9);

        return view('student.certificate.index', compact('certificates'));
    }

    /**
     * Menampilkan halaman detail satu sertifikat.
     */
    public function show(Course $course)
    {
        $student = Auth::guard('student')->user();

        $certificate = StudentCertificate::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$certificate) {
            abort(403, 'AKSES DITOLAK. ANDA HARUS MENYELESAIKAN KURSUS 100% TERLEBIH DAHULU.');
        }

        return view('student.certificate.show', compact('certificate'));
    }
}