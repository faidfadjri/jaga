@extends('templates.index')


@push('css')
    <link rel="stylesheet" href="/css/pages/home.css">
@endpush

@section('content')
    @include('templates.navbar')
    @include('templates.hero')
    @include('templates.features')
    @include('templates.footer')
@endsection
