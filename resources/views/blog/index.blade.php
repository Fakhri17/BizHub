@extends('layouts.app')

@section('title', 'Blog List')

@section('content')

  <section class="margin-section mb-0 pt-5">
    <div class="container">
      <div class="card rounded-4 py-4 position-relative overflow-hidden bg-soft-bizhub-secondary">
        <div class="card-body text-center p-4 px-5 d-flex d-flex flex-column align-items-center">
          <h2 class="fw-bold display-5">Blog UMKM</h2>
          <p class="blog-text mt-4" style="font-size: 20px;">Kumpulan blog UMKM yang dapat membantu Pelaku UMKM untuk
            meningkatkan Produk UMKM mereka.</p>
        </div>
        <div class="position-absolute top-0 d-none d-lg-block">
          <img src="{{ asset('img/blog/header.png') }}" class="img-fluid" alt="...">
        </div>
      </div>
    </div>
    <form method="GET" action="{{ route('blog.index') }}">
      <div class="input-search-blog position-relative bottom-0">
        <div class="input-group shadow-lg rounded-5">
          <input type="text" class="form-control form-control-lg" name="search"
            value="{{ request()->input('search') }}" placeholder="Cari Blog" autocomplete="off" />
          <button class="input-group-text bg-bizhub-primary text-white">
            <i class="ti ti-search" style="font-size: 20px;"></i>
          </button>
        </div>
      </div>
    </form>

    </div>
  </section>

  <section class="margin-section">
    <div class="container">
      @if ($search)
        <div class="alert alert-info mb-5 shadow">
          Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong>
        </div>
        @if ($blogs->isEmpty())
          <div class="alert alert-danger mb-5 shadow">
            Tidak ada hasil yang ditemukan
          </div>
        @endif
      @endif
      @if ($blogCategorySlug)
        <div class="alert alert-info mb-5 shadow">
          Menampilkan blog dengan kategori: <strong>{{ $blogCategorySlug }}</strong>
        </div>
        @if ($blogs->isEmpty())
          <div class="alert alert-danger mb-5 shadow">
            Tidak ada blog dengan kategori tersebut
          </div>
        @endif
      @endif
      <div class="row">
        @foreach ($blogs as $item)
          <div class="col-12 col-md-6 mb-4">
            <div class="card d-flex flex-column rounded-3 shadow h-100">
              <div class="row row-0 flex-fill">
                <div class="col-md-3">
                  <a href="{{ 'blog/' . $item->slug }}">
                    @php
                      $thumbnail = $item->thumbnail
                          ? asset('storage/' . $item->thumbnail)
                          : 'https://via.placeholder.com/150';
                    @endphp
                    <img src="{{ $thumbnail }}" class="w-100 h-100 object-cover rounded-3" alt="Card side image" />
                  </a>
                </div>
                <div class="col">
                  <div class="card-body d-flex flex-column py-3">
                    <div class="mb-2 text-bizhub-secondary">
                      <span>
                        <span>
                          <i
                            class="ti ti-calendar pe-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                        </span>
                      </span>
                      <span class="px-2">|</span>
                      <a href="{{ url('/blog?blog_category=' . $item->blogCategory->slug) }}"
                        class="text-bizhub-secondary">
                        <i class="ti ti-tag pe-1"></i>{{ $item->blogCategory->name }}
                      </a>
                    </div>
                    <h3 class="card-title fw-bold">
                      <a href="{{ 'blog/' . $item->slug }}">{{ $item->title }}</a>
                    </h3>
                    <div class="text-secondary mb-2 flex-fill">
                      {!! html_entity_decode(Str::limit($item->content, 100)) !!}
                    </div>
                    <div class="mt-auto">
                      <a href="{{ 'blog/' . $item->slug }}" class="btn btn-bizhub-outline-primary rounded-3 px-4 me-3"
                        style="font-size: 17px;">Lihat Blog
                        <i class="ti ti-arrow-narrow-right ms-2"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="my-4">
        {{ $blogs->links('components.paginate') }}
      </div>
    </div>
  </section>

@endsection
