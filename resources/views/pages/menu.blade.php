@extends('templates.index')

@push('css')
    <link rel="stylesheet" href="/css/pages/menu.css">
@endpush

@section('content')
    @include('templates.navbar')
    <section class="section">
        <div class="mt-4 px-3 py-2">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gap-2" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link tab active" id="reksa-tab" data-bs-toggle="tab" href="#reksa" role="tab"
                        aria-controls="reksa" aria-selected="true">
                        <img src="/assets/images/icons/reksa.svg" alt="Reksa icon" class="mb-2">
                        <p class="paragraph fw-bold">
                            REKSA
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" id="bacain-tab" data-bs-toggle="tab" href="#bacain" role="tab"
                        aria-controls="bacain" aria-selected="false">
                        <img src="/assets/images/icons/bacain.svg" alt="Bacain icon">

                        <p class="paragraph fw-bold">
                            BACAIN
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" id="sikat-tab" data-bs-toggle="tab" href="#sikat" role="tab"
                        aria-controls="sikat" aria-selected="false">
                        <img src="/assets/images/icons/sikat.svg" alt="Sikat icon">
                        <p class="paragraph fw-bold">
                            SIKAT
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" id="verif-tab" data-bs-toggle="tab" href="#verif" role="tab"
                        aria-controls="verif" aria-selected="false">
                        <img src="/assets/images/icons/verif.svg" alt="Verif icon">
                        <p class="paragraph fw-bold">
                            VERIF
                        </p>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane p-3 fade show active" id="reksa" role="tabpanel" aria-labelledby="reksa-tab">
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
    </section>
    @include('templates.footer')
@endsection
