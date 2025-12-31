@extends('layouts.admin_base')

@section('title', 'Lecturer Dashboard')

@section('sidebar')
    <a href="{{ route('lecturer.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('lecturer.dashboard') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Dashboard
    </a>

    <div class="pt-4 pb-2">
        <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Academic</p>
    </div>

    <a href="{{ route('lecturer.courses.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('lecturer.courses.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Kursus Saya
    </a>
@endsection

@section('user-info')
    <div class="flex items-center gap-3 mb-4">
        <div class="w-8 h-8 rounded-full bg-surface flex items-center justify-center text-xs font-bold border border-border">
            {{ substr(Auth::guard('lecturer')->user()->name, 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <p class="text-sm font-medium text-primary truncate">{{ Auth::guard('lecturer')->user()->name }}</p>
            <p class="text-xs text-secondary truncate">Dosen</p>
        </div>
    </div>
    <form method="POST" action="{{ route('lecturer.logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-0 text-red-500 text-xs hover:text-red-400 transition-colors font-medium">
            Sign Out
        </button>
    </form>
@endsection