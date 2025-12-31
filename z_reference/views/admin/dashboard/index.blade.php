@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary mb-2">Ruang Kendali</h2>
        <p class="text-secondary">Overview performa platform kamu.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Widget 1 -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Produk</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalProducts }}</p>
                <span class="text-xs text-green-400 mb-1">Items</span>
            </div>
        </div>

        <!-- Widget 2 -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Kategori</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalCategories }}</p>
                <span class="text-xs text-purple-400 mb-1">Tags</span>
            </div>
        </div>

        <!-- Widget 3 -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Sobat Belajar</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $totalBuyers }}</p>
                <span class="text-xs text-secondary mb-1">Users</span>
            </div>
        </div>

        <!-- Widget 4 (Analytics) -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-500/10 rounded-full blur-2xl group-hover:bg-red-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Visitor Hari Ini</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $visitorsToday }}</p>
                <span class="text-xs text-red-500 mb-1">Orang</span>
            </div>
        </div>
    </div>

    <!-- Charts & Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Main Chart -->
        <div class="lg:col-span-2 bg-surface border border-border rounded-xl p-6 shadow-sm">
            <h3 class="text-primary font-bold mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
                Traffic Monitor (7 Hari Terakhir)
            </h3>
            <div class="h-64">
                <canvas id="trafficChart"></canvas>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-surface border border-border rounded-xl p-6 shadow-sm">
            <h3 class="text-primary font-bold mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Produk Paling Hype
            </h3>
            <div class="space-y-4">
                @foreach($topProducts as $product)
                <div class="flex items-center gap-4 group">
                    <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center text-xs font-bold text-secondary border border-border">
                        {{ $loop->iteration }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-primary truncate group-hover:text-blue-400 transition-colors">{{ $product->title }}</p>
                        <p class="text-xs text-secondary">{{ $product->views_count }} views</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Spies (Activity) -->
        <div class="lg:col-span-3 bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-border">
                <h3 class="text-primary font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Aktivitas Terbaru
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-secondary uppercase bg-secondary/5">
                        <tr>
                            <th class="px-6 py-3">IP Address</th>
                            <th class="px-6 py-3">Route / URL</th>
                            <th class="px-6 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($recentActivity as $activity)
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs">{{ $activity->ip_address }}</td>
                            <td class="px-6 py-4 text-primary">
                                {{ $activity->route_name ?? Str::limit($activity->url, 50) }}
                                @if($activity->product_id)
                                    <span class="ml-2 px-2 py-0.5 rounded-full bg-blue-500/20 text-blue-400 text-[10px] font-bold">Product View</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-secondary">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('trafficChart').getContext('2d');
        const labels = {!! json_encode($trafficData->pluck('date')) !!};
        const data = {!! json_encode($trafficData->pluck('count')) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Unique Visitors',
                    data: data,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgb(var(--color-surface))',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(var(--color-background) / 0.9)',
                        titleColor: 'rgb(var(--color-primary))',
                        bodyColor: 'rgb(var(--color-secondary))',
                        borderColor: 'rgb(var(--color-border))',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgb(var(--color-border))' },
                        ticks: { color: 'rgb(var(--color-secondary))' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: 'rgb(var(--color-secondary))' }
                    }
                }
            }
        });
    </script>
@endsection
