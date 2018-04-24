@extends('layouts.master')

@push('head')
    {{-- Custom CSS --}}
    <link href='/css/p3_style.css' type='text/css' rel='stylesheet'>
@endpush

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <h2>Babel: Translation</h2>


@endsection



