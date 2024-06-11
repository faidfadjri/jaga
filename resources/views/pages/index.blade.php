@extends('templates.index')


@push('css')
    <link rel="stylesheet" href="/css/pages/home.css">
@endpush

@section('content')
    <section class="bg-landing-page">
        @include('templates.navbar')

        <img src="/assets/images/line.svg" class="line" alt="line-svg">
        <img src="/assets/images/whatsapp.svg" alt="whatsapp" class="whatsapp">

        <div class="row align-items-center" style="flex-grow: 1; z-index: 10;">
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div class="illustration">
                    <img src="/assets/images/police.svg" alt="police illustration">
                </div>
            </div>
            <div class="col-6">
                <div class="hero-text">
                    <p class="headline-6">Selamat Datang di</p>
                    <h1 class="headline-1 primary fw-bolder">Jaringan Analisis & <br> Gugus Anti-Kriminal</h1>
                    <p class="paragpraph d-flex align-items-center gap-3">Keamanan Anda <span
                            class="orange-label">#prioritaskami</span></p>
                </div>
            </div>
        </div>
    </section>
@endsection
