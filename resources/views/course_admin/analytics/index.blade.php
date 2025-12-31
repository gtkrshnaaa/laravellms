@extends('layouts.course_admin')
@section('title', 'Analitik Kursus')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-primary">Analitik & Laporan</h1>
            <p class="text-sm text-secondary">Pantau performa kursus dan perkembangan siswa Anda.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-border rounded-lg shadow-sm text-sm font-medium text-secondary bg-surface hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="bg-surface overflow-hidden shadow rounded-lg border border-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-secondary truncate">Total Kursus Aktif</dt>
                            <dd class="text-3xl font-bold text-primary">{{ $totalCourses }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-surface overflow-hidden shadow rounded-lg border border-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-secondary truncate">Total Siswa Terdaftar</dt>
                            <dd class="text-3xl font-bold text-primary">{{ $totalStudents }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-surface overflow-hidden shadow rounded-lg border border-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-secondary truncate">Sertifikat Diterbitkan</dt>
                            <dd class="text-3xl font-bold text-primary">{{ $totalCertificates }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Table --}}
    <div class="bg-surface shadow rounded-lg border border-border overflow-hidden">
        <div class="px-6 py-5 border-b border-border">
            <h3 class="text-lg leading-6 font-medium text-primary">Performa per Kursus</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
                <thead class="bg-secondary/5">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">Nama Kursus</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-secondary uppercase tracking-wider">Jumlah Siswa</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-secondary uppercase tracking-wider">Lulus</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-secondary uppercase tracking-wider">Completion Rate</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-surface divide-y divide-border">
                    @forelse($coursePerformance as $course)
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ $course['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary text-center">{{Number::format($course['students']) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary text-center">{{ Number::format($course['certificates']) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center">
                                <span class="text-sm font-bold {{ $course['completion_rate'] > 50 ? 'text-green-600' : 'text-yellow-600' }}">{{ $course['completion_rate'] }}%</span>
                                <div class="w-16 h-1.5 bg-gray-200 rounded-full ml-3 overflow-hidden">
                                    <div class="h-1.5 {{ $course['completion_rate'] > 75 ? 'bg-green-500' : ($course['completion_rate'] > 40 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ $course['completion_rate'] }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary">
                            @if($course['students'] == 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Belum Ada Siswa</span>
                            @elseif($course['completion_rate'] >= 80)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Excellent</span>
                            @elseif($course['completion_rate'] >= 50)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Good</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Perlu Peningkatan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-secondary font-medium">Belum ada data kursus.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
