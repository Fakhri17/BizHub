@extends('layouts.app')

@section('title', $blog->title)

@section('content')
  <section class="margin-section" style="margin-bottom: 2rem;">
    <div class="container">
      <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/blog') }}">Blog</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $blog->title }}</a></li>
      </ol>
      <div class="my-5 text-center">
        <h1 class="fw-bold display-5 mb-4">{{ $blog->title }}</h1>
        <div class="text-bizhub-secondary" style="font-size: 16px;">
          <span>
            <span>
              <i
                class="ti ti-calendar pe-1"></i>{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('l, d F Y') }}
            </span>
          </span>
          <span class="px-2">
            <i class="fas fa-circle" style="font-size: 10px;"></i>
          </span>
          <a href="{{ url('/blog?blog_category=' . $blog->blogCategory->slug) }}" class="text-bizhub-secondary">
            <i class="ti ti-tag pe-1"></i>{{ $blog->blogCategory->name }}
          </a>
        </div>
      </div>
      <div class="text-center">
        <img src="{{ $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : 'https://via.placeholder.com/150' }}"
          class="w-100 h-100 object-cover rounded-3" alt="Card side image" />
      </div>
    </div>
  </section>
  <section class="mb-5">
    <div class="container">
      <div class="row ">
        <div class="col-12 col-md-8 pe-5">
          <div class="text-secondary">
            {!! html_entity_decode($blog->content) !!}
          </div>
        </div>
        <div class="col-12 col-md-4">
          <h2 class="fw-bold mb-3" style="font-size: 24px;">Blog Terkait</h2>
          @foreach ($relatedBlogs as $item)
            <div class="card mb-5 border-0">
              <!-- Photo -->
              <a href="{{ 'blog/' . $item->slug }}" class="mb-3">
                @php
                  $thumbnail = $item->thumbnail
                      ? asset('storage/' . $item->thumbnail)
                      : 'https://via.placeholder.com/150';
                @endphp
                <img src="{{ $thumbnail }}" class="w-100 h-100 object-cover rounded-3" alt="Card side image" />
              </a>
              <div class="text-bizhub-secondary">
                <span>
                  <span>
                    <i
                      class="ti ti-calendar pe-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                  </span>
                </span>
                <span class="px-2">|</span>
                <a href="{{ url('/blog?blog_category=' . $item->blogCategory->slug) }}" class="text-bizhub-secondary">
                  <i class="ti ti-tag pe-1"></i>{{ $item->blogCategory->name }}
                </a>
              </div>
              <div class="card-body px-0 py-3">
                <a href="" class="text-dark">
                  <h2 class="card-title fw-bold">{{ $blog->title }}</h2>
                </a>

                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit
                  incidunt, iste, itaque minima
                  neque pariatur perferendis sed suscipit velit vitae voluptatem.</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </section>
@endsection
