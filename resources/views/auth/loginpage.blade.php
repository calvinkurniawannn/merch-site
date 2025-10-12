<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - {{ $store->store_name ?? 'Store' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">Login to {{ $store->store_name }}</h2>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            @if (session('error'))
                <p class="error-message">{{ session('error') }}</p>
            @endif

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <input type="hidden" name="store_id" value="{{ $store->id }}">

            <button type="submit">Login</button>
        </form>

        <p class="signup-text">
            Belum punya akun?
            <a href="{{ route('signup.page', ['account_code' => $store->account_code]) }}">Daftar di sini</a>
        </p>
    </div>
</body>

</html>
