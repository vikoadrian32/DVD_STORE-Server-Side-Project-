@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <a href="/genre/add" class="btn btn-primary">Add Genre</a>
    <table class="table table-sm table-bordered mt-4 table-dark">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $gen)
            <tr>
                <td>{{ $gen->genre_name }}</td>
                <td>
                    <a href="/genre/update/{{ $gen->id }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <a href="/genre/delete/{{ $gen->id }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>
@endsection