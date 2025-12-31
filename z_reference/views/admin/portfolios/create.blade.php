@extends('layouts.admin')

@section('title', 'Tambah Portfolio')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.portfolios.index') }}" class="text-secondary hover:text-primary transition-colors flex items-center gap-2 mb-4 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Portfolio
        </a>
        <h1 class="text-3xl font-bold text-primary">Tambah Portfolio</h1>
        <p class="text-secondary">Showcase project keren kamu ke dunia.</p>
    </div>

    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="bg-surface border border-border rounded-xl p-6 shadow-sm">
        @csrf

        <div class="space-y-6">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-primary mb-2">Judul Project</label>
                <input type="text" name="title" required value="{{ old('title') }}" 
                       class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary placeholder-secondary/50"
                       placeholder="Contoh: E-Commerce Platform v2">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-primary mb-2">Deskripsi</label>
                <textarea name="description" rows="4" 
                          class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary placeholder-secondary/50"
                          placeholder="Jelaskan tentang project ini...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Image & Demo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Thumbnail Image</label>
                    <input type="file" name="image_path" accept="image/*"
                           class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="text-xs text-secondary mt-1">Recommended size: 800x600px (Max 2MB)</p>
                    @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Demo URL (Optional)</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url') }}" 
                           class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary placeholder-secondary/50"
                           placeholder="https://example.com">
                    @error('demo_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Tech Stack -->
            <div x-data="{ tags: [], input: '' }" class="space-y-2">
                <label class="block text-sm font-medium text-primary">Tech Stack</label>
                
                <!-- Hidden Input for Form Submission -->
                <input type="hidden" name="tech_stack" :value="tags.join(',')">
                
                <div class="flex flex-wrap gap-2 p-2 bg-background border border-border rounded-lg min-h-[50px] items-center">
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary border border-primary/20 px-2 py-1 rounded text-sm">
                            <span x-text="tag"></span>
                            <button type="button" @click="tags.splice(index, 1)" class="hover:text-red-500 text-primary/50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </span>
                    </template>
                    
                    <input type="text" x-model="input" @keydown.enter.prevent="if(input.trim()) { tags.push(input.trim()); input = '' }" 
                           @keydown.delete="if(input === '' && tags.length > 0) { tags.pop() }"
                           class="bg-transparent border-none outline-none focus:ring-0 text-primary text-sm min-w-[120px]"
                           placeholder="Type tag & Enter (e.g., Laravel)">
                </div>
                <p class="text-xs text-secondary">Press Enter to add tags. Example: Laravel, Vue, Tailwind.</p>
            </div>

            <!-- Display Order -->
            <div>
                <label class="block text-sm font-medium text-primary mb-2">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', 0) }}" 
                       class="w-full bg-background border border-border text-primary rounded-lg px-4 py-3 focus:outline-none focus:border-primary md:w-32">
                <p class="text-xs text-secondary mt-1">Lower number shows first.</p>
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-primary text-background font-bold py-3 px-8 rounded-lg hover:opacity-90 transition-opacity">
                Simpan Portfolio
            </button>
        </div>
    </form>
</div>
@endsection
