<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ✅ CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ✅ TailwindCSS (Utility Framework) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ✅ Font Awesome (Icon Pack) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-xxx" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- ✅ Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- ✅ Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- ✅ CSS tambahan per halaman --}}
    @yield('style')
</head>

<body class="min-h-screen bg-gray-50">

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
                <button type="submit"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</button>
            </form>
        </div>
    @endauth

    {{-- Main Content --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

    {{-- JS tambahan per halaman --}}
    @yield('script')

</body>

</html>
