@extends('layouts.master')

@push('head')

@endpush

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <h2>Your Translation Results </h2>
    {{-- Display results --}}
    @if (!$result['errorCode'])
        <table class='table-bordered'>
            <tr>
                <th colspan='2'>Input</th>
                <th colspan='2'>Output</th>
            </tr>
            <tr>
                <td colspan='2'>
                    {{ $result['input'] }}
                </td>
                <td colspan='2'>
                    {{ $result['output'] }}
                </td>
            </tr>
        </table>
        {{-- Handle Exceptions from the AWS Client --}}
    @else
        <h3>Error Code: {{ $result['errorCode'] }}</h3>
        <p>{{ $result['errorMessage'] }}</p>
    @endif
@endsection