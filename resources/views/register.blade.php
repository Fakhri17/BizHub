<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toogleForm(type) {
            document.getElementById('form-konsumen').classList.add('hidden');
            document.getElementById('form-umkm').classList.add('hidden');
            if (type == 'konsumen') {
                document.getElementById('form-konsumen').classList.remove('hidden');
            } else if (type == 'umkm') {
                document.getElementById('form-umkm').classList.remove('hidden');
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Daftar</h1>
        <button type="button" onclick="toogleForm('konsumen')">Konsumen</button>
        <button type="button" onclick="toogleForm('umkm')">Pelaku UMKM</button>
        <div id="form-konsumen" class="hidden">
            <x-registrasi.konsumen />
        </div>
        <div id="form-umkm" class="hidden">
            <x-registrasi.umkm />
        </div>
    </div>
</body>

</html>