@extends('layouts.app')

@section('title', 'UMKM List')

@section('content')
  <section class="margin-section mb-0 pt-5">
    <div class="container">
      <h1 class="display-6"><span class="fw-bold">Daftar UMKM</span><span> (315)</span></h1>
      <div class="my-4">
        {{-- loop dummy UMKM --}}
        <div class="row">
          @for ($i = 0; $i < 6; $i++)
            <div class="col-12 col-md-4 mb-5">
              <div class="position-relative">
                <div class="position-absolute end-0 m-3">
                  <span class="cursor-pointer"
                    style="display: inline-block; width: 40px; height: 40px; background-color: white; border-radius: 50%; text-align: center; line-height: 40px;">
                    <i class="ti ti-heart" style="font-size: 24px; vertical-align: middle;"></i>
                  </span>

                </div>
                <img src="https://via.placeholder.com/500" class="thumbnail-umkm rounded-3" alt="title">
                <div class="my-3">
                  <h2 class="fw-bold">UMKM Nama</h2>
                  <div class="mb-1">
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <i class="fas fa-star text-yellow"></i>
                    <span>(50)</span>
                  </div>
                  <p>UMKM OWNER</p>

                  <a href="#" class="btn btn-outline-dark w-full border border-dark rounded-3" role="button"><i
                      class="fas fa-search me-2"></i>Lihat UMKM</a>
                </div>
              </div>
            </div>
          @endfor

        </div>

      </div>
    </div>
  </section>
@endsection
