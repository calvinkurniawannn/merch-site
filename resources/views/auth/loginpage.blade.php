<form method="POST" action="{{ route('login.post') }}">
    @csrf

    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <label>Username:</label><br>
    <input type="text" name="username" value="{{ old('username') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <!-- Hidden Account Code -->
    <input type="hidden" name="store_id" value="{{ $store->id }}">

    <button type="submit">Login</button>
</form>

<p style="margin-top: 10px;">
    Belum punya akun?
    <a href="{{ route('signup.page', ['account_code' => $store->account_code]) }}">Daftar di sini</a>
</p>
