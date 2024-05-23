<div>
    <p class="text-center">Selamat datang, anda mendaftar sebagai Konsumen</p>
    <form action="{{ route('register-proses') }}" method="post">
        @csrf
        <div class="form-username">
            <p class="form-label">Username</p>
            <input type="username" name="username" placeholder="Masukan username">
        </div>
        @error('username')
        <small>{{ $message }}</small>
        @enderror
        <div class="form-name">
            <p class="form-label">Name</p>
            <input type="text" name="name" placeholder="Masukan nama">
        </div>
        @error('name')
        <small>{{ $message }}</small>
        @enderror
        <div class="form-no-telp">
            <p class="form-label">Nomor Telepon</p>
            <input type="number" name="no-telp" placeholder="Masukan no telephone">
        </div>
        @error('no-telp')
        <small>{{ $message }}</small>
        @enderror
        <div class="form-address">
            <p class="form-label">Alamat</p>
            <input type="text" name="address" placeholder="Masukan alamat ">
        </div>
        @error('address')
        <small>{{ $message }}</small>
        @enderror
        <div class="form-email">
            <p class="form-label">Email</p>
            <input type="email" name="email" placeholder="Masukan alamat email">
        </div>
        @error('email')
        <small>{{ $message }}</small>
        @enderror
        {{-- <div class="form-password">
            <p class="form-label">Password</p>
            <input type="password" name="password" placeholder="Masukan kata sandi">
        </div> --}}
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
        <div class="form-button">
            <button type="submit">Daftar</button>
        </div>
    </form>
</div>