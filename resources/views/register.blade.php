<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>

<body>
    <div class="container">
        <form action="{{ route('register-proses') }}" method="post">
            @csrf
            <div class="form-username">
                <p>Username</p>
                <input type="username" name="username" placeholder="Masukan alamat username">
            </div>
            @error('username')
            <small>{{ $message }}</small>
            @enderror
            <div class="form-name">
                <p>Name</p>
                <input type="text" name="name" placeholder="Masukan alamat name">
            </div>
            @error('name')
            <small>{{ $message }}</small>
            @enderror
            <div class="form-no-telp">
                <p>Nomor Telepon</p>
                <input type="number" name="no-telp" placeholder="Masukan alamat no-telp">
            </div>
            @error('no-telp')
            <small>{{ $message }}</small>
            @enderror
            <div class="form-address">
                <p>Alamat</p>
                <input type="text" name="address" placeholder="Masukan alamat address">
            </div>
            @error('address')
            <small>{{ $message }}</small>
            @enderror
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