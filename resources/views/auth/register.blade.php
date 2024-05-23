@extends('layouts.auth')

@section('title', 'Registrasi')

@section('content')
  <section class="vh-100">
    <div class="container-fluid px-5 py-4 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-6 h-100 d-none d-lg-block">
          <div class="rounded-5 h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
            style="background-color: rgba(106, 191, 106, 0.2);">
            <div class="position-absolute top-0 start-0 px-5 py-4">
              <img class="img-fluid" src="{{ asset('img/logo-auth.png') }}" alt="login">
            </div>
            <div class="position-absolute bottom-0 end-0">
              <img class="img-fluid w-75 d-block ms-auto" src="{{ asset('img/ui-regist.png') }}" alt="login">
            </div>
          </div>

        </div>
        <div class="col-12 col-lg-6 h-100 align-content-center px-lg-5">
          <div x-data="{ showKonsumen: true, showUMKM: false }">
            <div class="text-center">
              <h2 class="text-bizhub-primary fw-semibold" style="font-size: 34px;">Daftar</h2>
              <div class="my-3">
                <button @click="showKonsumen = true; showUMKM = false" :class="showKonsumen ? 'active' : ''"
                  class="btn btn-bizhub-outline-primary"> Konsumen </button>
                <button @click="showKonsumen = false; showUMKM = true" :class="showUMKM ? 'active' : ''"
                  class="btn btn-bizhub-outline-primary"> Pelaku UMKM </button>
              </div>

            </div>
            <div x-show="showKonsumen">
              <x-registrasi.konsumen />
            </div>
            <div x-show="showUMKM">
              <x-registrasi.umkm />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
