<div>
  <p class="text-center">Selamat datang, anda mendaftar sebagai Pelaku UMKM</p>
  <form action="{{ route('register-umkm') }}" method="post">
    @csrf
    <div class="form-username">
      <p class="form-label">Username</p>
      <input type="username" name="username" placeholder="Masukan username">
    </div>
    @error('username')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-name">
      <p class="form-label">Name</p>
      <input type="text" name="name" placeholder="Masukan nama">
    </div>
    @error('name')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-no-telp">
      <p class="form-label">Nomor Telepon</p>
      <input type="number" name="phone_number" placeholder="Masukan no telephone">
    </div>
    @error('phone_number')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-address">
      <p class="form-label">Alamat</p>
      <input type="text" name="address" placeholder="Masukan alamat">
    </div>
    @error('address')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-email">
      <p class="form-label">Email</p>
      <input type="email" name="email" placeholder="Masukan alamat email (ex : user@email.com)">
    </div>
    @error('email')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-email">
      <p class="form-label">NPWP</p>
      <input type="text" id="npwp" name="npwp" maxlength="20" placeholder="Masukan NPWP (ex : 12.312.312.3-213.123)">
      @error('npwp')
      <small class=" text-danger m-2">{{ $message }}</small>
    @enderror
    </div>
    <script>
      const NPWP = document.getElementById("npwp")
      NPWP.oninput = (e) => {
        e.target.value = autoFormatNPWP(e.target.value);
      }
      function autoFormatNPWP(NPWPString) {
        try {
          var cleaned = ("" + NPWPString).replace(/\D/g, "");
          var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
          return [
            match[1],
            match[2] ? "." : "",
            match[2],
            match[3] ? "." : "",
            match[3],
            match[4] ? "." : "",
            match[4],
            match[5] ? "-" : "",
            match[5],
            match[6] ? "." : "",
            match[6]].join("")

        } catch (err) {
          return "";
        }
      }
    </script>
    {{-- <div class="form-password">
      <p class="form-label">Password</p>
      <input type="password" name="password" placeholder="Masukan kata sandi">
    </div> --}}
    <div x-data="{ showPassword: false }" class="form-password">
      <p class="form-label">Password</p>
      <div class="input-password">
        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi" id="password"
          autocomplete="current-password">
        <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
      </div>
    </div>
    @error('password')
    <small class="text-danger m-2">{{ $message }}</small>
  @enderror
    <div class="form-button">
      <button type="submit">Daftar</button>
    </div>
  </form>
</div>