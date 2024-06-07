@extends('layouts.app')

@section('title', 'Detail UMKM')

@section('content')
  <section class="margin-section" style="margin-bottom: 2rem;">
    <div class="container">
      <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/umkm') }}">UMKM</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">UMKM TITLE</a></li>
      </ol>
      <div class="my-5">
        <h1 class="fw-bold display-5">Nama Produk</h1>
        <div class="d-lg-flex align-items-center">
          <div>
            <p class="mb-0">Product Owner</p>
          </div>
          <span class="ms-auto border border-dark shadow-sm cursor-pointer"
            style="display: inline-block; width: 40px; height: 40px; background-color: white; border-radius: 50%; text-align: center; line-height: 40px;">
            <i class="ti ti-heart" style="font-size: 24px; vertical-align: middle;"></i>
          </span>
        </div>


      </div>
      <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://via.placeholder.com/150" class="d-block w-100" alt="https://via.placeholder.com/150"
              style="height: 500px; object-fit:cover">
          </div>
          <div class="carousel-item">
            <img src="https://via.placeholder.com/150" class="d-block w-100" alt="https://via.placeholder.com/150"
              style="height: 500px; object-fit:cover">
          </div>
          <div class="carousel-item">
            <img src="https://via.placeholder.com/150" class="d-block w-100" alt="https://via.placeholder.com/150"
              style="height: 500px; object-fit:cover">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <section class="my-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="card rounded-3 shadow-sm">
            <div class="card-header">
              <h3 class="card-title fw-bold">Deskripsi UMKM</h3>
            </div>
            <div class="card-body">
              <div class="text-secondary">
                Ainun Cake mempersembahkan "Kue Bangkit Rasa Jahe", sebuah kue tradisional yang kaya akan cita rasa dan
                kenangan masa lalu. Terbuat dari bahan-bahan pilihan dan berkualitas tinggi, kue bangkit ini memberikan
                sensasi rasa jahe yang hangat dan lezat, sempurna untuk dinikmati di setiap kesempatan.

                Keunggulan Produk:
                Bahan Alami Berkualitas
                Tekstur Lembut
                Aroma dan Rasa Khas Jahe
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-5">
          <div class="card rounded-3 shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h3 class="card-title mb-1">Kategori</h3>
                <p class="text-secondary">Makanan</p>
              </div>
              <div class="mb-4">
                <h3 class="card-title mb-1">Harga</h3>
                <p class="text-secondary">Rp 25.000,- per toples (250 gram)</p>
              </div>
              <div class="mb-4">
                <h3 class="card-title mb-1">Social Media</h3>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#" class="btn btn-outline-dark d-inline-flex align-items-center">
                      <i class="ti ti-brand-instagram me-2" style="font-size: 20px;"></i>
                      ainun_cake
                    </a>
                  </li>
                  <li  class="mb-2">
                    <a href="#" class="btn btn-outline-dark">
                      <i class="ti ti-world me-2" style="font-size: 20px;"></i>
                      ainuncake.com
                    </a>
                  </li>
                </ul>
                

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
