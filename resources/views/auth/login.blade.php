@extends('layout.app')

@section('content')
<div class="auth-form">
    <h2>Login</h2>

    {{-- Pesan kesalahan login --}}
    @if ($errors->any())
            <div style="background-color: #ffe6e6; border-left: 6px solid #f44336; color: #a94442; padding: 10px 15px; border-radius: 5px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pesan sukses dari register --}}
    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
</div>
@endsection
