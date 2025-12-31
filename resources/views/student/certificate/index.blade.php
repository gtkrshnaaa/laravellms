@extends('layouts.student')
@section('title', 'Sertifikat Saya')

@section('content')
    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 mb-8">Sertifikat Saya</h1>

    {{-- [START] Blok Informasi --}}
    <div class="bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 p-6 rounded-2xl mb-8 flex items-start gap-4">
        <div class="p-1 bg-blue-500/10 rounded-lg shrink-0">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                        <svg class="w-4 h-4 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Diperoleh pada: <span class="font-semibold text-primary">{{ $certificate->completed_at->translatedFormat('d F Y') }}</span></span>
                    </p>
                    <div class="mt-auto pt-6 flex gap-2">
                        <a href="{{ route('student.course.certificate', $certificate->course) }}" target="_blank" class="flex-1 inline-flex justify-center items-center px-4 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20 hover:-translate-y-0.5 text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Lihat
                        </a>
                        <a href="{{ route('student.course.certificate.download', $certificate->course) }}" class="flex-none inline-flex justify-center items-center px-4 py-3 rounded-xl bg-primary text-white font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5" title="Download PDF">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface p-12 rounded-2xl border border-dashed border-border text-center">
                <div class="div w-20 h-20 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Belum Ada Sertifikat</h3>
                <p class="text-secondary max-w-sm mx-auto mb-8">Anda belum memiliki sertifikat. Selesaikan kursus untuk mendapatkannya!</p>
                <a href="{{ route('student.enrolled_course.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-primary text-background font-bold hover:bg-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg> Lihat Kursus Saya
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $certificates->links() }}
    </div>
@endsection