@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- starter kits --}}

<section class="mb-5 my-5">
  <div class="row px-0 mx-0 align-items-center g-4">
    <div class="col-lg-6 mt-5 mt-lg-0 ps-sm-5">
      <div class="mx-2 mx-lg-5 pt-5 pb-3 d-flex flex-column align-items-start">
        <h1 class="text-dark fw-bold text-hero-home">Bersama
          <span class="text-bizhub-secondary">Biz</span><span class="text-bizhub-primary">Hub</span> Solusi Pemasaran
          <span class="text-bizhub-secondary">UMKM</span> Anda
        </h1>
        <p class="mt-4" style="font-size: 18px">Temukan berbagai macam produk UMKM hanya di BizHub!</p>
      </div>
      <form method="GET" action="{{ route('umkm.index') }}">
        <div class="input-search-umkm">
          <div class="input-group shadow-lg rounded-5">
            <input type="text" name="search_product" class="form-control form-control-lg" placeholder="Cari UMKM" autocomplete="off" />
            <button type="submit" class="input-group-text bg-bizhub-primary text-white">
              <i class="ti ti-search" style="font-size: 20px;"></i>
            </button>
          </div>
        </div>
      </form>
      

    </div>
    <div class="col-lg-6 px-0">
      <div class="d-none d-lg-block  hero-bg-home">
        <div>
          <img src="{{ asset('img/home-hero.png') }}" class="img-fluid d-block mx-auto" alt="Example image">
        </div>
      </div>
    </div>
  </div>
</section>

<section class="margin-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6">
        <div>
          <img class="img-fluid w-100 d-block mx-auto" src="{{ asset('img/about-home.png') }}" alt="">
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="text-start">
          <h2 class="fw-bold display-5 mb-4">Apa itu BizHub?</h2>
          <p style="font-size: 18px;">BizHub merupakan aplikasi berbasis website yang diperuntukan kepada pelaku UMKM
            untuk dapat memasarkan
            produk dan layanan kepada lebih banyak konsumen secara efektif dan efisien. BizHub memiliki berbagai fitur
            yang dapat membantu pelaku UMKM dan konsumen dalam menemukan dan memasarkan produk UMKM mereka.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="margin-section bg-soft-bizhub-secondary py-5">
  <div class="container">
    <div class="row align-items-center justify-content-beetween">
      <div class="col-12 col-lg-4">
        <div class="text-center">
          <h3 class="fw-bold display-5">315</h3>
          <p class="text-bizhub-secondary fw-semibold" style="font-size: 20px;">UMKM Terdaftar</p>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="text-center">
          <h3 class="fw-bold display-5">1.267</h3>
          <p class="text-bizhub-secondary fw-semibold" style="font-size: 20px;">Pengguna BizHub</p>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="text-center">
          <h3 class="fw-bold display-5">207</h3>
          <p class="text-bizhub-secondary fw-semibold" style="font-size: 20px;">Pelaku UMKM</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="margin-section mb-0">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-4 mb-4">Fitur BizHub</h2>
      <p style="font-size: 20px;">Fitur-fitur yang kami sediakan untuk membantu para pengguna dan pelaku UMKM</p>
    </div>
    <div class="row row-deck">
      <div class="col-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded-3 shadow">
          <div class="card-body text-center p-4 px-5">
            <i class="ti ti-building-store text-bizhub-primary" style="font-size: 74px;"></i>
            <h5 class="fw-bold text-bizhub-secondary my-3" style="font-size: 20px;">Kumpulan UMKM</h5>
            <p style="font-size: 16px;">Menampilkan UMKM yang telah mendaftar dan menggunakan platform BizHub untuk
              memasarkan produk dan layanan mereka.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded-3 shadow">
          <div class="card-body text-center p-4 px-5">
            <i class="ti ti-stars text-bizhub-primary" style="font-size: 74px;"></i>
            <h5 class="fw-bold text-bizhub-secondary my-3" style="font-size: 20px;">Peringkat & Ulasan UMKM</h5>
            <p style="font-size: 16px;">Pengguna dapat memberikan ulasan dan penilaian terhadap produk dan layanan yang
              ditawarkan oleh pelaku UMKM</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded-3 shadow">
          <div class="card-body text-center p-4 px-5">
            <i class="ti ti-news text-bizhub-primary" style="font-size: 74px;"></i>
            <h5 class="fw-bold text-bizhub-secondary my-3" style="font-size: 20px;">Blog UMKM</h5>
            <p style="font-size: 16px;">Menyediakan ruang bagi pelaku UMKM untuk berbagi informasi, tips, dan artikel
              yang berkaitan dengan dunia usaha mikro, kecil, dan menengah</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="margin-section mb-0 bg-soft-bizhub-secondary py-5">
  <div class="container">
    <div class="card rounded-4 shadow py-4 position-relative overflow-hidden">
      <div class="card-body text-center p-4 px-5">
        <h2 class="fw-bold display-5">Ingin <span class="text-bizhub-secondary">Memasarkan UMKM</span> Anda?</h2>
        <p class="my-4" style="font-size: 18px;">Apakah Anda seorang pelaku UMKM yang ingin memperluas jangkauan pasar
          dan meningkatkan penjualan? BizHub hadir untuk membantu Anda! Dengan BizHub, Anda dapat dengan mudah
          memasarkan produk dan layanan Anda kepada lebih banyak konsumen secara efektif dan efisien.</p>
        <a href="{{ route('register') }}" class="btn btn-bizhub-primary rounded-pill py-2 px-4" role="button"
          style="font-size: 18px;">Daftar Sekarang</a>
      </div>
      <div class="position-absolute bottom-0 end-0 me-5 d-none d-lg-block">
        <img src="{{ asset('img/home-touch.png') }}" class="img-fluid d-block mx-auto" alt="...">
      </div>
    </div>
  </div>
</section>

@if (session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
      title: "Success",
      text: "{{ session('success') }}",
      icon: "success",
      timer: 3000
    });
    });
  </script>
@endif


@endsection