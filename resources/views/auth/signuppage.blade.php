<form method="POST" action="{{ route('signup.post') }}">
    @csrf
    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <label>Username:</label><br>
    <input type="text" name="username" value="{{ old('username') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

    <label>Address:</label><br>
    <textarea name="address">{{ old('address') }}</textarea><br><br>

    <button type="submit">Sign Up</button>
    <a href="{{ route('login.page') }}">Udah punya akun? Login!</a>
</form>
