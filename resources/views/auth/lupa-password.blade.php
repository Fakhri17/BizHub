@extends('layouts.auth')

@section('title', 'lupa-password')

@section('content')

<div class="vh-100">
  <div class="container-fluid px-5 py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-6 h-100 d-none d-lg-block">
        <div class="rounded-5 h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
          style="background-color: rgba(106, 191, 106, 0.5);">
          <div class="position-absolute top-0 start-0 px-5 py-4">
            <img src="{{ asset('img/logo-auth.png') }}" alt="lupa-password">
          </div>
          <div class="position-absolute bottom-0 end-0">
            <img src="{{ asset('img/ui-lupapassword.png') }}" alt="lupa-password">
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 h-100 align-content-center px-lg-5">
        <form action="" method="post">
          <div class="login-header text-center">
            <h1>Lupa Password?</h1>
            <p class="text">Masukan email BizHub anda agar kami dapat <br/> mengirimkan link reset password</p>
          </div>
          @csrf
          <div class="form-email">
            <p class="form-label">Email</p>
            <input type="email" name="email" placeholder="Masukan alamat email" value="{{ old('email') }}">
          </div>
          @error('email')
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