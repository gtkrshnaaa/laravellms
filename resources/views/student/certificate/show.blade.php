{{-- File: resources/views/student/certificate/show.blade.php --}}
@php
    // Logika ini membuat view menjadi universal.
    // Data diambil dari objek $certificate yang dikirim oleh controller.
    $student = $certificate->student;
    $course = $certificate->course;
    $completionDate = $certificate->completed_at;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - {{ $course->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font untuk Teks Formal & Tanda Tangan Dummy --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@400;500&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        .font-serif { font-family: 'Merriweather', serif; }
        .font-signature { font-family: 'Dancing Script', cursive; }
        
        .batik-motif {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill='%23DC2626' fill-opacity='0.08'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-48 0c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48-25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
        }

        @media print {
            body { margin: 0; padding: 0; }
            .print-button-container, .verification-banner { display: none; } /* Sembunyikan banner juga saat print */
            .certificate-container {
                box-shadow: none !important;
                margin: 0 !important;
                border-width: 5px !important;
                border-color: #e5e7eb !important; /* Warna gray-200 */
                width: 100%;
                height: 100%;
                page-break-after: always;
            }
            .certificate-container h1 { font-size: 3rem; }
            .certificate-container .student-name { font-size: 2.5rem; }
            .certificate-container .course-name { font-size: 1.75rem; }
            .certificate-container .signature { font-size: 3.5rem; }

            @page {
                size: letter landscape;
                margin: 0; 
            }
        }
    </style>
</head>
<body class="bg-gray-200 flex flex-col items-center justify-center min-h-screen p-4 md:p-8">

    {{-- [START PERUBAHAN] Tampilkan tombol hanya untuk siswa yang login --}}
    @auth('student')
    <div class="print-button-container mb-4 text-center max-w-lg">
        <button onclick="window.print()" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition shadow-md">
            <i class="uil uil-print mr-2"></i>Cetak / Simpan sebagai PDF
        </button>
        <p class="text-xs text-gray-500 mt-2">Pastikan "Destination" adalah "Save as PDF", Layout "Landscape", dan centang "Background graphics" untuk hasil terbaik.</p>
    </div>
    @endauth
    {{-- [END PERUBAHAN] --}}

    {{-- [START PERUBAHAN] Tampilkan banner verifikasi untuk pengunjung publik --}}
    @guest('student')
    <div class="verification-banner mb-4 text-center max-w-lg bg-blue-100 text-blue-800 p-3 rounded-lg border border-blue-200">
        <p class="font-semibold"><i class="uil uil-check-shield"></i> Halaman Verifikasi Sertifikat</p>
        <p class="text-xs">Ini adalah halaman publik untuk memverifikasi keaslian sertifikat.</p>
    </div>
    @endguest
    {{-- [END PERUBAHAN] --}}


    {{-- Konten Sertifikat --}}
    <div class="certificate-container aspect-[297/210] w-full max-w-[1123px] bg-white shadow-2xl flex flex-col relative overflow-hidden border-4 border-gray-200 p-12">
        <div class="batik-motif absolute -top-20 -left-20 w-80 h-80 rounded-full opacity-50"></div>
        <div class="batik-motif absolute -bottom-20 -right-20 w-80 h-80 rounded-full opacity-50"></div>
        
        <div class="w-full text-center z-10">
            <i class="uil uil-award text-5xl md:text-6xl text-gray-600"></i>
            <h1 class="text-4xl md:text-5xl font-bold font-serif text-gray-800 mt-2 tracking-wide">SERTIFIKAT KELULUSAN</h1>
            <p class="text-base md:text-lg text-gray-500 mt-2">Nomor: LARAVEL/{{ $completionDate->format('Y') }}/{{ strtoupper(substr($course->id, 0, 4)) }}/{{ strtoupper(substr($certificate->id, 0, 4)) }}</p>
        </div>
        
        <div class="flex-grow flex flex-col items-center justify-center text-center z-10">
            <p class="text-xl md:text-2xl text-gray-600 mt-4">diberikan kepada:</p>
            
            <p class="student-name text-3xl md:text-4xl lg:text-5xl font-bold font-serif text-gray-700 my-6 border-b-2 border-gray-300 pb-2 px-8">
                {{ $student->name }}
            </p>

            <p class="text-lg md:text-xl text-gray-600 max-w-3xl">
                Atas partisipasi aktif dan keberhasilannya dalam menyelesaikan seluruh rangkaian materi kursus online:
            </p>

            <p class="course-name text-2xl md:text-3xl font-semibold font-serif text-gray-800 mt-4">
                "{{ $course->name }}"
            </p>
        </div>
        
        <div class="w-full flex justify-between items-end z-10">
            <div class="text-left">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ route('certificate.verify.public', $certificate->verification_token) }}" alt="QR Code Verifikasi">
                <p class="text-xs text-gray-400 mt-1">Scan untuk Verifikasi</p>
            </div>
            <div class="text-center">
                <p>Yogyakarta, {{ $completionDate->translatedFormat('d F Y') }}</p>
                <p class="signature font-signature text-5xl md:text-6xl text-gray-800 my-2">Laravel</p>
                <p class="font-bold border-t-2 border-gray-400 pt-2">Manajemen Laravel</p>
            </div>
        </div>
    </div>

</body>
</html>