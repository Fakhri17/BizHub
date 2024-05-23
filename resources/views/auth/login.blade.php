@extends('layouts.auth')

@section('title', 'Login')


@section('content')

  <section class="vh-100">
    <div class="container-fluid px-5 py-4 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-6 h-100 d-none d-lg-block">
          <div class="rounded-5 h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
            style="background-color: rgba(106, 191, 106, 0.5);">
            <div class="position-absolute top-0 start-0 px-5 py-4">
              <img src="{{ asset('img/logo-auth.png') }}" alt="login">
            </div>
            <div class="position-absolute bottom-0 end-0">
              <img src="{{ asset('img/ui-login.png') }}" alt="login">
            </div>
          </div>

        </div>
        <div class="col-12 col-lg-6 h-100 align-content-center px-lg-5">
          <form action="{{ route('login-proses') }}" method="post">
            <div class="login-header text-center">
              <h1>Masuk</h1>
              <p class="text">Selamat datang kembali, silakan login ke akun anda!</p>
            </div>
            @csrf
            <div class="form-email">
              <p class="form-label">Email</p>
              <input type="email" name="email" placeholder="Masukan alamat email">
            </div>
            @error('email')
              <small>{{ $message }}</small>
            @enderror
            <div class="form-password">
              <p class="form-label">Password</p>
              <div class="input-password">
                <input type="password" name="password" placeholder="Masukan kata sandi" id="password"
                  autocomplete="current-password">
                <i class="far fa-eye-slash" id="togglePassword" data-target="password"></i>
              </div>
            </div>
            @error('password')
              <small>{{ $message }}</small>
            @enderror
            <div class="to-forgot-password">
              <p>Lupa kata sandi?</p>
            </div>
            <div class="form-button">
              <button type="submit">Masuk</button>
            </div>
            <div class="login-bottom text-center">
              <p>Anda belum punya akun? <span><a href="{{ route('register') }}">Daftar disini</a></span></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


@endsection
