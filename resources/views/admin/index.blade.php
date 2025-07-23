@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <h1>Welcome Admin</h1>
</div>
  <div class="container" id="menu">
    <div class="row ">
            @foreach ($films as $film)
            <div class="col-md-4 posterImg">
              @foreach ($film->attributes as $item)
              <img src="/photos/{{$item['poster']}}" class="rounded-4" >
              @endforeach
                <div class="info">
                    <p style="font-size: 25px;" >{{$film['title']}}</p>
                    <p style="font-weight: 400; font-size: 15px;">Director : {{$film['director']}}</p>
                    <p style="font-weight: 400; font-size: 15px;">Duration : {{$film['duration']}}</p>
                    <p style="font-weight: 400; font-size: 15px;">Release Date : {{$film['release_date']}}</p>
                    <p style="font-weight: 400; font-size: 15px;">Genre :
                      @foreach ($film->genres as $genre)
                       {{ $genre->genre_name }}
                       @if (!$loop->last)
                         ,
                       @endif
                     @endforeach
                      </p>

                      <p style="font-weight: 400; font-size: 15px;">Stok : 
                            @if (empty($film->stok->jumlah))
                            <span style="color: red">Unavailable</span> 
                            @else
                                {{$film->stok->jumlah}}
                            @endif
                        </p>
                    
                      {{-- <p style="font-weight: 400; font-size: 15px;">Stok : 
                        @foreach ($film->stok as $item)
                            
                            @if ($item->jumlah != 0)
                            {{$item->jumlah}}
                            @else
                                <span style="color: red">Unavailable</span> 
                            @endif
                         
                        @endforeach
                        </p> --}}
                    <button type="submit" class="btn btn-primary">
                      <a href="/admin/update/{{$film->id}}" class="nav-link">Edit</a></button>
                    <button type="submit" class="btn btn-danger">
                      <a href="/admin/delete/{{$film->id}}" class="nav-link">Delete</a></button>
                </div>
                
            </div>
            @endforeach

    </div>
  </div>
    
@endsection

