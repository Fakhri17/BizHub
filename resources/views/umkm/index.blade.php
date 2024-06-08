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
                  @if (Auth::check())
                    @php
                      $isFavorites = in_array($product->id, $userFavorites);
                    @endphp
                    @if ($isFavorites)
                      <form action="{{ route('umkm.remove', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="cursor-pointer icons-wishlist-remove shadow-none border-0">
                          <i class="ti ti-heart"></i>
                        </button>
                      </form>
                    @else
                      <form action="{{ route('umkm.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="cursor-pointer icons-wishlist shadow-none border-0">
                          <i class="ti ti-heart"></i>
                        </button>
                      </form>
                    @endif
                  @else
                    <a href="{{ route('login') }}" class="cursor-pointer icons-wishlist">
                      <i class="ti ti-heart"></i>
                    </a>
                  @endif

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

@section('scripts')
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
