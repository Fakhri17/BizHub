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
                <input type="username" name="username" placeholder="Masukan alamat username" value="{{ old('username') }}">
            </div>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-name">
                <p>Name</p>
                <input type="text" name="name" placeholder="Masukan alamat name" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-no-telp">
                <p>Nomor Telepon</p>
                <input type="number" name="phone_number" placeholder="Masukan alamat no-telp" value="{{ old('phone_number') }}">
            </div>
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-address">
                <p>Alamat</p>
                <input type="text" name="address" placeholder="Masukan alamat address" value="{{ old('address') }}">
            </div>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-email">
                <p>Email</p>
                <input type="email" name="email" placeholder="Masukan alamat email" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-password">
                <p>Password</p>
                <input type="password" name="password" placeholder="Masukan kata sandi">
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-button">
                <button type="submit">Masuk</button>
            </div>
        </form>
    </div>
</body>

</html>