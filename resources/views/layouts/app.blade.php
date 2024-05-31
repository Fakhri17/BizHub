<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | Bizhub</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @yield('styles')
</head>

<body>
  <nav class="navbar navbar-expand-lg px-0 py-3 shadow bg-white fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{ URL::to('img/about/logo-bizhub.png') }}" class="logo-nav" alt="logo">
      </a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <div class="navbar-nav column-gap-4 mx-4">
          <a class="nav-item nav-link fw-medium hover-nav {{ Request::is('/') ? 'active-navbar' : '' }}" href="/"
            style="font-size: 18px;">Beranda</a>
          <a class="nav-item nav-link fw-medium hover-nav {{ Request::is('tentang-kami') ? 'active-navbar' : '' }}"
            href="/tentang-kami" style="font-size: 18px;">Tentang Kami</a>
          <a class="nav-item nav-link fw-medium hover-nav {{ Request::is('umkm') ? 'active-navbar' : '' }}" href="/umkm"
            style="font-size: 18px;">UMKM</a>
        </div>
        @if (Auth::check())
      <div class="ms-auto dropdown">
        <a href="#" data-bs-toggle="dropdown"><img src="{{ Auth::user()->avatar_path }}"
          class="rounded-circle border border-primary" alt="logo" width="48" height="48"></a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a class="dropdown-item disabled" href="#">
          <img src="{{ Auth::user()->avatar_path }}" class="rounded-circle border border-primary" alt="logo"
          width="32" height="32">
          <h3 class="m-2">{{ Auth::user()->name }}</h3>
        </a>
        <a class="dropdown-item" href="{{ route('filament.dashboard.pages.dashboard') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard me-2">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
          <path d="M13.45 11.55l2.05 -2.05" />
          <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
          </svg>
          Dashboard
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-logout me-2">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
          <path d="M9 12h12l-3 -3" />
          <path d="M18 15l3 -3" />
          </svg>
          Logout
        </a>
        </div>
      </div>


    @else
    <div class="ms-auto d-flex justify-content-center">
      <a class="btn btn-bizhub-outline-primary rounded-pill py-2 px-4 me-3" href="{{ route('login') }}"
      role="button" style="font-size: 18px;">Masuk</a>
      <a class="btn btn-bizhub-primary rounded-pill py-2 px-4" href="{{ route('register') }}" role="button"
      style="font-size: 18px;">Daftar</a>
    </div>
  @endif
      </div>
    </div>
  </nav>


  @yield('content')

  <footer class="pt-5 bg-white border-top">
    <div class="container mb-3">
      <div class="row">
        <div class="col-12 col-md-3 mb-3">
          <a href="/">
            <img src="{{ URL::to('img/about/logo-bizhub.png') }}" class="w-75" alt="...">
          </a>
          <ul class="list-unstyled d-flex mt-3">
            <li class="sosmed-icons me-2">
              <a href="#" class="text-decoration-none text-white">
                <i class="ti ti-brand-facebook"></i>
              </a>
            </li>
            <li class="sosmed-icons me-2">
              <a href="#" class="text-decoration-none text-white">
                <i class="ti ti-brand-instagram"></i>
              </a>
            </li>
            <li class="sosmed-icons me-2">
              <a href="#" class="text-decoration-none text-white">
                <i class="ti ti-brand-twitter"></i>
              </a>
            </li>

          </ul>
        </div>
        <div class="col-12 col-md-3 mb-3">
          <h3 class="mb-2" style="color:#6ABF6A;">Kontak Kami</h3>
          <p class="mb-1">Tim BizHub</p>
          <p class="mb-1">Jl.Ketintang No. 156, Surabaya</p>
          <p class="mb-1">(+62) 811-3221-2000</p>
          <p class="mb-1">bizhub@mail.com</p>
        </div>
        <div class="col-12 col-md-3 mb-3">
          <h3 class="mb-2" style="color:#6ABF6A;">Tautan Penting</h3>
          <ul class="list-unstyled footer-link">
            <li class="mb-2">
              <a class="text-decoration-none text-dark" href="/">Beranda</a>
            </li>
            <li class="mb-2">
              <a class="text-decoration-none text-dark" href="/tentang-kami">Tentang Kami</a>
            </li>
            <li class="mb-2">
              <a class="text-decoration-none text-dark" href="/umkm">UMKM</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-3 mb-3">
          <h3 class="mb-2" style="color:#6ABF6A;">Afiliasi</h3>
          <ul class="list-unstyled footer-link">
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Telkom Indonesia</a>
            </li>
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Yayasan Pendidikan Telkom</a>
            </li>
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Universitas Telkom</a>
            </li>
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Universitas Telkom Jakarta</a>
            </li>
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Universitas Telkom Surabaya</a>
            </li>
            <li class="mb-2">
              <a href="#" class="text-decoration-none text-dark">Institut Teknologi Telkom Purwokerto</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="py-3" style="background:#213764;">
      <p class="text-center mb-0 text-white">© 2024 - BizHub : Solusi Pemasaran UMKM Anda</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  @yield('scripts')
</body>

</html>