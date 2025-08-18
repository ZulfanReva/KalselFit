@extends('layouts.app')

@section('title')
    KalselFit | Payment
@endsection

@section('content')
    @include('components.navigation')


    <div class="flex relative w-full max-w-[1280px] gap-6 mx-auto px-10 aspect-[820/209]">
        <img src="{{ asset('assets/images/thumbnails/banner-custom.png') }}" class="w-full h-full object-contain"
            alt="banner">
    </div>

    <form action="{{ route('front.payment_store') }}" method="POST" enctype="multipart/form-data" id="content"
        class="relative flex w-full max-w-[1280px] gap-6 mx-auto px-10">
        @csrf
        <div class="flex flex-col gap-6 w-full max-w-[820px] shrink-0">
            <div id="account" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Detail Akun</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Cek kembali dan pastikan semua data informasi kamu
                        terisi benar
                    </p>
                </div>
                <hr class="border-black opacity-10">
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Nama Lengkap
                    </p>
                    <p class="leading-19 tracking-05">{{ $booking['name'] }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Nomor Telepon
                    </p>
                    <p class="leading-19 tracking-05">{{ $booking['phone'] }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Email</p>
                    <p class="leading-19 tracking-05">{{ $booking['email'] }}</p>
                </div>
            </div>
            <div id="booking-items" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Booking ID : <span
                            class="text-[#1BB1F8]">TBD</span></p>
                </div>
                <div class="items flex flex-nowrap gap-4 w-full">
                    <img src="{{ asset('assets/images/icons/cart.svg') }}" class="w-10 h-10 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="flex justify-between">
                            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{ $subscribePackage->name }}
                            </p>
                        </div>
                        <p class="text-sm leading-16 tracking-03 opacity-60">{{ $subscribePackage->duration }} Hari -
                            Nikmati semua manfaat paket membership</p>
                    </div>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Paket
                        Membership</p>
                    <p class="leading-19 tracking-05">Rp {{ number_format($subscribePackage->price, 0, ',', '.') }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Tax (PPN 11%)
                    </p>
                    <p class="leading-19 tracking-05">Rp {{ number_format($booking['total_ppn'], 0, ',', '.') }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Promo Code</p>
                    <p class="leading-19 tracking-05 text-[#EC0307]">-Rp 0</p>
                </div>
                <hr class="border-black border-dashed">
                <div class=" w-full flex justify-between items-center rounded-2xl py-4 px-8 bg-[#D0EEFF]">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05">Total Payment</p>
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05 text-right">Rp220.890</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6 w-full">
            <div class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Transfer</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Bank Account Name: KalselFit Corporation</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/BANKKALSEL.svg') }}" class="w-20 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Bank Kalsel</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/BLUBCA.svg') }}" class="w-20 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">BLU BCA</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/MANDIRI.svg') }}" class="w-20 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">MANDIRI</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/SUPERBANK.svg') }}" class="w-20 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">SUPERBANK</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <hr class="border-black opacity-10">
                <label id="upload-proof" class="flex flex-col gap-1 font-['Poppins']">
                    <p class="font-semibold text-fitcamp-black">Bukti Transfer</p>
                    <div
                        class="relative w-full rounded-xl border border-[#BFBFBF] py-4 px-3 bg-white flex flex-col justify-center items-center gap-2">
                        <i class="bi bi-upload text-[#BFBFBF] text-lg"></i>
                        <p id="file-name" class="text-sm leading-[22px] tracking-03 text-[#BFBFBF]">Upload bukti transfer
                            disini</p>
                        <input type="file" name="proof" id="file-input" class="absolute top-0 -z-10">
                    </div>
                </label>
                <button type="submit"
                    class="rounded-full py-3 px-6 bg-[#1BB1F8] font-semibold leading-19 tracking-05 text-white text-center">Confirm</button>
            </div>
        </div>
    </form>

    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/file-input.js') }}"></script>
@endpush
