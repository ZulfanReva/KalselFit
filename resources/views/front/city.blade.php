@extends('layouts.app')

@section('title')
    KalselFit | {{ $city->name }}
@endsection

@section('content')
    @include('components.navigation')

    <section id="latest" class="flex flex-col w-full max-w-[1280px] gap-8 mx-auto px-10 mt-[120px]">
        <div class="flex items-center justify-center min-h-fit">
            <div class="flex flex-col gap-4 self-center">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05 text-center">
                    {{ $city->name }}</h2>
                <p class="leading-19 tracking-03 opacity-60 text-center">Mencari lokasi KalselFit Gym di sekitar Kota
                    “{{ $city->name }}”</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6">
            @php
                // show only 6 gyms by default; if route is front.city.all show all
                $showAll = request()->routeIs('front.city.all');
                // sort gyms ascending by name (case-insensitive) here in the view
                $gyms = $city->gyms->sortBy(fn($gym) => strtolower($gym->name ?? ''))->take($showAll ? null : 6);
            @endphp

            @forelse ($gyms as $itemCityGym)
                <a href="{{ route('front.details', $itemCityGym->slug) }}"
                    class="card transition-all duration-200 focus:ring-custom-blue hover:ring-custom-blue">
                    <div
                        class="flex flex-col rounded-3xl p-8 gap-6 bg-white border-2 border-transparent hover:border-custom-blue">
                        <div class="title flex flex-col gap-2">
                            <h3 class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{ $itemCityGym->name }}
                            </h3>
                            <div class="flex items-center gap-1">
                                <img src="{{ asset('assets/images/icons/location.svg') }}" class="flex shrink-0"
                                    alt="icon">
                                <p class="text-sm leading-19 tracking-03 opacity-50">
                                    {{ $itemCityGym->city->name ?? 'NaN' }}</p>
                            </div>
                        </div>
                        <div class="thumbnail flex rounded-3xl h-[200px] bg-[#06425E] overflow-hidden">
                            <img src="{{ Storage::url($itemCityGym->thumbnail) }}" class="w-full h-full object-cover"
                                alt="thumbnail">
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-['ClashDisplay-SemiBold']">Fasilitas</p>
                            <button class="font-semibold text-xs leading-14 tracking-05 text-[#1BB1F8]">View
                              all</button>
                        </div>
                        <div class="grid grid-cols-3 justify-between gap-3">
                            @forelse ($itemCityGym->gymFacilities->take(3) as $itemFacility)
                                <div class="flex flex-col gap-3 items-center text-center">
                                    <img src="{{ Storage::url($itemFacility->facility->thumbnail) }}" class="w-10 h-10"
                                        alt="icon">
                                    <div class="flex flex-col gap-1">
                                        <p class="font-semibold text-sm leading-16 tracking-05">
                                            {{ $itemFacility->facility->name }}</p>
                                        <p class="opacity-50 text-sm leading-16 tracking-05">
                                            {{ $itemFacility->facility->about }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>Tidak ada fasilitas tersedia</p>
                            @endforelse
                        </div>
                        <hr class="border-black/10">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/Daily Time.svg') }}" class="w-10 h-10" alt="icon">
                            <div class="flex flex-col gap-2">
                                <p class="font-['ClashDisplay-SemiBold'] text-sm leading-17 tracking-05">Opening Work</p>
                                <p class="text-xs leading-14 tracking-05 opacity-50">
                                    {{ $itemCityGym->open_time_at->format('H:i A') ?? 'NaN' }} -
                                    {{ $itemCityGym->closed_time_at->format('H:i A') ?? 'NaN' }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="leading-19 tracking-03 opacity-60">Belum ada data gym</p>
            @endforelse

        </div>

        {{-- lihat semua / tampilkan sedikit toggle --}}
        @if ($city->gyms->count() > 6)
            <div class="flex justify-center w-full mt-6">
                @if (!request()->routeIs('front.city.all'))
                    <a href="{{ route('front.city.all', $city->slug) }}"
                        class="leading-19 tracking-0.5 text-white font-semibold rounded-[22px] py-3 px-6 bg-[#1BB1F8]">Lihat
                        Semua</a>
                @else
                    <a href="{{ route('front.city', $city->slug) }}"
                        class="leading-19 tracking-0.5 text-white font-semibold rounded-[22px] py-3 px-6 bg-[#1BB1F8]">Tampilkan
                        Sedikit</a>
                @endif
            </div>
        @endif
    </section>

    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
