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

    <form method='POST' action='/translations/{{ $entry['id'] }}/delete'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes, annihilate!' class='btn-danger btn-sm'>
    </form>

    <p id='cancel'>
        No, <a href='/translations'>take me back home</a>.
    </p>

@endsection