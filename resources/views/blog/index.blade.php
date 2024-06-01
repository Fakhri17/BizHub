@extends('layouts.app')

@section('title', 'Blog UMKM')

@section('content')

<section class="margin-section mb-0 py-5">
  <div class="container">
    <div class="card rounded-4 py-4 position-relative overflow-hidden bg-soft-bizhub-secondary">
      <div class="card-body text-center p-4 px-5 d-flex d-flex flex-column align-items-center">
        <h2 class="fw-bold display-5">Blog UMKM</h2>
        <p class="blog-text mt-4" style="font-size: 20px;">Kumpulan blog UMKM yang dapat membantu Pelaku UMKM untuk meningkatkan Produk UMKM mereka.</p>
      </div>
      <div class="position-absolute top-0 d-none d-lg-block">
        <img src="{{ asset('img/blog/header.png') }}" class="img-fluid" alt="...">
      </div>
      
    </div>
    <div class="input-search-blog position-relative bottom-0">
        <div class="input-group shadow-lg rounded-5">
          <input type="text" class="form-control form-control-lg" placeholder="Cari Blog" autocomplete="off" />
          <span class="input-group-text bg-bizhub-primary text-white">
          <i class="ti ti-search" style="font-size: 20px;"></i>
          </span>
        </div>
      </div>
  </div>
</section>

<section class="margin-section">
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="d-flex">
        <div>
          <img src="{{ asset('img/blog/rectangle.png') }}" alt="">
        </div>
        <div class="d-flex flex-column ps-4 justify-content-center">
          <div class="d-flex text-bizhub-secondary">
            <p><i class="ti ti-calendar pe-1"></i>Halo</p>
            <span class="px-2">|</span>
            <p><i class="ti ti-tag pe-1"></i>Tes</p>
          </div>
          <h1>tes</h1>
          <p>halo</p>
        </div>
      </div>
      
    </div>

    
  </div>

</section>