@extends('layouts.course_admin')
@section('title', 'Manajemen Kursus')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">Manajemen Kursus</h2>
        <p class="text-secondary text-sm">Kelola materi pembelajaran, topik, dan siswa untuk kursus Anda.</p>
    </div>
    <a href="{{ route('course_admin.management.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-background uppercase tracking-widest hover:bg-primary/90 active:bg-primary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
        + Buat Kursus Baru
    </a>
</div>

<div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-secondary/5 border-b border-border">
                <tr>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Thumbnail</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Nama Kursus</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Harga</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs">Kategori</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-center">Topik</th>
                    <th class="px-6 py-4 font-semibold text-secondary uppercase tracking-wider text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse ($courses as $course)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}" class="w-20 h-14 object-cover rounded-md border border-border">
                            @else
                                <div class="w-20 h-14 bg-secondary/10 rounded-md flex items-center justify-center border border-border">
                                    <svg class="w-6 h-6 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-primary font-medium">{{ $course->name }}</div>
                            <div class="text-secondary text-xs mt-0.5">Dibuat: {{ $course->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Gratis
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary">
                            @if($course->subCategory)
                                <span class="text-primary font-medium">{{ $course->subCategory->category->name }}</span>
                                <span class="text-secondary/50 mx-1">/</span>
                                <span>{{ $course->subCategory->name }}</span>
                            @else
                                <span class="text-secondary/50 italic">- (Tidak ada)</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-background border border-border text-secondary">
                                {{ $course->topics_count }} Topik
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2 text-right whitespace-nowrap">
                            <a href="{{ route('course_admin.management.courses.show', $course) }}" class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 hover:text-green-800 hover:bg-green-100 border border-green-200 rounded-lg text-xs font-medium transition-colors">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Kelola Konten
                            </a>
                            <a href="{{ route('course_admin.management.courses.edit', $course) }}" class="text-blue-500 hover:text-blue-600 transition-colors font-medium text-xs">Edit</a>
                            <form action="{{ route('course_admin.management.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kursus ini? Semua topik dan materi di dalamnya akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-medium ml-2 text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-secondary">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block mb-2 text-3xl text-secondary/20">📚</span>
                                <span class="block font-medium">Anda belum membuat kursus.</span>
                                <span class="text-xs mt-1">Klik tombol "Buat Kursus Baru" di atas untuk memulai.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $courses->links() }}
</div>
@endsection