@extends('layouts.course_admin')
@section('title', 'Kelola Kursus: ' . $course->name)

@section('content')
<a href="{{ route('course_admin.management.courses.index') }}" class="text-sm text-main-red hover:underline mb-4 inline-block transition duration-200">
    < Kembali ke Daftar Kursus
</a>

<div class="bg-white p-6 rounded-lg mb-6 border-2 border-gray-100">
    <div class="flex justify-between items-start">
        <div>
            @if($course->subCategory)
                <span class="text-sm font-bold text-gray-600">{{ $course->subCategory->category->name }} / {{ $course->subCategory->name }}</span>
            @else
                <span class="text-sm font-bold text-gray-400">Tidak Terkategorikan</span>
            @endif
            <h1 class="text-3xl font-bold text-dark-text mb-2">{{ $course->name }}</h1>
            <p class="text-light-text">{{ $course->description }}</p>
        </div>
        {{-- Tombol Assign Lecturer --}}
        <a href="{{ route('course_admin.management.courses.lecturers.index', $course) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold inline-flex items-center transition duration-300 whitespace-nowrap ml-4">
            <i class="uil uil-user-plus w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
            Assign Dosen
        </a>
    </div>
</div>

{{-- Tampilkan Dosen yang Ter-assign --}}
<div class="mb-8">
    <h2 class="text-2xl font-bold text-dark-text mb-3">Dosen Pengampu</h2>
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        @if($course->lecturers->isNotEmpty())
            <ul class="list-disc list-inside space-y-2">
                @foreach ($course->lecturers as $lecturer)
                    <li class="text-dark-text">{{ $lecturer->name }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-light-text">Belum ada dosen yang di-assign untuk kursus ini.</p>
        @endif
    </div>
</div>

<div class="mb-8">
    <h2 class="text-2xl font-bold text-dark-text mb-3">Tautan Follow Up</h2>
    <div class="bg-white p-4 rounded-lg border-2 border-gray-100">
        {{-- Form Tambah Cepat --}}
        <form action="{{ route('course_admin.management.courses.follow_up_links.store', $course) }}" method="POST" class="flex items-center space-x-2 mb-4 pb-4 border-b">
            @csrf
            <input type="text" name="label" placeholder="Label (e.g. Grup WhatsApp)" class="flex-1 border border-gray-300 rounded-md p-2" required>
            <input type="url" name="url" placeholder="https://..." class="flex-1 border border-gray-300 rounded-md p-2" required>
            <button type="submit" class="bg-main-red text-white px-4 py-2 rounded-md font-semibold">Tambah</button>
        </form>

        {{-- Daftar Link --}}
        <ul class="space-y-2">
            @forelse ($course->followUpLinks as $link)
                <li class="flex justify-between items-center">
                    <div>
                        <span class="font-bold">{{ $link->label }}:</span>
                        <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:underline ml-2">{{ $link->url }}</a>
                    </div>
                    <form action="{{ route('course_admin.management.follow_up_links.destroy', $link) }}" method="POST" onsubmit="return confirm('Hapus link ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-500 hover:text-gray-700">Hapus</button>
                    </form>
                </li>
            @empty
                <li class="text-light-text">Belum ada tautan follow up.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-dark-text">Daftar Topik</h2>
    <a href="{{ route('course_admin.management.courses.topics.create', $course) }}" class="bg-main-red hover:bg-dark-red text-white px-4 py-2 rounded-md font-semibold inline-flex items-center transition duration-300">
        <i class="uil uil-plus w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
        Tambah Topik
    </a>
</div>

<div class="bg-white rounded-lg overflow-hidden border-2 border-gray-100">
    <div class="divide-y divide-gray-100">
        @forelse ($course->topics as $topic)
            <div class="p-4 flex justify-between items-center">
                <div>
                    <span class="font-bold text-dark-text">Urutan {{ $topic->order }}:</span>
                    <span class="ml-2 text-lg text-dark-text">{{ $topic->title }}</span>
                </div>
                <div class="whitespace-nowrap">
                    <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-bold px-3 py-1 text-sm rounded-md inline-flex items-center transition duration-300">
                        <i class="uil uil-file-alt w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
                        Kelola Materi
                    </a>
                    <a href="{{ route('course_admin.management.courses.topics.edit', [$course, $topic]) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm ml-2 transition duration-200">Edit</a>
                    <form action="{{ route('course_admin.management.courses.topics.destroy', [$course, $topic]) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin hapus topik ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm transition duration-200">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-light-text">Belum ada topik di kursus ini.</div>
        @endforelse
    </div>
</div>
@endsection