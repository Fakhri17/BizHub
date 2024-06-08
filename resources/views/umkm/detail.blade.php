@extends('layouts.app')

@section('title', 'Detail UMKM')

@section('content')
  <section class="margin-section" style="margin-bottom: 2rem;">
    <div class="container">
      <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/umkm') }}">UMKM</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $product->product_name }}</a></li>
      </ol>
      <div class="my-5">
        <h1 class="fw-bold display-5">{{ $product->product_name }}</h1>
        <div class="d-lg-flex align-items-center">
          <div>
            <p class="mb-0">{{ $product->umkmOwner->user->name ?? 'null' }}</p>
          </div>
          @if (Auth::check())
            @php
              $isFavorites = in_array($product->id, $userFavorites);
            @endphp
            @if ($isFavorites)
              <form action="{{ route('umkm.remove', $product->id) }}" method="POST" class="ms-auto">
                @csrf
                <button type="submit" class="cursor-pointer icons-wishlist-remove ms-auto border border-dark shadow-sm">
                  <i class="ti ti-heart"></i>
                </button>
              </form>
            @else
              <form action="{{ route('umkm.add', $product->id) }}" method="POST" class="ms-auto">
                @csrf
                <button type="submit" class="cursor-pointer icons-wishlist border border-dark shadow-sm">
                  <i class="ti ti-heart"></i>
                </button>
              </form>
            @endif
          @else
            <a href="{{ route('login') }}" class="cursor-pointer icons-wishlist ms-auto border border-dark shadow-sm">
              <i class="ti ti-heart"></i>
            </a>
          @endif
        </div>


      </div>
      @if (!empty($product->product_gallery))
        <div class="carousel-main shadow">
          @foreach ($product->product_gallery as $index => $image)
            <div class="carousel-cell-gallery">
              <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $image['data']['image']) }}" />
            </div>
          @endforeach
        </div>
      @else
        {{-- only thumbnail --}}
        <div class="">
          <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $product->product_image) }}" />
        </div>
      @endif


    </div>
  </section>
  <section class="my-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="card rounded-3 shadow-sm">
            <div class="card-header">
              <h3 class="card-title fw-bold" style="font-size: 20px;">Deskripsi UMKM</h3>
            </div>
            <div class="card-body">
              <div class="text-secondary">
                {!! html_entity_decode($product->product_description) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-5">
          <div class="card rounded-3 shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h3 class="card-title mb-2" style="font-size: 20px;">Kategori</h3>
                <a href="{{ url('/umkm?product_category=' . $product->productCategory->slug) }}"
                  class="text-bizhub-secondary" style="font-size: 16px;">
                  <i class="ti ti-tag pe-1"></i>{{ $product->productCategory->category_name }}
                </a>
              </div>
              <div class="mb-4">
                <h3 class="card-title mb-2" style="font-size: 20px;">Harga</h3>
                <p class="text-secondary" style="font-size: 16px;">Rp
                  {{ number_format($product->product_price, 0, ',', '.') }},-</p>
              </div>
              <div class="mb-4">
                <h3 class="card-title mb-2" style="font-size: 20px;">Social Media</h3>
                <ul class="list-unstyled">
                  @foreach ($product->product_social_media as $social)
                    @if (isset($social['type']) && $social['type'] === 'Social Media')
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

@section('scripts')
  <script>
    const flkty = new Flickity('.carousel-main', {
      wrapAround: true,
      autoPlay: 3000,
    });
  </script>
  @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          title: "Success",
          text: "{{ session('success') }}",
          icon: "success",
          timer: 3000
        });
      });
    </script>
  @endif
  @if (session('remove'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          title: "Remove",
          text: "{{ session('remove') }}",
          icon: "error",
          timer: 3000
        });
      });
    </script>
  @endif
@endsection
