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
        <h1 class="fw-bold display-5">{{ $product->product_name }}</h1>
        <div class="d-lg-flex align-items-center"> 
          <div>
            <p class="mb-0">{{ $product->umkmOwner->user->name ?? 'null' }}</p>
          </div>
          <span class="ms-auto border border-dark shadow-sm cursor-pointer"
            style="display: inline-block; width: 40px; height: 40px; background-color: white; border-radius: 50%; text-align: center; line-height: 40px;">
            <i class="ti ti-heart" style="font-size: 24px; vertical-align: middle;"></i>
          </span>
        </div>


      </div>
      <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            @foreach($product->product_gallery as $index => $image)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
              {{-- @foreach($product->product_gallery as $index => $image)
                  <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                      <img src="{{ asset('storage/' . $image['data']['image']) }}" class="d-block w-100" alt="{{ $product->product_name }}"
                        style="height: 500px; object-fit: cover;">
                  </div>
              @endforeach --}}
              @if(!empty($product->product_gallery))
                @foreach($product->product_gallery as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image['data']['image']) }}" class="d-block w-100" alt="{{ $product->product_name }}"
                            style="height: 500px; object-fit: cover;">
                    </div>
                @endforeach
              @elseif(!empty($product->product_image))
                <div class="carousel-item active">
                    <img src="{{ asset('storage/' . $product->product_image) }}" class="d-block w-100" alt="{{ $product->product_name }}"
                        style="height: 500px; object-fit: cover;">
                </div>
              @endif
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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
                {!! html_entity_decode( $product->product_description )!!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-5">
          <div class="card rounded-3 shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h3 class="card-title mb-1">Kategori</h3>
                <p class="text-secondary">{{ $product->productCategory->category_name }}</p>
              </div>
              <div class="mb-4">
                <h3 class="card-title mb-1">Harga</h3>
                <p class="text-secondary">Rp {{ number_format($product->product_price, 0, ',', '.') }},-</p>
              </div>
                <div class="mb-4">
                    <h3 class="card-title mb-1">Social Media</h3>
                    <ul class="list-unstyled">
                        @foreach($product->product_social_media as $social)
                            @if(isset($social['type']) && $social['type'] === 'Social Media')
                                @php
                                    $data = $social['data'];
                                @endphp
                                <li class="mb-2">
                                    <a href="{{ $data['url'] }}" class="btn btn-outline-dark d-inline-flex align-items-center">
                                      @php
                                        $iconClass = str_replace('tabler-', '', $data['icon']);
                                      @endphp
                                      <i class="ti ti-{{ $iconClass }} me-2" style="font-size: 20px;"></i>
                                      {{-- <i class="ti ti-brand-instagram me-2" style="font-size: 20px;"></i> --}}
                                      {{ $data['username'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
