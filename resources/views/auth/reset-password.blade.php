@extends('layouts.auth')

@section('title', 'reset-password')

@section('content')

<div class="vh-100">
  <div class="container-fluid px-5 py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-6 h-100 d-none d-lg-block">
        <div class="rounded-5 h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
          style="background-color: rgba(106, 191, 106, 0.5);">
          <div class="position-absolute top-0 start-0 px-5 py-4">
            <img src="{{ asset('img/logo-auth.png') }}" alt="reset-password">
          </div>
          <div class="position-absolute bottom-0 end-0">
            <img src="{{ asset('img/ui-lupapassword.png') }}" alt="reset-password">
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 h-100 align-content-center px-lg-5">
        <form action="" method="post">
          <div class="login-header text-center">
            <h1>Reset Password</h1>
            <p class="text">Buat dan konfirmasi kata sandi baru anda agar <br/> bisa login ke BizHub</p>
          </div>
          @csrf
          <div x-data="{ showPassword: false }" class="form-password">
            <p class="form-label">Kata Sandi</p>
            <div class="input-password">
              <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi"
                id="password" autocomplete="current-password">
              <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
            </div>
          </div>
          @error('password')
            <small class="text-danger m-2">{{ $message }}</small>
          @enderror
          <div x-data="{ showPassword: false }" class="form-password">
            <p class="form-label">Konfirmasi Kata Sandi</p>
            <div class="input-password">
              <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Konfirmasi kata sandi"
                id="password" autocomplete="current-password">
              <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
            </div>
          </div>
          @error('password')
            <small class="text-danger m-2">{{ $message }}</small>
          @enderror
          <br/>
          <div class="form-button">
            <button type="submit">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection