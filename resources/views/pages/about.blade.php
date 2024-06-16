@extends('templates.index')


@push('css')
    <link rel="stylesheet" href="/css/pages/about.css">
@endpush

@section('content')
    @include('templates.navbar')

    <section class="section">
        <div class="row">
            <div class="col-12 d-flex flex-column mb-3">
                <img src="https://storage.googleapis.com/danacita-website-v3-prd/website_v3/images/BlogBanner-UniversitasBSI.original.jpg"
                    alt="bsi campus" class="banner">

                <div class="d-flex align-items-center justify-content-center my-3">
                    <img src="/assets/images/logo.svg" alt="logo" width="100">
                </div>
            </div>

            <div class="col-12 px-5">
                <h1 class="headline-2 fw-bold primary text-center mb-2">Jaringan Analisis & Gugus Anti-Kriminal</h1>
                <p class="paragpraph">JAGA adalah sistem inovatif untuk meningkatkan keamanan dan melawan kejahatan di
                    lingkungan Anda.
                    Antisipasi tindakan kriminal dengan menilai bagaimana anda berhubungan dengan orang lain baik dari dalam
                    hal pertemanan, bisnis dan lain sebagainya. JAGA lahir dari sebuah keresahan dan kecemasan masyarakat
                    tentang bagaimana mereka berhubungan dengan orang lain, bagaimana menghindarkan diri dari hubungan
                    sosial yang berpotensi malah melahirkan suatu tindakan kejahatan.</p>
            </div>
        </div>
    </section>

    @include('templates.footer')
@endsection
