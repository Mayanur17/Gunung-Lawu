@extends('layout.app')

@section('content')
<div class="auth-form">
    <h2>Register</h2>

    {{-- Pesan error --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <div style="position: relative;">
            <input type="password" name="password" id="password" required>
            <span onclick="togglePassword('password', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
        </div>

        <label>Konfirmasi Password</label>
        <div style="position: relative;">
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <span onclick="togglePassword('password_confirmation', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
        </div>

        <button type="submit">Register</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>

{{-- Script toggle password --}}
<script>
    function togglePassword(fieldId, icon) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.textContent = '🙈';
        } else {
            field.type = 'password';
            icon.textContent = '👁️';
        }
    }
</script>
@endsection
