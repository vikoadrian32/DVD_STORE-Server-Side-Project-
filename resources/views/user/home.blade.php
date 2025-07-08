@extends('layouts.index')

@section('content')

<div id="carouselExampleSlidesOnly" class="carousel slide images" data-bs-ride="carousel">
    <div class="carousel-inner ">
        <div class="carousel-item active" data-bs-interval="5000">
          <img src="../images/indiana.png" class="d-block w-100" alt="...">
          <div class="detail">
              <h2>Indiana Jones and the Kingdom of the Crystal Skull</h2>
              <div>
                  <span  class="imdb">IMDB : 6.2</span>
              </div>
              <p>Action, Adventure.</p>
              <p class="sinopsis">Set during the Cold War, the Soviets—led by sword-wielding Irina Spalko—are in search of a crystal skull which has supernatural powers related to a mystical Lost City of Gold. Indy is coerced to head to Peru at the behest of a young man whose friend—and Indy’s colleague—Professor Oxley has been captured for his knowledge of the skull’s whereabouts.<p>
              <button class="btnDetail">See More</button>
            </div>
        </div>
      <div class="carousel-item " data-bs-interval="5000">
        <img src="../images/dune.png" class="d-block w-100" alt="...">
        <div class="detail">
            <h2>Dune</h2>
            <div>
                <span  class="imdb">IMDB : 8.3</span>
            </div>
            <p>Action, Adventure, Drama.</p>
            <p class="sinopsis">Follow the mythic journey of Paul Atreides as he unites with Chani and the Fremen while on a path of revenge against the conspirators who destroyed his family. Facing a choice between the love of his life and the fate of the known universe, Paul endeavors to prevent a terrible future only he can foresee.</p>
            <button class="btnDetail">See More</button>
          </div>
      </div>
      <div class="carousel-item " data-bs-interval="5000">
        <img src="../images/parasite.jpg" class="d-block w-100" alt="...">
        <div class="detail">
            <h2>Parasite</h2>
            <div>
                <span  class="imdb">IMDB : 8.5</span>
            </div>
            <p>Comedy,Drama,Thriller.</p>
            <p class="sinopsis">All unemployed, Ki-taek’s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.</p>
            <button class="btnDetail">See More</button>
          </div>
      </div>
      <div class="carousel-item " data-bs-interval="5000">
        <img src="../images/parasite.jpg" class="d-block w-100" alt="...">
        <div class="detail">
            <h2>Parasite</h2>
            <div>
                <span  class="imdb">IMDB : 8.5</span>
            </div>
            <p>Comedy,Drama,Thriller.</p>
            <p class="sinopsis">All unemployed, Ki-taek’s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.</p>
            <button class="btnDetail">See More</button>
          </div>
      </div>
    </div>
  </div>


<div class="poster">
    <h3 class="text-center" >Movies</h3>
    <div class="posterImg">
        @foreach($films as $film)
        <div class="image">
            <a href="/film/show/{{$film->id}}">
                @foreach ($film->attributes as $item)
                <img src="/photos/{{$item->poster}}" >
                @endforeach
                <p class="title">{{$film->title}}</p>
            </a>
        </div>  
        @endforeach
    </div>
</div>
@endsection
    {{-- <div class="trailer">
        <video  class="rounded" controls  id="video_{{$film->id}}"  >
            <source src="/videos/{{$film->trailer}}" type="video/mp4">
        </video>
    </div>   --}}