<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets - CinemaApp</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{asset('css/ticket.css')}}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navigasi">
        <div>
            <a href='/home'>MyMovie</a>
        </div>
      
    </nav>

    <div class="container">
        <a href="/home" class="back-btn">
            <i class='bx bx-arrow-back'></i>
            Back to Home
        </a>

        <h1 class="page-title">My Tickets</h1>

        <div class="tickets-grid">
            @if ($orders->isEmpty())
                <div class="no-ticket-message">
                    <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" alt="No Tickets" class="empty-image">
                    <h2>Kamu belum memiliki tiket</h2>
                    <p>Ayo pesan film favoritmu sekarang!</p>
                    <a href="/home" class="btn-order-now">Order Now</a>
                </div>
            @else
                @foreach ($orders as $item)
                <div class="ticket-card">
                    <div class="ticket-status">Confirmed</div>
                    <div class="ticket-header">
                        <div class="poster-container">
                            <img src="/photos/{{$item->film->attribute->poster}}" alt="Movie Poster" class="movie-poster">
                        </div>
                        <div class="ticket-info">
                            <h3 class="movie-title">{{$item->film->title}}</h3>
                            <div class="movie-detail">
                                <i class='bx bx-user'></i>
                                <span>{{$item->film->director}}</span>
                            </div>
                            <div class="movie-detail">
                                <i class='bx bx-time'></i>
                                <span>{{$item->film->duration}}</span>
                            </div>
                            <div class="genre-tags">
                                @foreach ($item->film->genres as $genre)
                                <span class="genre-tag">{{$genre->genre_name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
        
                    <div class="ticket-details">
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class='bx bx-calendar'></i>
                                Show Date
                            </span>
                            <span class="detail-value">{{$item->tanggal_nonton}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class='bx bx-time-five'></i>
                                Show Time
                            </span>
                            <span class="detail-value">19:30</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class='bx bx-ticket'></i>
                                Tickets
                            </span>
                            <span class="detail-value quantity-highlight">{{$item->quantity}} Tickets</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">
                                <i class='bx bx-dollar'></i>
                                Total Price
                            </span>
                            <span class="detail-value price-highlight">Rp.{{$item->total_price}}</span>
                        </div>
                    </div>
        
                    <div class="ticket-date">
                        <i class='bx bx-calendar-check' style="margin-right: 8px;"></i>
                        Purchased on {{$item->created_at}}
                    </div>
                </div>
                @endforeach
            @endif
        </div>
</body>
</html>