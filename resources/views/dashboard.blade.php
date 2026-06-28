@extends('layouts.common')

@section('content')
    @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
        @include('dashboard.super-admin')
    @elseif(auth()->user()->hasRole('vendor'))
        @include('dashboard.vendor')
    @elseif(auth()->user()->hasRole('school'))
        @include('dashboard.school')
    @elseif(auth()->user()->hasRole('parent'))
        @include('dashboard.parent')
    @else
        @include('dashboard.default')
    @endif
@endsection
