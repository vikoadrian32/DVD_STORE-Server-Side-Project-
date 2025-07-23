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

<div>
    <h2 class="title_movie" style="color: white;margin-bottom : 20px">{{$films->title}}</h2>
    <div class="row">
        <div class="video_controls col-8">
            @foreach ($films->attributes as $item)
            <video poster="/thumbnails/{{$item->thumbnail}}" class="rounded">
                <source src="/videos/{{$item->trailer}}" type="video/mp4">
            </video>
            @endforeach
            <button class="btn" id="btn_play"><i class='bx bx-play-circle' style='color:#f5e4e4'></i></button>
            <button class="btn" id="btn_pause"><i class='bx bx-pause-circle' style='color:#f2eded'></i></button>
        </div>

        <div class="showticket col-4">
            <!-- Date Selection Form -->
            <form action="/order_ticket" method="post" class="date-form">
                @csrf
                <label for="ticket_date" style="color: #ccc; display: block; margin-bottom: 10px;">Select Date:</label>
                <input type="date" name="ticket_date" id="ticket_date">
            </form>

            <!-- Order Form -->
            <div class="order-section">
                <h3 class="order-title">Order Tickets</h3>
                
                <!-- Stock Information -->
                <div class="stock-info">
                    <span class="stock-label">Available Tickets:</span>
                    <span class="stock-count" id="stockCount">{{$films->stok->jumlah ?? 0}}</span>
                </div>

                <!-- Price Information -->
                <div class="price-info">
                    <div class="price-label">Price per Ticket</div>
                    <div class="price-amount" id="pricePerTicket" data-price="{{$films->stok->price ?? 0}}">
                        Rp {{ number_format($films->stok->price ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Quantity Controls -->
                <div class="quantity-controls">
                    <button type="button" class="quantity-btn" id="decreaseBtn" onclick="changeQuantity(-1)">
                        <i class='bx bx-minus'></i>
                    </button>
                    <div class="quantity-display" id="quantityDisplay">1</div>
                    <button type="button" class="quantity-btn" id="increaseBtn" onclick="changeQuantity(1)">
                        <i class='bx bx-plus'></i>
                    </button>
                </div>

                <!-- Total Price -->
                <div class="total-price">
                    <div class="total-label">Total Price</div>
                    <div class="total-amount" id="totalAmount">
                        Rp {{ number_format($films->stok->price ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Order Form -->
                <form action="/order_ticket" method="POST" id="orderForm">
                    @csrf
                    <input type="hidden" name="film_id" value="{{$films->id}}">
                    <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                    <input type="hidden" name="selected_date" id="hiddenDate">
                    <input type="hidden" name="total_price" id="hiddenTotal" value="{{$films->stok->price ?? 0}}">
                    
                    <button type="submit" class="order-btn" id="orderBtn">
                        <i class='bx bx-cart' style="margin-right: 10px;"></i>
                        Order Now
                    </button>
                </form>
            </div>
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