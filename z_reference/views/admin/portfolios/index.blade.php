@extends('layouts.admin')

@section('title', 'Portfolio')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">Portfolio</h1>
        <p class="text-secondary">Kelola showcase project dan hasil karya.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.portfolios.create') }}" class="flex items-center gap-2 bg-primary text-background font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Portfolio
        </a>
    </div>
</div>

@if(session('success'))
<div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    {{ session('success') }}
</div>
@endif

@if($portfolios->count() > 0)
<div class="bg-surface border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-background border-b border-border">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Order</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Image</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Project Info</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-primary uppercase">Tech Stack</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-primary uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach($portfolios as $portfolio)
                <tr class="hover:bg-background/50 transition-colors">
                    <td class="px-6 py-4 text-secondary">
                        {{ $portfolio->display_order }}
                    </td>
                    <td class="px-6 py-4">
                        @if($portfolio->image_path)
                            <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-16 h-10 object-cover rounded shadow-sm border border-border">
                        @else
                            <div class="w-16 h-10 bg-background border border-border rounded flex items-center justify-center text-secondary text-xs">
                                No Img
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-primary">{{ $portfolio->title }}</div>
                        @if($portfolio->demo_url)
                            <a href="{{ $portfolio->demo_url }}" target="_blank" class="text-xs text-blue-500 hover:underline flex items-center gap-1 mt-0.5">
                                View Demo 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                    <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($portfolio->tech_stack ?? [] as $tech)
                                <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-secondary/10 text-secondary border border-secondary/20">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="text-secondary hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus portfolio ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-secondary hover:text-red-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="bg-surface border border-border rounded-xl p-12 text-center">
    <div class="w-16 h-16 bg-surface border border-border rounded-full flex items-center justify-center mx-auto mb-4 text-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
    </div>
    <h3 class="text-xl font-bold text-primary mb-2">Belum ada portfolio</h3>
    <p class="text-secondary mb-6">Tambahkan project showcase pertamamu.</p>
    <a href="{{ route('admin.portfolios.create') }}" class="inline-block bg-primary text-background font-bold py-2 px-6 rounded-lg hover:opacity-90 transition-opacity">
        Tambah Sekarang
    </a>
</div>
@endif
@endsection
