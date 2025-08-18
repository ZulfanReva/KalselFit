@extends('layouts.app')

@section('title')
    KalselFit | Checkout
@endsection

@section('content')
    @include('components.navigation')

    <div class="flex relative w-full max-w-[1280px] gap-6 mx-auto px-10 aspect-[820/209]">
        <img src="{{ asset('assets/images/thumbnails/banner-custom.png') }}" class="w-full h-full object-contain"
            alt="banner">
    </div>

    <form action="{{ route ('front.booking_store', $subscribePackage->id) }}" method="POST" id="content" class="relative flex w-full max-w-[1280px] gap-6 mx-auto px-10">
        @csrf
        <div class="flex flex-col gap-6 w-full max-w-[820px] shrink-0">
            <div id="account" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Detail Akun</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Isi form sesuai data diri kamu, dan pastikan cek
                        kembali sebelum checkout.</p>
                </div>
                <hr class="border-black opacity-10">
                <label class="group flex items-center">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Nama Lengkap
                    </p>
                    <input type="text" name="name" id=""
                        class="outline-none flex w-full rounded-xl px-3 py-4 border border-[#BFBFBF] bg-white font-['Poppins'] text-sm leading-[22px] tracking-03 placeholder:text-[#BFBFBF] transition-all duration-300 group-focus-within:border-black"
                        placeholder="Isi nama lengkap kamu disini">
                </label>
                <label class="group flex items-center">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Nomor Telepon
                    </p>
                    <input type="tel" name="phone" id=""
                        class="outline-none flex w-full rounded-xl px-3 py-4 border border-[#BFBFBF] bg-white font-['Poppins'] text-sm leading-[22px] tracking-03 placeholder:text-[#BFBFBF] transition-all duration-300 group-focus-within:border-black"
                        placeholder="Isi nomor telepon yang valid untuk verifikasi">
                </label>
                <label class="group flex items-center">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Email</p>
                    <input type="email" name="email" id=""
                        class="outline-none flex w-full rounded-xl px-3 py-4 border border-[#BFBFBF] bg-white font-['Poppins'] text-sm leading-[22px] tracking-03 placeholder:text-[#BFBFBF] transition-all duration-300 group-focus-within:border-black"
                        placeholder="Isi email kamu disini">
                </label>
            </div>
            <div id="booking-items" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Detail Booking</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Paket membership kamu menanti, cek detail pemesanan
                        di sini.</p>
                </div>
                <hr class="border-black opacity-10">
                <div class="items flex flex-nowrap gap-4 w-full">
                    <img src="{{ asset('assets/images/icons/cart.svg') }}" class="w-10 h-10 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="flex justify-between">
                            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{ $subscribePackage->name }}</p>
                            <div class="flex gap-4 items-center">
                                <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05"> Rp {{ number_format($subscribePackage->price, 0, ',', '.') }}</p>
                                <button class="appearance-none">
                                    <img src="{{ asset('assets/images/icons/trash.svg') }}" class="w-4 h-4 flex shrink-0"
                                        alt="icon">
                                </button>
                            </div>
                        </div>
                        <p class="text-sm leading-16 tracking-03 opacity-60">{{ $subscribePackage->duration }} hari - Nikmati semua manfaat paket membership</p>
                    </div>
                </div>
                <hr class="border-black opacity-10">
                <div class=" w-full flex justify-between items-center rounded-2xl py-4 px-8 bg-[#D0EEFF]">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05">Total Harga Paket</p>
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05 text-right">Rp {{ number_format($subscribePackage->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6 w-full">
            <div class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Rincian Pembayaran</p>
                    {{-- <p class="text-sm leading-16 tracking-03 opacity-60">Quick snapshot, review your bill</p> --}}
                </div>
                <hr class="border-black opacity-10">
                <div class="flex items-center justify-between">
                    <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Paket Membership</p>
                    <p class="leading-19">Rp {{ number_format($subscribePackage->price, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Tax 11%</p>
                    <p class="leading-19">Rp {{ number_format($totalTaxAmount, 0, ',', '.') }}</p>
                </div>
                <hr class="border-black border-dashed">
                <div class="flex items-center justify-between">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Total</p>
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Rp {{ number_format($grandTotalAmount, 0, ',', '.') }}</p>
                </div>
                <button type="submit"
                    class="rounded-full py-3 px-6 bg-[#1BB1F8] font-semibold leading-19 tracking-05 text-white text-center">Checkout</button>
                <button type="button" class="w-full flex justify-between items-center rounded-lg p-4 bg-[#D0EEFF]">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icons/ticket-discount.svg') }}" class="w-8 h-8 flex shrink-0"
                            alt="icon">
                        <p class="font-semibold leading-19 tracking-05">Gunakan Code Promo</p>
                    </div>
                    <img src="{{ asset('assets/images/icons/Vector.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                </button>
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
@endpush
