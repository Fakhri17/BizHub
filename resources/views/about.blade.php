<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/auth/about.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <title>Tentang Kami</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg px-0 py-3 shadow bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ URL::to('img/about/logo-bizhub.png')}}" class="logo-nav" alt="logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <div class="navbar-nav column-gap-4 mx-4">
                    <a class="nav-item nav-link fw-medium hover-nav" href="/" style="font-size: 18px;">Beranda</a>
                    <a class="nav-item nav-link fw-medium hover-nav active-navbar" href="/tentang-kami" style="font-size: 18px;">Tentang Kami</a>
                    <a class="nav-item nav-link fw-medium hover-nav" href="/umkm" style="font-size: 18px;">UMKM</a>
                </div>
                <div class="ms-auto d-flex justify-content-center">
                    <a class="btn btn-outline rounded-pill btn-masuk py-2 px-4 me-3" href="#" role="button" style="font-size: 18px;">Masuk</a>
                    <a class="btn btn-outline rounded-pill btn-daftar py-2 px-4" href="#" role="button" style="font-size: 18px;">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="container mw-100 px-0">
            <div class="image-container">
                <img src="{{ URL::to('img/about/hero-banner.png')}}" alt="">
                <div class="overlay-text">
                    <h1>Tentang Kami</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="container my-5">
            <div class="text-center">
                <h2 class="heading-about-text">Tim Pengembang Bizhub</h2>
                <p class="mb-5" style="font-size: 18px;">Orang-orang kreatif dibalik website BizHub</p>
            </div>
            <div class="row justify-content-center column-gap-5 row-gap-4 mx-lg-5 mx-sm-0">
                <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
                    <img src="{{ URL::to('img/about/fakhri.png')}}" alt="">
                    <h2 class="mt-3">Fakhri Alauddin</h2>
                    <p>Fullstack Developer</p>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
                    <img src="{{ URL::to('img/about/riyan.png')}}" alt="">
                    <h2 class="mt-3">M. Riyan Akbari</h2>
                    <p>UI/UX & Front-End Developer</p>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
                    <img src="{{ URL::to('img/about/ferry.png')}}" alt="">
                    <h2 class="mt-3">Ferry Oktariansyah</h2>
                    <p>Back-End Developer</p>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
                    <img src="{{ URL::to('img/about/syahrul.png')}}" alt="">
                    <h2 class="mt-3">Moh. Syahrul Aziz  I.</h2>
                    <p>UI/UX & Front-End Developer</p>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
                    <img src="{{ URL::to('img/about/elan.png')}}" alt="">
                    <h2 class="mt-3">Elan Agum Wicaksono</h2>
                    <p>Back-End Developer</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4" style="background:#F3FAF3;">
        <div class="container my-5">
            <div class="text-center">
                <h2 class="heading-about-text mb-5">Visi & Misi BizHub</h2>
            </div>
            <div class="row justify-content-center mx-4">
                <div class="col-lg-6 col-sm-9 mb-3 mb-lg-0">
                    <div class="card shadow h-100 rounded-4">
                        <div class="card-body p-5 text-center justify-content-center row">
                            <h2 class="mb-4" style="color:#6ABF6A;">Visi BizHub</h2>
                            <p class="w-75">Menjadi platform pemasaran digital terdepan yang memberdayakan UMKM untuk tumbuh, berinovasi, dan mencapai kesuksesan di era ekonomi digital.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-9 mb-3 mb-lg-0">
                    <div class="card shadow h-100 rounded-4">
                        <div class="card-body p-5">
                            <h2 class="mb-4 text-center" style="color:#6ABF6A;">Misi BizHub</h2>
                
                            <li class="d-flex align-items-start">
                                <i class="ti ti-circle-check me-2" style="color:#6ABF6A; font-size:20px;"></i>Memberdayakan UMKM melalui akses pemasaran digital yang mudah dan terjangkau.
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="ti ti-circle-check me-2" style="color:#6ABF6A; font-size:20px;"></i>Meningkatkan visibilitas UMKM di pasar dengan alat pemasaran yang efektif.
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-5 my-4 bg-white border-top">
      <div class="container mb-3">
        <div class="row">
          <div class="col-12 col-md-3 mb-3">
            <a href="/">
              <img src="{{ URL::to('img/about/logo-bizhub.png')}}" class="w-75" alt="...">
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
    <script src="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/icons-react/dist/index.umd.min.js"></script>
</body>

</html>