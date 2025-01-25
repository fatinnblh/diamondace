<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sofia+Sans:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
        .nav-container {
            display: flex;
            align-items: center;
            gap: 40px 265px;
            justify-content: center;
            flex-wrap: wrap;
            font: 16px Inter, sans-serif;
            padding: 1rem;
        }
        .brand-logo {
            color: rgba(1, 8, 45, 1);
            align-self: stretch;
            margin: auto 0;
            font: 800 32px Sofia Sans, sans-serif;
            text-decoration: none;
        }
        .brand-logo:hover {
            color: rgba(1, 8, 45, 0.9);
            text-decoration: none;
        }
        .nav-links {
            align-self: stretch;
            display: flex;
            min-width: 240px;
            align-items: start;
            gap: 24px;
            color: rgba(0, 0, 0, 1);
            font-weight: 500;
            justify-content: start;
            margin: auto 0;
        }
        .nav-links a {
            color: rgba(0, 0, 0, 1);
            text-decoration: none;
        }
        .nav-links a:hover {
            color: rgba(10, 36, 114, 1);
            text-decoration: none;
        }
        .nav-actions {
            align-self: stretch;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #000;
            font-weight: 400;
            white-space: nowrap;
            justify-content: start;
            margin: auto 0;
        }
        .login-button {
            align-self: stretch;
            border-radius: 8px;
            gap: 10px;
            margin: auto 0;
            padding: 8px 16px;
            border: 1px solid #0A2472;
            cursor: pointer;
            background: #0A2472;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
        }
        .login-button:hover {
            background: #051650;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(10, 36, 114, 0.2);
        }
        .login-button:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(10, 36, 114, 0.2);
        }
        .register-button {
            align-self: stretch;
            border-radius: 8px;
            gap: 10px;
            margin: auto 0;
            padding: 8px 16px;
            border: 1px solid #0A2472;
            cursor: pointer;
            background: transparent;
            color: #0A2472;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }
        .register-button:hover {
            background: #0A2472;
            color: white;
            text-decoration: none;
        }
        @media (max-width: 991px) {
            .nav-actions {
                white-space: initial;
            }
        }
        .nav-icon {
            aspect-ratio: 1;
            object-fit: contain;
            object-position: center;
            width: 24px;
            align-self: stretch;
            margin: auto 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="nav-container" role="navigation">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ url('/admin') }}" class="brand-logo">AceThesis@U</a>
                @else
                    <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
                @endif
            @else
                <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
            @endauth
            <div class="nav-links">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ url('/admin') }}" tabindex="0">Home</a>
                    @else
                        <a href="{{ url('/') }}" tabindex="0">Home</a>
                    @endif
                @else
                    <a href="{{ url('/') }}" tabindex="0">Home</a>
                @endauth
                <a href="{{ url('/about') }}" tabindex="0">About</a>
                <a href="{{ url('/service') }}" tabindex="0">Service</a>
                <a href="https://wa.me/60142230434" tabindex="0" target="_blank">Contact us</a>
            </div>
            <div class="nav-actions">
                <img
                    loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/ddd6d981c6804b8af8eb875b035db85323f6c81d137e90eea6489fdf51e08340?apiKey=b56619f457e04fabb944a490a22592a3&"
                    class="nav-icon"
                    alt="Search"
                />
                <img
                    loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/42416d67f4d1401aa871201e994d4215e8a62ffedaea6f538e6397fdf6ab9737?apiKey=b56619f457e04fabb944a490a22592a3&"
                    class="nav-icon"
                    alt="Notifications"
                />
                <img
                    loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/adb32d5464e025d7ee3674e38f05d750534074be4137ee113aa490c1b75c92d6?apiKey=b56619f457e04fabb944a490a22592a3&"
                    class="nav-icon"
                    alt="Cart"
                />
                @guest
                    <a href="{{ route('login') }}" class="login-button" tabindex="0">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @else
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="login-button" tabindex="0">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endguest
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
