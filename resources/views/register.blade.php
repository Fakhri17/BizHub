<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/auth/register.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <script>
    function toggleForm(type) {
        document.getElementById('form-konsumen').classList.add('hidden');
        document.getElementById('form-umkm').classList.add('hidden');
    
        document.getElementById('konsumen-btn').classList.remove('active');
        document.getElementById('umkm-btn').classList.remove('active');

        if (type === 'konsumen') {
            document.getElementById('form-konsumen').classList.remove('hidden');
            document.getElementById('konsumen-btn').classList.add('active');
        } else if (type === 'umkm') {
            document.getElementById('form-umkm').classList.remove('hidden');
            document.getElementById('umkm-btn').classList.add('active');
        }
    }
    </script>
</head>

<body>
    <div class="container">
        <div class="row row-register">
            <div class="col-lg-5 col-md-5 col-sm-0 d-flex justify-content-center register-left">
                <img src="{{ URL::to('img/registerBizhub.png')}}" alt="register">
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-login-right d-flex justify-content-center register-right">
                <div class="register-header">
                    <h1 class="text-center m-0">Daftar</h1>
                    <div class="button-change">
                        <button type="button" id="konsumen-btn" class="active" onclick="toggleForm('konsumen')">Konsumen</button>
                        <button type="button" id="umkm-btn" onclick="toggleForm('umkm')">Pelaku UMKM</button>
                    </div>
                    <div id="form-konsumen">
                        <x-registrasi.konsumen />
                    </div>
                    <div id="form-umkm" class="hidden">
                        <x-registrasi.umkm />
                    </div>
                    <div class="register-bottom text-center">
                        <p>Anda sudah punya akun? <span><a href="{{ route('login') }}">Masuk disini</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="js/auth/script.js"></script>
</body>

</html>