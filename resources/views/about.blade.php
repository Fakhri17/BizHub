<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/auth/about.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
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
            <img src="{{ URL::to('img/about/hero-banner.png')}}" class="img-fluid" alt="">
            <div class="overlay-text">
                <h1>Tentang Kami</h1>
            </div>
            </div>
        </div>
    </section>

    



    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>

</html>