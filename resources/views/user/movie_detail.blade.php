@extends('layouts.trailer')

@section('page')
<nav class="navigasi">
    <a href="/home">MyMovie</a>
    <button type="button" class="backBtn">
       <a href="/home"> <i class='bx bx-arrow-back' style='color:#f3e7e7'></i> </a>
    </button>
</nav>

<div>
    <h2 class="title_movie" style="color: white;margin-bottom : 20px">{{$films->title}}</h2>
    <div class="row">
        <div class="video_controls col-7">
            {{-- @foreach ($films->attribute as $item) --}}
            <video poster="/thumbnails/{{$films->attribute->thumbnail}}" class="rounded">
                <source src="/videos/{{$films->attribute->trailer}}" type="video/mp4">
            </video>
            {{-- @endforeach --}}
            <button class="btn" id="btn_play"><i class='bx bx-play-circle' style='color:#f5e4e4'></i></button>
            <button class="btn" id="btn_pause"><i class='bx bx-pause-circle' style='color:#f2eded'></i></button>
        </div>

        <div class="showticket col-4">
            <!-- Date Selection Form -->
            <form class="date-form">
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
                    
                    <button type="button" class="order-btn" id="orderBtn" onclick="showOrderModal()">
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
    <div class="modal-overlay" id="orderModal">
        <div class="modal-container">
            <button class="modal-close" onclick="closeModal()">
                <i class='bx bx-x'></i>
            </button>
            <div class="modal-header">
                <div class="modal-icon">
                    <i class='bx bx-movie-play'></i>
                </div>
                <h2 class="modal-title">Confirm Your Order</h2>
                <p class="modal-subtitle">Please review your ticket details</p>
            </div>

            <div class="order-summary">
                <div class="summary-item">
                    <span class="summary-label">
                        <i class='bx bx-movie'></i>
                        Movie
                    </span>
                    <span class="summary-value" id="movieTitle">{{$films->title}}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">
                        <i class='bx bx-calendar'></i>
                        Date
                    </span>
                    <span class="summary-value" id="movieDate">2024-01-15</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">
                        <i class='bx bx-ticket'></i>
                        Tickets
                    </span>
                    <span class="summary-value" id="ticketQuantity">2 tickets</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">
                        <i class='bx bx-wallet'></i>
                        Total Price
                    </span>
                    <span class="summary-value" id="totalPrice">Rp 100.000</span>
                </div>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-confirm" onclick="confirmOrder()">
                    <i class='bx bx-check-circle'></i>
                    Confirm Order
                </button>
            </div>
        </div>
    </div>

    
    <div class="modal-overlay" id="successModal">
        <div class="modal-container success">
            <button class="modal-close" onclick="closeSuccessModal()">
                <i class='bx bx-x'></i>
            </button>
            
            <div class="modal-header">
                <div class="modal-icon">
                    <i class='bx bx-check'></i>
                </div>
                <h2 class="modal-title">Order Successful!</h2>
                <p class="modal-subtitle">Your tickets have been booked successfully</p>
            </div>     
        </div>
    </div>
</div>

@endsection