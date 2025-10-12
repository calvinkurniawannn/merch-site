<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up - {{ $store->name ?? 'Store' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/signup.css') }}">
</head>

<body>
    <div class="signup-container">
        <h2 class="signup-title">Daftar Akun Baru</h2>

        <form method="POST" action="{{ route('signup.post') }}">
            @csrf

            @if ($errors->any())
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <input type="hidden" name="store_id" value="{{ $store->id }}" required>

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone') }}">

            <label>Alamat</label>
            <textarea name="address">{{ old('address') }}</textarea>

            <button type="submit">Sign Up</button>

            <div class="login-link">
                Udah punya akun?
                <a href="{{ route('login.page', ['account_code' => $store->account_code]) }}">Login di sini</a>
            </div>
        </form>
    </div>
</body>

</html>
