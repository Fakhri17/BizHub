@extends('layouts.auth')

@section('title', 'Registrasi')

@section('content')
    <section class="vh-100">
        <div class="container-fluid py-3 px-lg-5 py-lg-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-6 h-100 d-none d-lg-block">
                    <div class="rounded-5 h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
                        style="background-color: rgba(106, 191, 106, 0.2);">
                        <div class="position-absolute top-0 start-0 px-5 py-4">
                            <img class="img-fluid" src="{{ asset('img/logo-auth.png') }}" alt="login">
                        </div>
                        <div class="position-absolute bottom-0 end-0">
                            <img class="img-fluid w-75 d-block ms-auto" src="{{ asset('img/ui-regist.png') }}"
                                alt="login">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 h-100 align-content-center px-lg-5">
                    <div x-data="tabSwitcher()">
                        <div class="text-center">
                            <h2 class="text-bizhub-primary fw-semibold" style="font-size: 34px;">Daftar</h2>
                            <div class="my-3">
                                <button @click="switchTab('konsumen')" :class="activeTab === 'konsumen' ? 'active' : ''"
                                    class="btn btn-bizhub-outline-primary" dusk="konsumen"> Konsumen </button>
                                <button @click="switchTab('umkm')" :class="activeTab === 'umkm' ? 'active' : ''"
                                    class="btn btn-bizhub-outline-primary" dusk="tab-umkm"> Pelaku UMKM </button>
                            </div>
                        </div>
                        <div x-show="activeTab === 'konsumen'">
                            <x-registrasi.konsumen />
                        </div>
                        <div x-show="activeTab === 'umkm'">
                            <x-registrasi.umkm />
                        </div>
                        <div class="register-bottom text-center">
                            <p>Anda sudah punya akun? <span><a href="{{ route('auth.login') }}">Masuk disini</a></span></p>
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/') }}"> Back to homepage </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function tabSwitcher() {
            return {
                activeTab: 'konsumen',
                switchTab(tab) {
                    this.activeTab = tab;
                }
            }
        }
    </script>
    @if (session('failed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Error",
                    text: "{{ session('failed') }}",
                    icon: "error",
                    timer: 3000
                });
            });
        </script>
    @endif
@endsection
