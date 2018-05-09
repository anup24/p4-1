@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <h2>All Translations</h2>

    @foreach ($translations as $entry)
        {{--Display results --}}
        @include('modules.translation')
        <hr />
    @endforeach

@endsection