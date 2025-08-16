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

    {{-- For lokasi.blade.php, item city --}}
    <style>
    .focus-lokasi {
        outline: 1px solid transparent;
        outline-offset: 1px;
    }

    .focus-lokasi:hover {
        box-shadow: 0 0 0 2px #1BB1F8;
    }

    .focus-lokasi:hover .focus-border-lokasi {
        border-color: #1BB1F8 !important;
    }

    .focus-lokasi:focus {
        box-shadow: 0 0 0 2px #1BB1F8;
    }

    .focus-lokasi:focus .focus-border-lokasi {
        border-color: #1BB1F8 !important;
    }
</style>
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
