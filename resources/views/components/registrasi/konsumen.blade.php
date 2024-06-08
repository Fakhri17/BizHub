{{-- <div>
  <p class="text-center">Selamat datang, anda mendaftar sebagai Konsumen</p>
  <form action="{{ route('register-konsumen') }}" method="post">
    @csrf
    <div class="form-username">
      <p class="form-label">Username</p>
      <input type="username" name="username" placeholder="Masukan username">
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-name">
      <p class="form-label">Name</p>
      <input type="text" name="name" placeholder="Masukan nama">
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-no-telp">
      <p class="form-label">Nomor Telepon</p>
      <input type="number" name="phone_number" placeholder="Masukan no telephone">
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-address">
      <p class="form-label">Alamat</p>
      <input type="text" name="address" placeholder="Masukan alamat">
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-email">
      <p class="form-label">Email</p>
      <input type="email" name="email" placeholder="Masukan alamat email">
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-password">
            <p class="form-label">Password</p>
            <input type="password" name="password" placeholder="Masukan kata sandi">
        </div>
    <div x-data="{ showPassword: false }" class="form-password">
      <p class="form-label">Password</p>
      <div class="input-password">
        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi" id="password" autocomplete="current-password">
        <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
      </div>
    </div>
    <small class="text-danger m-2"></small>
    <div class="form-button">
      <button type="submit">Daftar</button>
    </div>
  </form>
</div> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div x-data="formValidation()">
  <p class="text-center">Selamat datang, anda mendaftar sebagai Konsumen</p>
  <form action="{{ route('register-konsumen') }}" method="post" x-on:submit.prevent="submitForm">
    @csrf
    <div class="form-username">
      <p class="form-label">Username</p>
      <input type="username" name="username" placeholder="Masukan username" x-model="form.username" x-on:blur="validateField('username')">
    </div>
    <small class="text-danger m-2" x-text="errors.username"></small>
    <div class="form-name">
      <p class="form-label">Name</p>
      <input type="text" name="name" placeholder="Masukan nama" x-model="form.name" x-on:blur="validateField('name')">
    </div>
    <small class="text-danger m-2" x-text="errors.name"></small>
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
      <p class="form-label">Email</p>
      <input type="email" name="email" placeholder="Masukan alamat email" x-model="form.email" x-on:blur="validateField('email')">
    </div>
    <small class="text-danger m-2" x-text="errors.email"></small>
    <div x-data="{ showPassword: false }" class="form-password">
      <p class="form-label">Password</p>
      <div class="input-password">
        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukan kata sandi" id="password" autocomplete="current-password" x-model="form.password" x-on:blur="validateField('password')">
        <i :class="showPassword ? 'far fa-eye' : 'far fa-eye-slash'" @click="showPassword = !showPassword"></i>
      </div>
    </div>
    <small class="text-danger m-2" x-text="errors.password"></small>
    <div class="form-button">
      <button type="submit">Daftar</button>
    </div>
  </form>
</div>
{{-- 
<div x-data="formValidation()" class="container">
  <form x-on:submit.prevent="submitForm">
    <div class="form-control">
      <label class="form-label" for="username">Username</label>
      <input type="text" id="username" x-model="form.username" x-on:blur="validateField('username')">
      <small class="text-danger" x-text="errors.username"></small>
    </div>
    <div class="form-control">
      <label class="form-label" for="email">Email</label>
      <input type="email" id="email" x-model="form.email" x-on:blur="validateField('email')">
      <small class="text-danger" x-text="errors.email"></small>
    </div>
    <button type="submit">Submit</button>
  </form>
</div> --}}

<script>
  function formValidation() {
    return {
      form: {
        username: '',
        email: ''
      },
      errors: {
        username: '',
        email: ''
      },
      validateEmail(email) {
        const re = /^(([^<>()\[\]\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      },
      validateField(field) {
        if (field === 'username') {
          if (!this.form.username) {
            this.errors.username = 'Username is required';
          } else {
            this.errors.username = '';
          }
        }

        if (field === 'email') {
          if (!this.form.email) {
            this.errors.email = 'Email is required';
          } else if (!this.validateEmail(this.form.email)) {
            this.errors.email = 'Invalid email format';
          } else {
            this.errors.email = '';
          }
        }
      },
      validateForm() {
        this.validateField('username');
        this.validateField('email');
        return !this.errors.username && !this.errors.email;
      },
      submitForm() {
        if (this.validateForm()) {
          Swal.fire({
            title: "Success",
            text: "Anda sukses",
            icon: "success",
            timer: 3000
          });
          // Perform actual form submission (e.g., send data to the server)
        } else {
          Swal.fire({
            title: "Error",
            text: "Please fix the errors in the form.",
            icon: "error",
            timer: 3000
          });
        }
      }
    }
  }
</script>