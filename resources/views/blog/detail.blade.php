@extends('layouts.app')

@section('title', 'Blog UMKM')

@section('content')

  <section class="margin-section mb-5">
	<div class="container">
	  <a class="btn btn-bizhub-outline-primary rounded-3 px-4 me-3" href="{{ route('blog.index') }}" role="button"
		style="font-size: 17px;"><i class="ti ti-arrow-narrow-left me-2"></i>Kembali</a>
	  <div class="d-flex align-items-center mt-5 flex-column">
		<h1 class="text-center fw-bold display-5 w-75 mb-4">{{ $blog->title }}</h1>
		<div class="d-flex text-bizhub-secondary mb-4">
		  <p><i class="ti ti-calendar pe-1"></i>{{ $blog->created_at->format('l, d F') }}</p>
		  <span class="px-2">|</span>
		  <p><i class="ti ti-tag pe-1"></i>{{ $blog->blogCategory->name }}</p>
		</div>
		<img src="{{ asset('img/blog/rectangle.png') }}" width="1300px" height="600px" class="blog-img" alt="">
	  </div>
	</div>
  </section>

  <section classm="margin-section">
	<div class="container">
	  <div class="d-flex flex-column flex-lg-row">
		<div style="max-width: 65%">
		  <p>{{ $blog->content }}</p>
		</div>
		<div class="ps-4">
		  <h2 class="mb-3">Blog Terkait</h2>
		  <div class="d-flex flex-column">
			@foreach ($relatedBlogs as $relatedBlog)
			  <div>
				<img src="{{ asset('img/blog/rectangle.png') }}" width="415px" height="200px" class="rounded-4"
				  alt="">
			  </div>
			  <div class="d-flex flex-column justify-content-center">
				<div class="d-flex text-bizhub-secondary pt-3">
				  <p><i class="ti ti-calendar pe-1"></i>{{ $blog->created_at->format('l, d F') }}</p>
				  <span class="px-2">|</span>
				  <p><i class="ti ti-tag pe-1"></i>{{ $blog->blogCategory->name }}</p>
				</div>
				<h1 style="width:100%;">{{ $blog->title }}</h1>
				<p class="mt-2" style="width:100%; font-size: 17px;">{{ Str::limit($blog->content, 80) }}</p>
			  </div>
			@endforeach
		  </div>
		</div>
	  </div>
	</div>
  </section>

@endsection
