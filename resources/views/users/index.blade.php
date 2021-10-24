@extends('layouts.main')

@section('title', 'Datatable')


@section('content')
    <h2>Top secret datum database.</h2>

    {{-- Filter part starts --}}
    @include('users.partials._filter')
    {{-- Filter part ends --}}

    {{-- Datatable starts --}}
    @include('users.partials._users_datatable', ['users' => $users])
    {{-- Datatable ends --}}
@stop
