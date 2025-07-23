@extends('layout.app')

@section('content')
<div class="auth-form">
    <h2>Login</h2>

    @if ($errors->any())
        <div style="background-color: #ffe6e6; border-left: 6px solid #f44336; color: #a94442; padding: 10px 15px; border-radius: 5px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <div style="position: relative;">
            <input type="password" name="password" id="password" required>
            <span onclick="togglePassword('password', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
</div>

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
