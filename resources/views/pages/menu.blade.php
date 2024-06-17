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
                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-lg-6">
                            <h2 class="headline-4">Selamat Datang, {{ session()->get('user')->fullName }}</h2>
                            <p class="opacity-60">Antisipasi tindakan kejahatan dengan JAGA</p>
                        </div>

                        <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                            <ul class="nav nav-tabs gap-2 px-4 py-3 d-flex align-items-center justify-content-center rounded-2"
                                id="myTab" role="tablist" style="background: #C4DFFF">
                                <li class="nav-item">
                                    <a class="nav-link tab active" id="reksa-tab" data-bs-toggle="tab" href="#reksa"
                                        role="tab" aria-controls="reksa" aria-selected="true">
                                        <img src="/assets/images/icons/reksa.svg" alt="Reksa icon" class="mb-2">
                                        <p class="paragraph fw-bold">
                                            REKSA
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab" id="bacain-tab" data-bs-toggle="tab" href="#bacain"
                                        role="tab" aria-controls="bacain" aria-selected="false">
                                        <img src="/assets/images/icons/bacain.svg" alt="Bacain icon">

                                        <p class="paragraph fw-bold">
                                            BACAIN
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab" id="sikat-tab" data-bs-toggle="tab" href="#sikat"
                                        role="tab" aria-controls="sikat" aria-selected="false">
                                        <img src="/assets/images/icons/sikat.svg" alt="Sikat icon">
                                        <p class="paragraph fw-bold">
                                            SIKAT
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab" id="verif-tab" data-bs-toggle="tab" href="#verif"
                                        role="tab" aria-controls="verif" aria-selected="false">
                                        <img src="/assets/images/icons/verif.svg" alt="Verif icon">
                                        <p class="paragraph fw-bold">
                                            VERIF
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- Tab panes -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane p-3 fade show active" id="reksa" role="tabpanel"
                            aria-labelledby="reksa-tab">
                            <h3>REKSA</h3>
                        </div>
                        <div class="tab-pane p-3 fade" id="bacain" role="tabpanel" aria-labelledby="bacain-tab">
                            <h3>BACAIN</h3>
                        </div>
                        <div class="tab-pane p-3 fade" id="sikat" role="tabpanel" aria-labelledby="sikat-tab">
                            <h3>SIKAT</h3>
                        </div>
                        <div class="tab-pane p-3 fade" id="verif" role="tabpanel" aria-labelledby="verif-tab">
                            <h3>VERIF</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('templates.footer')
@endsection
