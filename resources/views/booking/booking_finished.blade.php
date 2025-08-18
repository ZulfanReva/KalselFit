@extends('layouts.app')

@section('title')
    KalselFit | Booking Berhasil
@endsection

@section('content')
    <div id="background" class="absolute w-full h-[345px] top-0 z-0 bg-[#9FDDFF]"></div>

    @include('components.navigation')

    <div
        class="relative flex flex-col items-center w-full max-w-[642px] text-center rounded-3xl p-8 py-[85px] gap-6 bg-white mx-auto mt-[50px]">
        <img src="{{ asset('assets/images/icons/Success.svg') }}" class="w-[390px] flex shrink-0" alt="icon">
        <div class="flex flex-col items-center gap-4">
            <h1 class="font-['ClashDisplay-SemiBold'] text-[32px] leading-10 tracking-05">Booking Berhasil</h1>
            <p class="text-xl leading-8 tracking-[1px] opacity-60">
                Kami akan konfirmasi pembayaran kamu dan mengupdate status booking melalui email kamu
            </p>
        </div>
        <div class="w-fit flex items-center rounded-2xl py-4 px-8 gap-4 bg-[#D0EEFF]">
            <img src="{{ asset('assets/images/icons/cart.svg') }}" class="w-10 h-10 flex shrink-0" alt="icon">
            <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05">Your Booking ID:<span
                    class="ml-2 text-[#1BB1F8]">{{ $subscribeTransaction->booking_trx_id }}</span></p>
        </div>
        <a href="{{ route('front.check_booking') }}"
            class="w-fit rounded-full py-3 px-6 bg-[#1BB1F8] font-semibold leading-19 tracking-05 text-white text-center">Lihat
            My Membership</a>
    </div>

    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush
