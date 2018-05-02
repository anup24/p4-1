@extends('layouts.master')

@push('head')

@endpush

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <h2>Delete Translation #{{ $entry['id'] }}?</h2>

    <p>Are you <em>sure</em> you want to delete this translation?</p>

    @include('modules.translation')

    <div class='btn-danger' id='deleteEntry'>
        Yes, Delete
    </div>

    <p>No, please <a href='/translations'>take me back home</a>.</p>

@endsection