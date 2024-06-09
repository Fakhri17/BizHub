@extends('layouts.app')

@section('title', 'UMKM List')

@section('content')
  <section class="margin-section mb-0 pt-5">
    <div class="container">

      <div class="page-header mb-4">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <div class="d-flex align-items-center">
              <select class="w-50" id="select-beast" placeholder="Cari Berdasarkan Kategori..."
                autocomplete="off">
                @if (!$productCategorySlug)
                  <option value="" selected>Pilih Kategori</option>
                @endif
                @foreach ($productCategories as $item)
                  <option value="{{ $item->slug }}" {{ $productCategorySlug === $item->slug ? 'selected' : '' }}>
                    {{ $item->category_name }}
                  </option>
                @endforeach
              </select>
              @if ($productCategorySlug)
                <a href="{{ route('umkm.index') }}" class="btn btn-outline-danger ms-2 ms-md-3">Reset</a>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <form method="GET" action="{{ route('umkm.index') }}">
              <div class="input-group shadow-sm rounded-5">
                <input type="text" name="search_product" class="form-control form-control-lg" placeholder="Cari UMKM"
                  autocomplete="off" />
                <button type="submit" class="input-group-text bg-bizhub-primary text-white">
                  <i class="ti ti-search" style="font-size: 20px;"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <h1 class="display-6"><span class="fw-bold">Daftar UMKM</span><span> ({{ $products->total() }})</span></h1>
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
            Menampilkan Produk UMKM dengan kategori: <strong>{{ $productCategorySlug }}</strong>
          </div>
          @if ($products->isEmpty())
            <div class="alert alert-danger mb-5 shadow">
              Tidak ada Produk UMKM dengan kategori tersebut
            </div>
          @endif
        @endif
      </div>
      <div class="my-4">
        <div class="row">
          @foreach ($products as $product)
            <div class="col-12 col-md-6 col-lg-4 mb-5 position-relative overflow-hidden">
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
              <img src="{{ asset('storage/' . $product->product_image) }}" class="thumbnail-umkm rounded-3 mb-3"
                alt="{{ $product->product_name }}">
              <div class="mb-5">
                <h2 class="fw-bold">{{ $product->product_name }}</h2>
                <p>{{ $product->umkmOwner->user->name ?? 'No Info' }}</p>



              </div>
              <div class="w-full text-center px-5" style="position: absolute; bottom: 0;">
                <a href="{{ 'umkm/' . $product->slug }}" class="btn btn-outline-dark w-full border border-dark rounded-3"
                  role="button"><i class="fas fa-search me-2"></i>Lihat UMKM</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="my-4 row align-items-center">
        <div class="col">
          <div>Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</div>
        </div>
        <div class="col-auto">
          {{ $products->links('components.paginate') }}
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
  <script>
    new TomSelect("#select-beast", {
      create: true,
      sortField: {
        field: "text",
        direction: "asc"
      }
    });
    document.getElementById('select-beast').addEventListener('change', function() {
      // Get the selected option value
      var selectedOption = this.value;

      // If an option is selected
      if (selectedOption) {
        // Construct the URL
        var url = 'https://bizhub.test/umkm?product_category=' + selectedOption;

        // Redirect to the constructed URL
        window.location.href = url;
      }
    });
  </script>
@endsection
