@extends('layouts.admin')

@section('content')
<div class="row mt-4">
   <div class="col-4 offset-4">
       <form action="/genre/save" method="post">
           @csrf
           @if (!empty($genre?->id))
           <input type="hidden" name="id" value="{{ $genre->id }}"/>
           @endif
           <div class="mb-3">
               <label for="genre_name" class="form-label" style="color: aliceblue">Genre Name</label>
               <input type="text" name="genre_name" class="form-control"
                   placeholder="Enter Genre Name"
                   value="{{ isset($genre) ? $genre?->name : old('name') }}"/>
           </div>
           @if(session('errors'))
           <div class="alert alert-danger">
               <ul>
                   @foreach(session('errors') as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
       @endif
           <div class="mb-3">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="/genre" class="btn btn-warning">Cancel</a>
        </div>
        <div class="mt-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </form>
</div>
</div>
@endsection