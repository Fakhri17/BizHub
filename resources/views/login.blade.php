<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
  <link rel="stylesheet" href="css/auth/login.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
</head>

<body>
  <div class="container">
    <div class="row row-login">
      <div class="col-lg-5 col-md-5 col-sm-0 d-flex justify-content-center col-login-left">
        <img src="{{ URL::to('img/loginBizhub.png')}}" alt="login">
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 col-login-right d-flex justify-content-center">
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
                <input type="password" name="password" placeholder="Masukan kata sandi" id="password" autocomplete="current-password">
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
            <p>Anda belum punya akun? <span><u>Daftar disini</u></span></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
  <script src="js/auth/script.js"></script>
</body>

</html>