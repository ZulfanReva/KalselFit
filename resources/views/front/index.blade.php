@extends('layouts.app')

@section('title')
    KalselFit | Home
@endsection

@section('content')
    @include('components.header')

    @include('components.threestep')

    @include('components.lokasi')

    @include('components.populergym')

    @include('components.testimonial')

    @include('components.benefits')

    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
