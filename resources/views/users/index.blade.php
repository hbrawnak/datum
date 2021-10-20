@extends('layouts.main')

@section('title', 'Datatable')


@section('content')
    <h2>Top secret datum database.</h2>

    {{-- Filter part starts --}}
    <div class="row">
        <form class="row g-3">
            <div class="col-auto">
                <label for="birthYear" class="visually-hidden">Birth Year</label>
                <input type="text" class="form-control" id="birthYear" placeholder="1995">
            </div>
            <div class="col-auto">
                <label for="birthMonth" class="visually-hidden">Birth Month</label>
                <input type="text" class="form-control" id="birthMonth" placeholder="12">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-warning mb-3">Filter</button>
            </div>
        </form>
    </div>
    {{-- Filter part ends --}}

    {{-- Datatable starts --}}
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">ID</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>
    {{-- Datatable ends --}}
@stop
