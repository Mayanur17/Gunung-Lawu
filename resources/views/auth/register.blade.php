@extends('layout.app')

@section('content')
<div class="auth-form">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
