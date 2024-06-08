<div x-data="formValidationUMKM()">
  <p class="text-center">Selamat datang, anda mendaftar sebagai Pelaku UMKM</p>
  <form action="{{ route('register-umkm') }}" method="post" x-on:submit.prevent="submit" x-ref="form">
    @csrf
    <div class="row align-items-center">
      <div class="col-12 col-md-6">
        <div class="form-username">
          <p class="form-label">Username</p>
          <input type="username" name="username" placeholder="Masukan username" x-model="form.username" x-on:blur="validateField('username')">
        </div>
        <small class="text-danger m-2" x-text="errors.username"></small>
      </div>
      <div class="col-12 col-md-6">
        <div class="form-name">
          <p class="form-label">Nama UMKM</p>
          <input type="text" name="name" placeholder="Masukan nama" x-model="form.name" x-on:blur="validateField('name')">
        </div>
          <small class="text-danger m-2" x-text="errors.name"></small>
      </div>
      <div class="col-12 col-md-6">
        <div class="form-email">
          <p class="form-label">Email</p>
          <input type="email" name="email" placeholder="(ex : user@email.com)" x-model="form.email" x-on:blur="validateField('email')">
        </div>
          <small class="text-danger m-2" x-text="errors.email"></small>
      </div>
      <div class="col-6 col-md-6">
        <div x-data="{ showPassword: false }" class="form-password">
          <p class="form-label">Password</p>
          <div class="input-password">
            <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi"
              id="password" autocomplete="new-password" x-model="form.password" x-on:blur="validateField('password')">
            <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
          </div>
        </div>
          <small class="text-danger m-2" x-text="errors.password"></small>
          <input type="hidden" name="avatar_path" value=" ' ' ">

      </div>
    </div>


    <div class="form-no-telp">
      <p class="form-label">Nomor Telepon</p>
      <input type="number" name="phone_number" placeholder="Masukan no telephone" x-model="form.phone_number" x-on:blur="validateField('phone_number')">
    </div>
      <small class="text-danger m-2" x-text="errors.phone_number"></small>
    <div class="form-address">
      <p class="form-label">Alamat</p>
      <input type="text" name="address" placeholder="Masukan alamat" x-model="form.address" x-on:blur="validateField('address')">
    </div>
      <small class="text-danger m-2" x-text="errors.address"></small>

    <div class="form-email">
      <p class="form-label">NPWP</p>
      <input type="text" id="npwp" name="npwp" maxlength="20"
        placeholder="Masukan NPWP (ex : 12.312.312.3-213.123)" x-model="form.npwp" x-on:blur="validateField('npwp')">
        <small class=" text-danger m-2" x-text="errors.npwp"></small>
    </div>
    
    
    <div class="form-button">
      <button type="submit">Daftar</button>
    </div>
  </form>
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
        match[6]
      ].join("")

    } catch (err) {
      return "";
    }
  }
</script>
