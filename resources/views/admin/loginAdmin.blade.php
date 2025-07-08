<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="wrapper">

        <div class="card-switch">
          <label class="switch">
            {{-- <input type="checkbox" class="toggle"> --}}
            {{-- <span class="slider"></span> --}}
            {{-- <span class="card-side"></span> --}}
            <div class="flip-card__inner">
              <div class="flip-card__front">
                <div class="title">Log in</div>
                <form class="flip-card__form" action="/admin/login"method="post">
                  @csrf
                  <input class="flip-card__input"  placeholder="Email" type="email" name="email">
                  <input class="flip-card__input" placeholder="Password" type="password" name="password">
                  <button class="flip-card__btn">Let`s go!</button>
                </form>
                @if(session('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach(session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              </div>
            </div>
          </label>
        </div>
        
      </div>
</body>
</html>