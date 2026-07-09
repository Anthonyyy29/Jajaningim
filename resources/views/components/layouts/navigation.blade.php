<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
      <img src="/assets/logo_jajaningim/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Jajaningim
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('games') ? 'active' : '' }}" href="{{ route('games') }}">Discover</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
        </li>
      </ul>
      <form class="d-flex me-2" role="search" id="search-form">
        <input class="form-control me-2" type="search" id="search-input" placeholder="Cari game..." aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
              <img src="/assets/logo_jajaningim/users.png" alt="{{ Auth::user()->name }}" width="24" height="24" class="rounded-circle me-1">
              {{ Auth::user()->name }}
            @else
              Login / Register
            @endauth
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            @auth
              <li><a class="dropdown-item" href="{{ route('account.edit') }}">Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            @else
              <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
              <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
            @endauth
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
