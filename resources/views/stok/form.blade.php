@extends('layouts.admin')
@section('content')
<div class="row mt-4">
<div class="col-4 offset-4">
    <form action="/stok/save" method="post" enctype="multipart/form-data">
        @csrf
        @if (!empty($stoks?->id))
        <input type="hidden" name="id" value="{{ $stoks->id }} "/>
        @endif
         <div class="mb-3">
            <label for="films" style="color: aliceblue">Movie :</label>
            <select name="films" id="films" class="form-select" required multiple>
                @foreach ($films as $film)
                    <option value="{{ $film->id }}">{{ $film['title'] }}</option>
                    @endforeach
                </select>
        </div>   
        <div class="mb-3">
           <label for="quantity" style="color: aliceblue">Quantity :</label>
           <input type="number" name="quantity" class="form-control" value="{{ isset($stok) ? $stok?->jumlah : old('jumlah') }}" required>
        </div>
     <div class="mb-3">
         <button type="submit" class="btn btn-success">Save</button>
         <a href="/stok" class="btn btn-warning">Cancel</a>
     </div>
     <div class="mt-4">
         @if (!empty(session("error")))
             {{ session("error", "") }}
         @endif
     </div>
 </form>
</div>
</div>
@endsection