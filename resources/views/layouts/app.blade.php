<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AceThesis@U') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0A2472;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: #0A2472;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #051640;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .login-button {
            align-self: stretch;
            border-radius: 8px;
            gap: 10px;
            margin: auto 0;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            background: #0A2472;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .login-button:hover {
            background: #051640;
            color: white;
            text-decoration: none;
        }

        .footer-container {
          display: flex;
          flex-direction: column;
        }

        .footer-wrapper {
          background-color: rgba(174, 203, 214, 0.25);
          border-top: 1px solid #000;
          display: flex;
          width: 100%;
          flex-direction: column;
          padding: 139px 80px 21px;
        }

        .footer-content {
          width: 100%;
          max-width: 1242px;
        }

        .footer-columns {
          gap: 20px;
          display: flex;
        }

        .brand-column {
          display: flex;
          flex-direction: column;
          line-height: normal;
          width: 30%;
        }

        .brand-content {
          display: flex;
          flex-grow: 1;
          flex-direction: column;
        }

        .brand-title {
          color: rgba(5, 22, 80, 1);
          font: 800 32px Sofia Sans, sans-serif;
        }

        .payment-section {
          display: flex;
          margin-top: 51px;
          width: 100%;
          flex-direction: column;
        }

        .payment-title {
          color: #000;
          font: 500 20px/40px Inter, sans-serif;
        }

        .payment-icons {
          display: flex;
          margin-top: 16px;
          min-height: 49px;
          max-width: 100%;
          width: 182px;
          align-items: start;
          gap: 24px;
        }

        .payment-icon {
          aspect-ratio: 1.33;
          object-fit: contain;
          object-position: center;
          width: 65px;
        }

        .payment-icon-alt {
          aspect-ratio: 1.9;
          object-fit: contain;
          object-position: center;
          width: 93px;
        }

        .contact-column {
          display: flex;
          flex-direction: column;
          line-height: normal;
          width: 20%;
          margin-left: 20px;
        }

        .contact-content {
          display: flex;
          flex-direction: column;
        }

        .contact-title {
          color: #000;
          text-transform: capitalize;
          font: 500 32px/1 Inter, sans-serif;
        }

        .contact-icons {
          display: flex;
          margin-top: 16px;
          align-items: start;
          gap: 26px;
        }

        .contact-icon {
          aspect-ratio: 1.13;
          object-fit: contain;
          object-position: center;
          width: 70px;
        }

        .social-icon {
          display: flex;
          width: 36px;
          height: 36px;
        }

        .support-column {
          display: flex;
          flex-direction: column;
          line-height: normal;
          width: 18%;
          margin-left: 20px;
        }

        .support-content {
          display: flex;
          flex-direction: column;
          color: #000;
          white-space: nowrap;
          font: 400 22px/1 Inter, sans-serif;
        }

        .support-title {
          font-size: 32px;
          font-weight: 500;
          line-height: 1;
          text-transform: capitalize;
        }

        .support-link {
          margin-top: 16px;
          color: #000;
          text-decoration: none;
        }

        .support-link:hover {
          text-decoration: underline;
        }

        .location-column {
          display: flex;
          flex-direction: column;
          line-height: normal;
          width: 32%;
          margin-left: 20px;
        }

        .location-content {
          display: flex;
          flex-direction: column;
          font-family: Inter, sans-serif;
          color: #000;
        }

        .location-title {
          font-size: 32px;
          font-weight: 500;
          line-height: 1;
          text-transform: capitalize;
        }

        .location-address {
          font-size: 22px;
          font-weight: 400;
          line-height: 24px;
          margin-top: 16px;
        }

        .footer-divider {
          background-color: #c6c6c6;
          margin-top: 27px;
          height: 0;
          border: 1px solid rgba(198, 198, 198, 1);
        }

        .footer-copyright {
          color: #000;
          align-self: center;
          margin: 87px 0 0 117px;
          font: 400 22px/1 Inter, sans-serif;
        }

        @media (max-width: 991px) {
          .footer-wrapper {
            max-width: 100%;
            padding: 100px 20px 0;
          }

          .footer-content {
            max-width: 100%;
          }

          .footer-columns {
            flex-direction: column;
            align-items: stretch;
            gap: 0;
          }

          .brand-column,
          .contact-column,
          .support-column,
          .location-column {
            width: 100%;
            margin-left: 0;
          }

          .brand-content,
          .contact-content,
          .support-content,
          .location-content {
            margin-top: 40px;
          }

          .payment-section {
            margin-top: 40px;
          }

          .support-content {
            white-space: initial;
          }

          .footer-divider {
            max-width: 100%;
          }

          .footer-copyright {
            margin-top: 40px;
          }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="nav-container" role="navigation">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="brand-logo">AceThesis@U</a>
                @else
                    <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
                @endif
            @else
                <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
            @endauth
            <div class="nav-links">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" tabindex="0">Home</a>
                    @else
                        <a href="{{ route('dashboard') }}" tabindex="0">Home</a>
                    @endif
                @else
                    <a href="{{ url('/') }}" tabindex="0">Home</a>
                @endauth
                <a href="{{ url('/about') }}" tabindex="0">About</a>
                <a href="{{ url('/service') }}" tabindex="0">Service</a>
                <a href="{{ url('/faq') }}" tabindex="0">FAQ</a>
                <a href="https://wa.me/60142230434" tabindex="0" target="_blank">Contact us</a>
            </div>
            <div class="nav-actions">
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

    <div class="footer-container">
      <div class="footer-wrapper">
        <div class="footer-content">
          <div class="footer-columns">
            <div class="brand-column">
              <div class="brand-content">
                <div class="brand-title">AceThesis@U</div>
                <div class="payment-section">
                  <div class="payment-title">Accepted payment</div>
                  <div class="payment-icons">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/acb99c93fab29dc9b7365aa22bb2dc7a553998d6c26c2b58a1b8895edabefd86?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="payment-icon" alt="Payment method 1" />
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/94366e4f21f6b789dffe0e48f9686c9c5cd151828a34a9eb18c15831828f95a8?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="payment-icon-alt" alt="Payment method 2" />
                  </div>
                </div>
              </div>
            </div>
            <div class="contact-column">
              <div class="contact-content">
                <div class="contact-title">Contact</div>
                <div class="contact-icons">
                  <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/519b9a2922af1f30d341e4c51cb80466af1e8263ff2ac1fbfe0ecd4d04a8ba62?placeholderIfAbsent=true&apiKey=b56619f457e04fabb944a490a22592a3" class="contact-icon" alt="Contact method icon" />
                  <div class="social-icon" role="img" aria-label="Social media icon"></div>
                </div>
              </div>
            </div>
            <div class="support-column">
              <div class="support-content">
                <div class="support-title">Support</div>
                <a href="{{ route('faq') }}" class="support-link">FAQ</a>
                <a href="https://wa.me/60142230434" class="support-link">Contact</a>
              </div>
            </div>
            <div class="location-column">
              <div class="location-content">
                <div class="location-title">Location</div>
                <address class="location-address">
                  No. 26 Jalan U1/1 Taman Universiti 35900 Tg Malim Perak
                </address>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-copyright">@Powered by Diamond Ace Resources</div>
      </div>
    </div>
</body>
</html>
