<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     @stack('styles')
    <title>@yield('title', 'Website Gunung Lawu')</title>
</head>
<body>

    {{-- header global --}}
    @include('partials.header')

    {{-- navigasi global --}}
<nav>
    <div class="nav-links">
        <a href="{{ route('beranda') }}">Beranda</a>
        <a href="{{ route('jalurutama') }}">Jalur Pendakian</a>

        {{-- Route Info Trip berdasarkan role --}}
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('info.index') }}">Info Trip</a>
            @elseif(Auth::user()->role === 'pendaki')
                <a href="{{ route('pendaki.info') }}">Info Trip</a>
            @endif
        @else
            <a href="#">Info Trip</a>
        @endauth

        {{-- Route Booking berdasarkan role --}}
        @auth
            @if(Auth::user()->role === 'pendaki')
                <a href="{{ route('book.index') }}">Booking</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('booking.index') }}">Booking</a>
            @endif
        @else
            <a href="#">Booking</a>
        @endauth
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('berita.index') }}">Berita Terkini</a>
            @elseif(Auth::user()->role === 'pendaki')
                <a href="{{ route('pendaki.berita') }}">Berita Terkini</a>
            @endif
        @else
            <a href="#">Berita Terkini</a>
        @endauth

        <a href="{{ route('cerita.index') }}">Cerita Pendaki</a>
    </div>

    @if (Auth::check())
        <div class="user-info">
            <span class="login-link">Hi, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}" class="login-link">
            <i class="fas fa-user"></i> Login
        </a>
    @endif
</nav>



    <main>
        @yield('content')
    </main>

    {{-- footer global --}}
    @include('partials.footer')

</body>
</html>
