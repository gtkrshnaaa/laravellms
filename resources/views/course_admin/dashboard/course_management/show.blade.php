@extends('layouts.course_admin')
@section('title', 'Kelola Kursus: ' . $course->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('course_admin.management.courses.index') }}" class="inline-flex items-center text-sm text-secondary hover:text-primary transition-colors mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Kursus
    </a>

    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                @if($course->subCategory)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">{{ $course->subCategory->category->name }}</span>
                    <span class="text-secondary/50 text-xs">/</span>
                    <span class="text-secondary text-xs font-medium">{{ $course->subCategory->name }}</span>
                @else
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-secondary/10 text-secondary">Uncategorized</span>
                @endif
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ $course->name }}</h1>
            <p class="text-secondary max-w-3xl leading-relaxed">{{ $course->description }}</p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
             <a href="{{ route('course_admin.management.courses.lecturers.index', $course) }}" class="inline-flex items-center px-4 py-2 bg-surface border border-border rounded-lg font-semibold text-xs text-secondary uppercase tracking-widest hover:text-primary hover:border-primary transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Assign Dosen
            </a>
            <a href="{{ route('course_admin.management.courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 bg-primary text-background rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-primary/90 transition-colors">
                Edit Kursus
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Column: Topics --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-primary flex items-center gap-2">
                <span class="p-1.5 bg-primary/10 rounded-lg text-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </span>
                Kurikulum & Topik
            </h2>
            <a href="{{ route('course_admin.management.courses.topics.create', $course) }}" class="inline-flex items-center px-3 py-1.5 bg-primary/10 text-primary border border-primary/20 rounded-lg font-semibold text-xs hover:bg-primary/20 transition-colors">
                + Tambah Topik
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl shadow-sm overflow-hidden">
            <div class="divide-y divide-border">
                @forelse ($course->topics as $topic)
                    <div class="p-4 hover:bg-primary/5 transition-colors group">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold text-xs font-mono">
                                    {{ $topic->order }}
                                </span>
                                <h3 class="font-bold text-primary text-lg">{{ $topic->title }}</h3>
                            </div>
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('course_admin.management.courses.topics.edit', [$course, $topic]) }}" class="text-secondary hover:text-blue-600 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('course_admin.management.courses.topics.destroy', [$course, $topic]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus topik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-secondary hover:text-red-500 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="pl-9">
                            <a href="{{ route('course_admin.management.topics.materials', $topic) }}" class="inline-flex items-center text-sm text-primary font-medium hover:underline">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Kelola Materi Pembelajaran
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-secondary">
                        <div class="flex flex-col items-center justify-center">
                            <span class="block mb-2 text-3xl opacity-30">🗂️</span>
                            <span class="block font-medium">Belum ada topik.</span>
                            <span class="text-xs">Klik tombol "Tambah Topik" untuk memulai.</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Right Column: Side Widgets --}}
    <div class="space-y-6">
        {{-- Lecturers Widget --}}
        <div class="bg-surface border border-border rounded-xl p-5 shadow-sm">
            <h3 class="font-bold text-primary mb-3 text-sm uppercase tracking-wider">Dosen Pengampu</h3>
            @if($course->lecturers->isNotEmpty())
                <ul class="space-y-3">
                    @foreach ($course->lecturers as $lecturer)
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold text-xs">
                                {{ substr($lecturer->name, 0, 2) }}
                            </div>
                            <span class="text-sm font-medium text-primary">{{ $lecturer->name }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-4 bg-background rounded-lg border border-border border-dashed">
                    <p class="text-xs text-secondary">Belum ada dosen.</p>
                    <a href="{{ route('course_admin.management.courses.lecturers.index', $course) }}" class="text-xs text-primary font-medium hover:underline mt-1 block">Assign Dosen</a>
                </div>
            @endif
        </div>

        {{-- Follow Up Links Widget --}}
        <div class="bg-surface border border-border rounded-xl p-5 shadow-sm">
            <h3 class="font-bold text-primary mb-3 text-sm uppercase tracking-wider">Tautan Follow Up</h3>
            
            {{-- Form --}}
            <form action="{{ route('course_admin.management.courses.follow_up_links.store', $course) }}" method="POST" class="mb-4">
                @csrf
                <div class="space-y-2">
                    <input type="text" name="label" placeholder="Label (e.g. Grup WA)" class="w-full bg-background border border-border rounded-lg px-3 py-2 text-xs text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                    <input type="url" name="url" placeholder="https://..." class="w-full bg-background border border-border rounded-lg px-3 py-2 text-xs text-primary focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                    <button type="submit" class="w-full bg-primary text-background py-2 rounded-lg text-xs font-bold hover:bg-primary/90 transition-colors">
                        + Tambah Link
                    </button>
                </div>
            </form>

            <ul class="space-y-2">
                @forelse ($course->followUpLinks as $link)
                    <li class="group flex items-center justify-between text-sm p-2 rounded hover:bg-background transition-colors border border-transparent hover:border-border">
                        <div class="flex items-center gap-2 overflow-hidden">
                            <span class="font-bold text-secondary text-xs shrink-0">{{ $link->label }}</span>
                            <a href="{{ $link->url }}" target="_blank" class="text-primary hover:underline truncate text-xs">{{ $link->url }}</a>
                        </div>
                        <form action="{{ route('course_admin.management.follow_up_links.destroy', $link) }}" method="POST" onsubmit="return confirm('Hapus link ini?')" class="opacity-0 group-hover:opacity-100 transition-opacity">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-secondary hover:text-red-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="text-xs text-secondary text-center italic py-2">Belum ada tautan.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection