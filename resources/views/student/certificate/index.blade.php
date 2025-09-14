{{-- File: resources/views/student/certificate/index.blade.php --}}
@extends('layouts.student')
@section('title', 'Sertifikat Saya')

@section('content')
    <h1 class="text-3xl font-bold text-black mb-6">Sertifikat Saya</h1>

    {{-- [START] Blok Informasi --}}
    <div class="bg-blue-50 border-l-4 border-blue-500 text-black p-4 rounded-lg mb-6" role="alert">
        <div class="flex">
            <div class="py-1"><i class="uil uil-info-circle text-2xl text-blue-500 mr-3"></i></div>
            <div>
                <p class="font-bold mb-1">Catatan Penting Mengenai Sertifikat Anda</p>
                <p class="text-sm leading-relaxed">
                    Setiap sertifikat di bawah ini adalah bukti pencapaian Anda saat <strong>pertama kali menyelesaikan</strong> sebuah kursus. Tanggal yang tertera bersifat final dan menjadi catatan historis kapan Anda pertama kali menguasai seluruh materi.
                    <br><br>
                    Jika sebuah kursus di kemudian hari mendapatkan pembaruan materi dan Anda menyelesaikannya kembali hingga 100%, itu adalah <strong>tanda luar biasa dari komitmen Anda untuk terus belajar dan berkembang</strong>. Meskipun tanggal pada sertifikat tidak berubah, semangat Anda untuk tetap <i>up-to-date</i> adalah pencapaian tersendiri!
                </p>
            </div>
        </div>
    </div>
    {{-- [END] Blok Informasi --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($certificates as $certificate)
            <div class="bg-white rounded-lg border border-blue-100 overflow-hidden group flex flex-col">
                <img src="{{ $certificate->course->thumbnail ? Storage::url($certificate->course->thumbnail) : 'https://placehold.co/600x400/3B82F6/FFFFFF?text=Course' }}" alt="{{ $certificate->course->name }}" class="w-full h-48 object-cover">
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-black truncate">{{ $certificate->course->name }}</h2>
                    <p class="text-sm text-gray-600 mt-2">
                        <i class="uil uil-calendar-alt"></i>
                        Diperoleh pada: {{ $certificate->completed_at->translatedFormat('d F Y') }}
                    </p>
                    <div class="mt-auto pt-4">
                        <a href="{{ route('student.course.certificate', $certificate->course) }}" target="_blank" class="inline-block w-full text-center px-4 py-3 rounded-lg bg-green-600 text-white font-bold hover:bg-green-700 transition-colors">
                            <i class="uil uil-award"></i> Lihat Sertifikat
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-8 rounded-lg border border-blue-100 text-center">
                <p class="text-black">Anda belum memiliki sertifikat. Selesaikan kursus untuk mendapatkannya!</p>
                <a href="{{ route('student.enrolled_course.index') }}" class="mt-4 inline-block px-6 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors">
                    Lihat Kursus Saya
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $certificates->links() }}
    </div>
@endsection