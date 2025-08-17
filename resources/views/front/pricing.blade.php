@extends('layouts.app')

@section('title')
    KalselFit | Pricing
@endsection

@section('content')
    @include('components.navigation')

    <main id="content"
        class="relative flex w-full max-w-[1312px] min-h-[970px] h-fit mx-auto mt-[120px] rounded-[32px] bg-[#606DE5] overflow-hidden">
        <img src="assets/images/backgrounds/Illustration BG.svg" class="absolute w-full h-full object-cover" alt="background">
        <div class="relative flex flex-col w-full items-center">
            <div class="flex flex-col gap-4 text-center mx-auto mt-12">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Paket Membership</h2>
                <p class="leading-19 tracking-03 opacity-60">Temukan rencana sempurna, jelajahi paket langganan kami. Temukan
                    paket terbaik untuk Anda!</p>
            </div>
            <div class="flex gap-8 max-w-[1132px] mx-auto mt-20 mb-[124px]">
                @forelse ($subscribePackages as $itemPackages)
                    <div
                        class="card flex flex-col w-[356px] rounded-3xl p-8 gap-6 bg-white {{ $itemPackages->id == 2 ? 'subscribe-card-super' : '' }}">
                        <div class="flex w-full h-[200px] rounded-3xl overflow-hidden bg-[#606DE5]">
                            <img src="{{ Storage::url($itemPackages->icon) }}" class="w-full h-full object-cover"
                                alt="icon">
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{ $itemPackages->name }}</p>
                            <p class="text-sm leading-16 tracking-05 opacity-50">Nikmati semua manfaat paket membership</p>
                        </div>
                        @forelse ($itemPackages->subscribeBenefit as $itemBenefit)
                            <div class="flex items-center gap-4">
                                <img src="assets/images/icons/tick-circle.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                                <p class="leading-19 tracking-05">{{ $itemBenefit->name }}</p>
                            </div>
                        @empty
                            <p class="text-center">No benefits available.</p>
                        @endforelse

                        <div class="flex items-center justify-between mt-auto">
                            <a href="checkout.html"
                                class="w-fit rounded-full py-3 px-6 bg-[#1BB1F8] font-semibold leading-19 tracking-05 text-white text-center">Membership</a>
                            <p class="text-right font-semibold leading-19 tracking-05">
                                Rp {{ number_format($itemPackages->price, 0, ',', '.') }}<span
                                    class="font-normal opacity-50">/<br>{{ $itemPackages->duration }} hari</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No subscription packages available.</p>
                @endforelse
            </div>
        </div>
    </main>

    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
