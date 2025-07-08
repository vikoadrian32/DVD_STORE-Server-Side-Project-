<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMovie | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <style>
        h1, p{
            color: whitesmoke;
        }
        body{
            background-color: black;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <div class="container d-flex align-items-center ">
                <img src="{{asset('images/logo.svg')}}" alt="movieicon " style="height: 50px;">
                <a class="navbar-brand text-light fs-4" href="/admin">MyMovie</a>
                <div class="d-flex justify-content-between col-5 align-items-center">
                    <button class="btn btn-danger " style="width: 130px;" type="submit"><a href="/genre" class="nav-link text-light">Genre</a></button>
                    <button class="btn btn-danger " style="width: 130px;" type="submit"><a href="/movie/add" class="nav-link text-light">Add Movie</a></button>
                    <button class="btn btn-danger " style="width: 130px;" type="submit"><a href="/stok" class="nav-link text-light">Stok</a></button>
                </div>
                
            </div>
          
            <div class="d-flex  ">
                <button class="btn btn-danger " style="width: 130px;" type="submit"><a href="/logout" class="nav-link text-light">Log-out</a></button>
            </div>
        </div>
      </nav>
      {{-- End Navbar --}}

      @yield('content')

      <script src="js/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>