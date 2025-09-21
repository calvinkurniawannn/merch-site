<form method="POST" action="{{ route('login.post') }}">
    @csrf

    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif


    <label>Username:</label><br>
    <input type="text" name="username" value="{{ old('username') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
    <a href="{{ route('signup.page') }}">Belum punya akun? Sign Up!</a>
</form>
