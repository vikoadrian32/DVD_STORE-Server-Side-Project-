@extends('layouts.trailer')

@section('page')
<nav class="navigasi">
    <a href="/home">MyMovie</a>
    <div>
        <input type="search" placeholder="Search " id="search">
        <button class="searchBtn" ><i class='bx bx-search-alt' style='color:#f3e7e7'></i></button>
        <button class="closeBtn" ><i class='bx bx-x' style='color:#f3e7e7'  ></i></button>
    </div>
</nav>
<div >
    <h2 class="title_movie" style="color: white;margin-bottom : 20px">{{$films->title}}</h2>
    <div class="row">
        <div class="video_controls col-8" >
            @foreach ($films->attributes as $item)
            <video poster="/thumbnails/{{$item->thumbnail}}" class="rounded" >
                <source src="/videos/{{$item->trailer}}" type="video/mp4" >
            </video>
            @endforeach
            <button class="btn" id="btn_play"><i class='bx bx-play-circle ' style='color:#f5e4e4'  ></i></button>
            <button class="btn" id="btn_pause"><i class='bx bx-pause-circle' style='color:#f2eded'></i></button>
        </div>

        <div class="showticket col-4">
            <form action="">
                <input type="date" name="ticket_date" >
            </form>
        </div>
    </div>

    <div class="detail">
        <h2>Sinopsis : </h2>
        <p class="sinopsis">{{$films->sinopsis}}</p>
        <button class="btnDetail">See More</button>
        <hr>

        <div>
            <p style="color: rgb(154, 144, 144); font-weight : bold">
                @foreach ($films->genres as $genre)
                       {{ $genre->genre_name }}
                       @if (!$loop->last)
                         ,
                       @endif
                     @endforeach
            </p>
            <hr>
            <p>Director : {{$films->director}}</p>
            <hr>
            <p>Duration : {{$films->duration}}:</p>
            <hr>
            <p>Release Date : {{$films->release_date}}</p>
            <hr>
        </div>
    </div>
</div>

@endsection