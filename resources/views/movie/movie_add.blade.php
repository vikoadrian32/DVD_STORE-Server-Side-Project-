@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="col-4 offset-4">
        <form action="/movie/save" method="post" enctype="multipart/form-data">
            @csrf
            @if (!empty($film?->id))
            <input type="hidden" name="id" value="{{ $film->id }}"/>
            @endif
            <div class="mb-3">
                <label for="title" style="color: aliceblue">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ isset($film) ? $film?->title : old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="director"  style="color: aliceblue">Director:</label>
                <input type="text" name="director" id="director" class="form-control" value="{{ isset($film) ? $film?->director : old('director') }}" required>
            </div>
        
            <div class="mb-3">
                <label for="time"  style="color: aliceblue">Duration:</label>
                    <input type="text" name="duration" value="{{ isset($film) ? $film?->duration : old('duration') }}">
            </div>
            <div class="mb-3">
                <label for="release_date"  style="color: aliceblue">Release Date:</label>
                <input type="date" name="release_date" id="release_date" value="{{ isset($film) ? $film?->release_date : old('release_date') }}" required>
            </div>
        <div class="mb-3">
            <label for="genres"  style="color: aliceblue">Genres:</label>
            <select name="genres[]" id="genres" class="form-select" required multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre['genre_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <textarea name="sinopsis"  cols="30" rows="10" >{{isset($film) ? $film?->sinopsis : old ('sinopsis')}}</textarea>
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
