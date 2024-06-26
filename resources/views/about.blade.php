@extends('layouts.app')

@section('title', 'Tentang Kami')


@section('content')

  <section class="hero-about pt-5 position-relative overflow-hidden rounded-bottom-hero-about" >
    <div class="px-4 pt-5 mt-5 text-center">
      <div class="position-absolute d-none d-lg-block" style="top: 17%; right: 28%;">
        <img src="{{ asset('img/about/dots-about.png') }}" class="img-fluid" alt="Example image">
      </div>
      <div class="position-absolute d-none d-lg-block" style="left: 10%;">
        <img src="{{ asset('img/about/circle-2-about.png') }}" class="img-fluid" alt="Example image">
      </div>
      <h1 class="display-4 fw-bold">Tentang Kami</h1>
      <div class="image-container">
        <img src="{{ asset('img/about/about-hero.png') }}" class="img-fluid" alt="Example image">
      </div>
      <div class="position-absolute d-none d-lg-block end-0" style="bottom: -5%;">
        <img src="{{ asset('img/about/circle-about.png') }}" class="img-fluid" alt="Example image">
      </div>
      
    </div>
  </section>



  <section class="margin-section">
    <div class="container">
      <div class="text-center">
        <h2 class="heading-about-text">Tim Pengembang Bizhub</h2>
        <p class="mb-5" style="font-size: 18px;">Orang-orang kreatif dibalik website BizHub</p>
      </div>
      <div class="row justify-content-center column-gap-5 row-gap-4 mx-lg-5 mx-sm-0">
        <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
          <img src="{{ URL::to('img/about/fakhri.png') }}" alt="">
          <h2 class="mt-3">Fakhri Alauddin</h2>
          <p>Fullstack Developer</p>
        </div>
        <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
          <img src="{{ URL::to('img/about/riyan.png') }}" alt="">
          <h2 class="mt-3">M. Riyan Akbari</h2>
          <p>UI/UX & Front-End Developer</p>
        </div>
        <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
          <img src="{{ URL::to('img/about/ferry.png') }}" alt="">
          <h2 class="mt-3">Ferry Oktariansyah</h2>
          <p>Back-End Developer</p>
        </div>
        <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
          <img src="{{ URL::to('img/about/syahrul.png') }}" alt="">
          <h2 class="mt-3">Moh. Syahrul Aziz I.</h2>
          <p>UI/UX & Front-End Developer</p>
        </div>
        <div class="col-6 col-lg-3 mb-3 mb-lg-0" style="max-width: fit-content;">
          <img src="{{ URL::to('img/about/elan.png') }}" alt="">
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
          <div class="card shadow p-3 p-lg-5 h-100 rounded-4">
            <div class="card-body  text-center">
              <h2 class="mb-4" style="color:#6ABF6A;">Visi BizHub</h2>
              <p style="font-size: 16px;">Menjadi platform pemasaran digital terdepan yang memberdayakan UMKM untuk tumbuh,
                berinovasi, dan mencapai kesuksesan di era ekonomi digital.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-9 mb-3 mb-lg-0">
          <div class="card shadow p-3 p-lg-5 h-100 rounded-4">
            <div class="card-body ">
              <h2 class="mb-4 text-center" style="color:#6ABF6A;">Misi BizHub</h2>

              <li class="d-flex align-items-start mb-2" style="font-size: 16px;">
                <i class="ti ti-circle-check me-2" style="color:#6ABF6A; font-size:24px;"></i>Memberdayakan UMKM melalui
                akses pemasaran digital yang mudah dan terjangkau.
              </li>
              <li class="d-flex align-items-start mb-2" style="font-size: 16px;">
                <i class="ti ti-circle-check me-2" style="color:#6ABF6A; font-size:24px;"></i>Meningkatkan visibilitas
                UMKM di pasar dengan alat pemasaran yang efektif.
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
