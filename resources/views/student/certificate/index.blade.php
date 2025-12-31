@extends('layouts.student')
@section('title', 'Sertifikat Saya')

@section('content')
    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 mb-8">Sertifikat Saya</h1>

    {{-- [START] Blok Informasi --}}
    <div class="bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 p-6 rounded-2xl mb-8 flex items-start gap-4">
        <div class="p-1 bg-blue-500/10 rounded-lg shrink-0">
            <i class="uil uil-info-circle text-2xl text-blue-500"></i>
        </div>
        <div>
            <p class="font-bold mb-2 text-lg">Catatan Penting Mengenai Sertifikat Anda</p>
            <p class="text-sm leading-relaxed opacity-90">
                Setiap sertifikat di bawah ini adalah bukti pencapaian Anda saat <strong>pertama kali menyelesaikan</strong> sebuah kursus. Tanggal yang tertera bersifat final dan menjadi catatan historis kapan Anda pertama kali menguasai seluruh materi.
                <br><br>
                Jika sebuah kursus di kemudian hari mendapatkan pembaruan materi dan Anda menyelesaikannya kembali hingga 100%, itu adalah <strong>tanda luar biasa dari komitmen Anda untuk terus belajar dan berkembang</strong>. Meskipun tanggal pada sertifikat tidak berubah, semangat Anda untuk tetap <i>up-to-date</i> adalah pencapaian tersendiri!
            </p>
        </div>
    </div>
    {{-- [END] Blok Informasi --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($certificates as $certificate)
            <div class="bg-surface rounded-2xl border border-border overflow-hidden group flex flex-col hover:border-primary/20 transition-all duration-300 shadow-sm hover:shadow-md">
                <div class="relative overflow-hidden aspect-video">
                    <img src="{{ $certificate->course->thumbnail ? Storage::url($certificate->course->thumbnail) : 'https://placehold.co/600x400/18181b/ffffff?text=Course' }}" alt="{{ $certificate->course->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-primary truncate group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-secondary transition-all">{{ $certificate->course->name }}</h2>
                    <p class="text-sm text-secondary mt-3 flex items-center gap-2">
                        <i class="uil uil-calendar-alt text-primary/50"></i>
                        <span>Diperoleh pada: <span class="font-semibold text-primary">{{ $certificate->completed_at->translatedFormat('d F Y') }}</span></span>
                    </p>
                    <div class="mt-auto pt-6">
                        <a href="{{ route('student.course.certificate', $certificate->course) }}" target="_blank" class="inline-flex justify-center items-center w-full px-4 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20 hover:-translate-y-0.5">
                            <i class="uil uil-award mr-2"></i> Lihat Sertifikat
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface p-12 rounded-2xl border border-dashed border-border text-center">
                <div class="w-20 h-20 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="uil uil-award text-4xl text-secondary"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Belum Ada Sertifikat</h3>
                <p class="text-secondary max-w-sm mx-auto mb-8">Anda belum memiliki sertifikat. Selesaikan kursus untuk mendapatkannya!</p>
                <a href="{{ route('student.enrolled_course.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <i class="uil uil-book-open mr-2"></i> Lihat Kursus Saya
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $certificates->links() }}
    </div>
@endsection