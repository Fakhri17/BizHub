<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <div class="container">
    <form action="{{ route('login-proses') }}" method="post">
      @csrf
      <div class="form-email">
        <p>Email</p>
        <input type="email" name="email" placeholder="Masukan alamat email">
      </div>
      @error('email')
      <small>{{ $message }}</small>
      @enderror
      <div class="form-password">
        <p>Password</p>
        <input type="password" name="password" placeholder="Masukan kata sandi">
      </div>
      @error('password')
      <small>{{ $message }}</small>
      @enderror
      <div class="form-button">
        <button type="submit">Masuk</button>
      </div>
    </form>
  </div>
</body>

</html>