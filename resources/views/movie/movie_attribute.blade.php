@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="col-4 offset-4">
        <form action="/movie/attribute/save" method="post" enctype="multipart/form-data">
            @csrf
            @if (!empty($film?->id))
            <input type="hidden" name="id" value="{{ $film->id }}"/>
            @endif
            <div class="mb-3">
                <label for="films" style="color: aliceblue">Movie :</label>
                <select name="films" id="films" class="form-select" required >
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}">{{ $film['title'] }}</option>
                        @endforeach
                    </select>
            </div>   
            <div class="mb-3">
                <label for="photo"  style="color: aliceblue">Upload Poster Movie</label>
               <input type="file" name="photo"  style="color: white" required>
            </div>
            <div class="mb-3">
                <label for="video"  style="color: aliceblue">Upload Trailer Movie </label>
               <input type="file" name="video" required style="color: white">
            </div>
            <div class="mb-3">
                <label for="thumbnail"  style="color: aliceblue">Upload Thumbnail Trailer </label>
               <input type="file" name="thumbnail" required style="color: white">
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
                <a href="/admin" class="btn btn-warning">Cancel</a>
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