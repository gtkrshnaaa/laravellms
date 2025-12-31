@extends('layouts.admin')

@section('title', 'Pengaturan Layanan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">Pengaturan Layanan</h1>
            <p class="text-secondary">Kelola kuota, limitasi, dan visibilitas layanan publik.</p>
        </div>
    </div>

    <form action="{{ route('admin.service.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quota & Limits -->
            <div class="bg-surface border border-border rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-6 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                    <h2 class="font-bold text-lg">Kuota & Limitasi</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">Kuota Project Mingguan (Weekly Limit)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="weekly_project_limit" value="{{ $settings->weekly_project_limit }}" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary text-sm" min="1">
                            <span class="text-sm text-secondary whitespace-nowrap">Slot/Minggu</span>
                        </div>
                        <p class="text-xs text-secondary mt-1">
                            Jumlah maksimal order baru yang diterima per minggu. Mempengaruhi progress bar di homepage.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">Maksimal Project Berjalan (Ongoing Cap)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="max_ongoing_projects" value="{{ $settings->max_ongoing_projects }}" class="w-full bg-background border border-border text-primary rounded-lg px-4 py-2 focus:outline-none focus:border-primary text-sm" min="1">
                            <span class="text-sm text-secondary whitespace-nowrap">Active Projects</span>
                        </div>
                        <p class="text-xs text-secondary mt-1">
                            Batas maksimal project status 'In Progress' secara bersamaan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Visibility & Automation -->
            <div class="bg-surface border border-border rounded-xl p-6 shadow-sm h-fit">
                <div class="flex items-center gap-2 mb-6 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h2 class="font-bold text-lg">Visibilitas & Otomatisasi</h2>
                </div>

                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-background border border-border rounded-lg">
                        <div>
                            <span class="block font-medium text-primary">Tampilkan Antrian Publik</span>
                            <span class="text-xs text-secondary">Tampilkan list "Currently Cooking" di halaman detail.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_queue_publicly" value="1" class="sr-only peer" {{ $settings->show_queue_publicly ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-surface peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary border border-border"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-background border border-border rounded-lg">
                        <div>
                            <span class="block font-medium text-primary">Auto Close If Full</span>
                            <span class="text-xs text-secondary">Otomatis tutup layanan jika kuota terpenuhi.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="auto_close_when_full" value="1" class="sr-only peer" {{ $settings->auto_close_when_full ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-surface peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary border border-border"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="w-full md:w-auto bg-primary text-background font-bold py-3 px-6 rounded-lg hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
