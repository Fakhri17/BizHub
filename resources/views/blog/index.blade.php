@extends('layouts.app')

@section('title', 'Blog UMKM')

@section('content')

<section class="margin-section mb-0 pt-5">
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
    <div class="row d-flex justify-content-center row-gap-5">
      @foreach($blogs as $blog)
      <div class="d-flex col-12 col-md-6">
        <div>
          <img src="{{ asset('img/blog/rectangle.png') }}" class="blog-img" alt="">
        </div>
        <div class="d-flex flex-column ps-4 justify-content-center">
          <div class="d-flex text-bizhub-secondary">
            <p><i class="ti ti-calendar pe-1"></i>{{ $blog->created_at->format('l, d F') }}</p>
            <span class="px-2">|</span>
            <p><i class="ti ti-tag pe-1"></i>{{ $blog->category->name }}</p>
          </div>
            <h1 style="width:100%;">{{ $blog->title }}</h1>
            <p class="mt-2" style="width:100%; font-size: 17px;">{{ Str::limit($blog->content, 100) }}</p>
            <a class="btn btn-bizhub-outline-primary rounded-3 px-4 me-3 blog-detail-btn" href="{{ route('blog.detail', ['slug' => $blog->slug]) }}" role="button" style="font-size: 17px;">Lihat Blog<i class="ti ti-arrow-narrow-right ms-2"></i></a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>