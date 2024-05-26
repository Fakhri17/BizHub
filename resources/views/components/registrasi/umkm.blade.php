<div>
  <p class="text-center">Selamat datang, anda mendaftar sebagai Pelaku UMKM</p>
  <form action="{{ route('register-umkm') }}" method="post">
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
      <input type="number" name="phone_number" placeholder="Masukan no telephone">
    </div>
    @error('phone_number')
    <small>{{ $message }}</small>
    @enderror
    <div class="form-address">
      <p class="form-label">Alamat</p>
      <input type="text" name="address" placeholder="Masukan alamat">
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
    <div x-data="{ showPassword: false }" class="form-password">
      <p class="form-label">Password</p>
      <div class="input-password">
        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi" id="password" autocomplete="current-password">
        <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
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