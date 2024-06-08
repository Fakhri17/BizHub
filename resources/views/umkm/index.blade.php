@extends('layouts.app')

@section('title', 'UMKM List')

@section('content')
  <section class="margin-section mb-0 pt-5">
    <div class="container">
      <h1 class="display-6"><span class="fw-bold">Daftar UMKM</span><span> ({{ $products->count() }})</span></h1>
      <div class="mt-5">
        @if ($search)
          <div class="alert alert-info mb-5 shadow">
            Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong>
          </div>
          @if ($products->isEmpty())
            <div class="alert alert-danger mb-5 shadow">
              Tidak ada hasil yang ditemukan
            </div>
          @endif
        @endif
        @if ($productCategorySlug)
          <div class="alert alert-info mb-5 shadow">
            Menampilkan blog dengan kategori: <strong>{{ $productCategorySlug }}</strong>
          </div>
          @if ($products->isEmpty())
            <div class="alert alert-danger mb-5 shadow">
              Tidak ada blog dengan kategori tersebut
            </div>
          @endif
        @endif
      </div>
      <div class="my-4">
        <div class="row">
          @foreach ($products as $product)
            <div class="col-12 col-md-4 mb-5">
              <div class="position-relative">
                <div class="position-absolute end-0 m-3">
                  <span class="cursor-pointer"
                    style="display: inline-block; width: 40px; height: 40px; background-color: white; border-radius: 50%; text-align: center; line-height: 40px;">
                    <i class="ti ti-heart" style="font-size: 24px; vertical-align: middle;"></i>
                  </span>
                </div>
                {{-- Use the product image from storage --}}
                <img src="{{ asset('storage/' . $product->product_image) }}" class="thumbnail-umkm rounded-3"
                  alt="{{ $product->product_name }}">
                <div class="my-3">
                  <h2 class="fw-bold">{{ $product->product_name }}</h2>
                  <div class="mb-1">
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <span>({{ $product->rating_count ?? 0 }})</span>
                  </div>
                  <p>{{ $product->umkmOwner->user->name ?? 'No Info' }}</p>

                  <a href="{{ 'umkm/' . $product->slug }}"
                    class="btn btn-outline-dark w-full border border-dark rounded-3" role="button"><i
                      class="fas fa-search me-2"></i>Lihat UMKM</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
