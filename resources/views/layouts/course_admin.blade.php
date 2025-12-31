@extends('layouts.admin_base')

@section('title', 'Course Admin Dashboard')

@section('sidebar')
    <a href="{{ route('course_admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('course_admin.dashboard') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Dashboard
    </a>

    <div class="pt-4 pb-2">
        <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Management</p>
    </div>

    <a href="{{ route('course_admin.management.courses.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('course_admin.management.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Manajemen Kursus
    </a>
    <a href="{{ route('course_admin.analytics.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('course_admin.analytics.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Analitik & Laporan
    </a>

    <div class="mt-8 mx-4 p-4 rounded-lg bg-surface border border-border">
        <p class="text-xs font-medium text-primary mb-2">Pratinjau</p>
        <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-center w-full px-3 py-2 text-xs font-medium text-background bg-primary rounded-md hover:bg-primary/90 transition-colors">
            Lihat Website
        </a>
    </div>
@endsection

@section('user-info')
    <div class="flex items-center gap-3 mb-4">
        <div class="w-8 h-8 rounded-full bg-surface flex items-center justify-center text-xs font-bold border border-border">
            {{ substr(Auth::guard('courseadmin')->user()->name, 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <p class="text-sm font-medium text-primary truncate">{{ Auth::guard('courseadmin')->user()->name }}</p>
            <p class="text-xs text-secondary truncate">Course Admin</p>
        </div>
    </div>
    <form method="POST" action="{{ route('course_admin.logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-0 text-red-500 text-xs hover:text-red-400 transition-colors font-medium">
            Sign Out
        </button>
    </form>
@endsection