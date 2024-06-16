@extends('templates.index')


@push('css')
    <link rel="stylesheet" href="/css/auth/auth.css">
@endpush

@section('content')
    <section class="bg-secondary" style="height: 100vh; overflow-x: hidden">
        <div class="row" style="height: 100%">
            <div class="col-sm-12 col-lg-4 left-area d-none d-lg-flex">
                <img src="/assets/images/crime-illustration.svg" alt="Crime Illustration" width="250">
                <div class="d-flex flex-column align-items-center gap-3">
                    <img src="/assets/images/logo.svg" alt="JAGA logo" width="150">
                    <h1 class="headline-6">Jaringan Analisis & Gugus Anti Kriminal</h1>
                </div>
            </div>
            <div class="col-sm-12 col-lg-8 right-area">


                <div class="login-box">
                    <div class="heading mb-4">
                        @if (session('success'))
                            <div class="alert alert-success paragraph px-3 py-2 mb-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h2 class="headline-5 primary">Selamat Datang di JAGA</h2>
                        <p class="paragraph opacity-60">Silahkan login terlebih dahulu</p>
                    </div>


                    <form id="login-form">
                        @csrf
                        <div class="mb-3">
                            <label for="email_or_username" class="form-label">Email atau username</label>
                            <input type="text" class="form-control" id="email_or_username" aria-describedby="emailHelp"
                                placeholder="Masukan email atau username" name="email_or_username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukan password"
                                name="password">
                        </div>
                        <div class="d-flex flex-column gap-3 align-items-center">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                Masuk
                            </button>
                            <p class="small-text opacity-60">belum punya akun ?</p>
                            <a class="btn btn-primary-outline" href="/auth/register">Daftar Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#login-form").submit(function(e) {
                e.preventDefault();

                // Create FormData object
                var formData = new FormData(this);

                $("#submit-button").html(
                    `<div id='loading' class='spinner-border text-primary' role='status'></div>`);

                $.ajax({
                    url: '/auth/verification/login', // Replace with your API endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#submit-button").html("Masuk");


                        Swal.fire({
                            title: "Selamat!",
                            text: response?.message ||
                                "Proses login berhasil",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "/"; // Redirect to /auth/otp after registration
                            }
                        });
                    },
                    error: function(xhr) {
                        $("#submit-button").html("Masuk");

                        // Handle error
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: errorMessages
                        });
                    }
                });
            });
        });
    </script>
@endpush
