@extends('templates.index')


@push('css')
    <link rel="stylesheet" href="/css/auth/login.css">
@endpush

@section('content')
    <section class="bg-secondary">
        <div class="row" style="height: 100%">
            <div class="col-4 left-area">
                <img src="/assets/images/crime-illustration.svg" alt="Crime Illustration" width="250">
                <div class="d-flex flex-column align-items-center gap-3">
                    <img src="/assets/images/logo.svg" alt="JAGA logo" width="150">
                    <h1 class="headline-6">Jaringan Analisis & Gugus Anti Kriminal</h1>
                </div>
            </div>
            <div class="col-8 right-area">
                <div class="login-box">
                    <div class="heading mb-4">
                        <h2 class="headline-5 primary">Selamat Datang di JAGA</h2>
                        <p class="paragraph opacity-60">Silahkan login terlebih dahulu</p>
                    </div>


                    <form>
                        <div class="mb-3">
                          <label for="email_or_username" class="form-label">Email atau username</label>
                          <input type="text" class="form-control" id="email_or_username" aria-describedby="emailHelp" placeholder="Masukan email atau username">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Kata Sandi</label>
                          <input type="password" class="form-control" id="password" placeholder="Masukan password">
                        </div>
                        <div class="d-flex flex-column gap-3 align-items-center">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                            <p class="small-text opacity-60">belum punya akun ?</p>
                            <button type="submit" class="btn btn-primary-outline">Daftar Sekarang</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </section>
@endsection