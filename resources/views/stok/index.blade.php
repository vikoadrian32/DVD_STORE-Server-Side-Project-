@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <a href="/stok/add" class="btn btn-primary">Add Stok</a>
    <table class="table table-sm table-bordered mt-4 table-dark">
        <thead>
            <tr>
                <th>Movie</th>
                <th>Quantity</th>
                <th>Price</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stoks as $stok)
            <tr>
                <td>{{$stok->film->title}}</td>
                <td>{{$stok->jumlah}} Pcs</td>
                {{-- <td>{{$stok->harga}}$</td> --}}
                <td>
                    <a href="/stok/update/{{$stok->id}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <a href="/stok/delete/{{$stok->id}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
 </div>
@endsection