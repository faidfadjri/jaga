@extends('templates.index')

@push('css')
    <link rel="stylesheet" href="/css/pages/menu.css">
@endpush

@section('content')
    @include('templates.navbar')
    <section class="section">
        <div class="row p-5">
            <div class="col-12 mb-3">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item d-flex align-items-center justify-content-center active rounded-5">
                            <img src="https://kopnus.com/wp-content/uploads/2023/04/banner-waspada.jpg"
                                class="d-block w-100 rounded-3" alt="carousel" style="height: 380px; object-fit: cover">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @if (!session()->get('user')->isNIKVerified)
                    <div class="alert alert-warning" role="alert">
                        Anda belum melakukan verifikasi KTP
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-lg-6">
                            <h2 class="headline-4">Selamat Datang, {{ session()->get('user')->fullName }}</h2>
                            <p class="opacity-60">Antisipasi tindakan kejahatan dengan JAGA</p>
                        </div>

                        @include('templates.tab-layout')
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="myTabContent">
                        @include('pages.tabs.reksa')
                        @include('pages.tabs.bacain')
                        @include('pages.tabs.sikat')
                        @include('pages.tabs.verif')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('templates.footer')
@endsection
