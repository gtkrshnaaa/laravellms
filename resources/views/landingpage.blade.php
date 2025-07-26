{{-- resources/views/landingpage.blade.php --}}
@extends('layouts.app')

@section('title', 'Belajar Apapun, Kapanpun - LMS Laravel')

@section('content')
    
    @include('layouts.section.landingpage.heroSection')
    @include('layouts.section.landingpage.courseSection')

@endsection