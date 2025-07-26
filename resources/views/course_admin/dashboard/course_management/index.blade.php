@extends('layouts.course_admin')
@section('title', 'Manajemen Kursus')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-dark-text">Manajemen Kursus</h1>
    <a href="{{ route('course_admin.management.courses.create') }}" class="bg-main-red hover:bg-dark-red text-white px-4 py-2 rounded-md font-semibold transition duration-300 inline-flex items-center">
        {{-- Unicons Plus --}}
        <i class="uil uil-plus w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
        Buat Kursus Baru
    </a>
</div>

<div class="bg-white rounded-lg overflow-hidden border-2 border-gray-100">
    <table class="w-full">
        <thead class="bg-light-gray-cream">
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Thumbnail</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Nama Kursus</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Harga Kursus</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Kategori</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Jumlah Topik</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Dibuat Pada</th>
                <th class="p-4 text-left text-sm font-semibold text-dark-text">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($courses as $course)
                <tr>
                    <td class="p-4">
                        @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="w-24 h-16 object-cover rounded-md">
                        @else
                            <div class="w-24 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                <span class="text-xs text-gray-500">No Image</span>
                            </div>
                        @endif
                    </td>
                    <td class="p-4 font-medium text-dark-text">{{ $course->name }}</td>
                    <td class="p-4 font-medium text-dark-text">
                        <span class="p-4 font-medium text-green-600">Gratis</span>
                    </td>
                    <td class="p-4 text-sm text-light-text">
                        @if($course->subCategory)
                            {{ $course->subCategory->category->name }} / {{ $course->subCategory->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-4 text-light-text">{{ $course->topics_count }} Topik</td>
                    <td class="p-4 text-sm text-light-text">{{ $course->created_at->format('d M Y') }}</td>
                    <td class="p-4 whitespace-nowrap">
                        <a href="{{ route('course_admin.management.courses.show', $course) }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-bold px-3 py-1 text-sm rounded-md inline-flex items-center transition duration-300">
                            {{-- Unicons Folder Open --}}
                            <i class="uil uil-folder-open w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
                            Kelola
                        </a>
                        <a href="{{ route('course_admin.management.courses.edit', $course) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm ml-2 transition duration-200">Edit</a>
                        <form action="{{ route('course_admin.management.courses.destroy', $course) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin hapus kursus ini? Semua topik dan materi di dalamnya akan ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-gray-800 font-semibold text-sm transition duration-200">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-light-text">Anda belum membuat kursus.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $courses->links() }}
</div>
@endsection