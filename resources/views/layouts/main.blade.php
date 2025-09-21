<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- include CSS/JS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    {{-- Sidebar / Navigation --}}
    @auth
        @if (auth()->user()->role === 'admin_seller')
            @include('navigation.seller')
        @else
            @include('navigation.user')
        @endif

        {{-- Profile Section --}}
        <div class="profile-info">
            <p>Hi, {{ auth()->user()->name }}</p>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @endauth

    {{-- Main content --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

</body>

</html>
