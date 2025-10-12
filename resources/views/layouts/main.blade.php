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
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- ✅ Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- ✅ Global CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- ✅ Role-based CSS --}}
    @auth
        @if (auth()->user()->role === 'admin_seller')
            <link rel="stylesheet" href="{{ asset('css/navigation/seller.css') }}">
        @elseif (auth()->user()->role === 'user')
            <link rel="stylesheet" href="{{ asset('css/navigation/user.css') }}">
        @endif
    @endauth

    {{-- ✅ Page-specific CSS --}}
    @yield('style')
</head>

<body class="min-h-screen bg-gray-50">

    {{-- ✅ Layout container (Sidebar + Content) --}}
    <div class="layout-container">

        {{-- ✅ Sidebar / Navigation --}}
        @auth
            @if (auth()->user()->role === 'admin_seller')
                @include('navigation.seller')
            @else
                @include('navigation.user')
            @endif
        @endauth

        {{-- ✅ Main Content Area --}}
        <div class="content-wrapper">
            {{-- ✅ Profile Section (optional) --}}
            @auth
                <div class="profile-info">
                    <p>Hi, {{ auth()->user()->name }}</p>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth

            {{-- ✅ Page Content --}}
            @yield('content')
        </div>
    </div>

    {{-- ✅ Page Scripts --}}
    @yield('script')

</body>

</html>
