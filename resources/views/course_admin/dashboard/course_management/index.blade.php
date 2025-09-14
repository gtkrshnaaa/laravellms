@extends('layouts.course_admin')
@section('title', 'Manajemen Kursus')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-black">Manajemen Kursus</h1>
    <a href="{{ route('course_admin.management.courses.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold transition duration-300 inline-flex items-center">
        {{-- Unicons Plus --}}
        <i class="uil uil-plus w-4 h-4 mr-1 flex items-center justify-center text-base"></i>
        Buat Kursus Baru
    </a>
</div>

<div class="bg-white rounded-lg overflow-hidden border border-blue-100">
    <table class="w-full">
        <thead class="bg-blue-50">
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Thumbnail</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Nama Kursus</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Harga Kursus</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Kategori</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Jumlah Topik</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Dibuat Pada</th>
                <th class="p-4 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-blue-100">
            @forelse ($courses as $course)
                <tr>
                    <td class="p-4">
                        @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="w-24 h-16 object-cover rounded-md">
                        @else
                            <div class="w-24 h-16 bg-blue-50 rounded-md flex items-center justify-center border border-blue-100">
                                <span class="text-xs text-gray-600">No Image</span>
                            </div>
                        @endif
                    </td>
                    <td class="p-4 font-medium text-black">{{ $course->name }}</td>
                    <td class="p-4 font-medium text-black">
                        <span class="p-4 font-medium text-green-600">Gratis</span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        @if($course->subCategory)
                            {{ $course->subCategory->category->name }} / {{ $course->subCategory->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-4 text-gray-600">{{ $course->topics_count }} Topik</td>
                    <td class="p-4 text-sm text-gray-600">{{ $course->created_at->format('d M Y') }}</td>
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
                    <td colspan="4" class="p-4 text-center text-gray-600">Anda belum membuat kursus.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $courses->links() }}
</div>
@endsection