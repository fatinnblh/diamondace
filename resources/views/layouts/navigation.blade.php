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
    gap: 24px;
    color: #000;
    font-weight: 400;
    white-space: nowrap;
    justify-content: start;
    margin: auto 0;
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
  .login-button {
    align-self: stretch;
    border-radius: 8px;
    gap: 10px;
    width: 77px;
    margin: auto 0;
    padding: 8px 10px;
    border: 1px solid rgba(10, 36, 114, 1);
    cursor: pointer;
    background: transparent;
    color: rgba(10, 36, 114, 1);
    transition: all 0.3s ease;
  }
  .login-button:hover {
    background: rgba(10, 36, 114, 1);
    color: white;
  }
  @media (max-width: 991px) {
    .login-button {
      white-space: initial;
    }
  }
</style>

<nav class="nav-container" role="navigation">
    @auth
        @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ url('/admin') }}" class="brand-logo">AceThesis@U</a>
        @else
            <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
        @endif
    @else
        <a href="{{ url('/') }}" class="brand-logo">AceThesis@U</a>
    @endauth
    <div class="nav-links">
        @auth
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ url('/admin') }}" tabindex="0">Home</a>
            @else
                <a href="{{ url('/') }}" tabindex="0">Home</a>
            @endif
        @else
            <a href="{{ url('/') }}" tabindex="0">Home</a>
        @endauth
        <a href="{{ url('/about') }}" tabindex="0">About</a>
        <a href="{{ url('/service') }}" tabindex="0">Service</a>
        <a href="{{ url('/contact') }}" tabindex="0">Contact us</a>
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
            <a href="{{ route('login') }}" class="login-button">
                <i class="fas fa-user"></i>
                Login
            </a>
        @else
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        @endguest
    </div>
</nav>
