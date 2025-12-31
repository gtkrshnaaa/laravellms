@extends('layouts.admin_base')

@section('title', 'SysAdmin Dashboard')

@section('sidebar')
    <a href="{{ route('sysadmin.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.dashboard') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Dashboard
    </a>

    @if(Auth::guard('sysadmin')->user()->level === 'superadmin')
    <div class="pt-4 pb-2">
        <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Super Admin</p>
    </div>
    <a href="{{ route('sysadmin.manage_sysadmin.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.manage_sysadmin.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Manage Admin
    </a>
    @endif

    <div class="pt-4 pb-2">
        <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">User Management</p>
    </div>

    <a href="{{ route('sysadmin.manage_course_admin.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.manage_course_admin.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Course Admins
    </a>
    <a href="{{ route('sysadmin.manage_lecturer.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.manage_lecturer.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Lecturers
    </a>
    <a href="{{ route('sysadmin.manage_student.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.manage_student.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Students
    </a>

    <div class="pt-4 pb-2">
        <p class="px-4 text-xs font-bold text-secondary uppercase tracking-wider">Data Master</p>
    </div>
    <a href="{{ route('sysadmin.manage-categories.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('sysadmin.manage-categories.*') ? 'bg-primary text-background' : 'text-secondary hover:text-primary hover:bg-secondary/10' }} transition-colors">
        Course Categories
    </a>
@endsection

@section('user-info')
    <div class="flex items-center gap-3 mb-4">
        <div class="w-8 h-8 rounded-full bg-surface flex items-center justify-center text-xs font-bold border border-border">
            {{ substr(Auth::guard('sysadmin')->user()->name, 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <p class="text-sm font-medium text-primary truncate">{{ Auth::guard('sysadmin')->user()->name }}</p>
            <p class="text-xs text-secondary truncate">{{ ucfirst(Auth::guard('sysadmin')->user()->level) }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('sysadmin.logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-0 text-red-500 text-xs hover:text-red-400 transition-colors font-medium">
            Sign Out
        </button>
    </form>
@endsection