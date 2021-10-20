@extends('layouts.main')

@section('title', 'Datatable')


@section('content')
    <h2>Top secret datum database.</h2>

    {{-- Filter part starts --}}
    <div class="row">
        <form class="row g-3">
            <div class="col-auto">
                <label for="birthYear" class="visually-hidden">Birth Year</label>
                <input type="text" class="form-control" id="birthYear" placeholder="Birth Year">
            </div>
            <div class="col-auto">
                <label for="birthMonth" class="visually-hidden">Birth Month</label>
                <input type="text" class="form-control" id="birthMonth" placeholder="Birth Month">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-warning mb-3">Filter</button>
            </div>
        </form>
    </div>
    {{-- Filter part ends --}}

    {{-- Datatable starts --}}
    @if (count($users) > 0)
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Phone</th>
                    <th scope="col">IP</th>
                    <th scope="col">Country</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->ip }}</td>
                        <td>{{ $user->country }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p> No data to load. </p>
    @endif
    {{-- Datatable ends --}}
@stop
