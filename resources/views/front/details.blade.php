@extends('layouts.app')

@section('title')
    {{ $gym->name }} | Detail
@endsection

@section('content')
    @include('components.navigation')

    <main id="content" class="relative flex w-full max-w-[1280px] gap-6 mx-auto px-10 mt-[96px]">
        <section id="details" class="flex flex-col gap-6 w-full max-w-[820px] flex-1">
            <div id="main-thumbnail" class="w-full h-[453px] rounded-3xl bg-[#06425E] overflow-hidden">
                <img src="{{ Storage::url($gym->thumbnail) }}" class="w-full h-full object-cover" alt="main thumbnail">
            </div>
            <div id="gallery" class="grid grid-cols-4 gap-4">
                <button
                    class="w-full rounded-2xl bg-[#D9D9D9] overflow-hidden transition-all duration-300 ring-[3px] ring-custom-blue">
                    <img src="{{ Storage::url($gym->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                </button>

                @foreach ($gym->gymPhotos as $itemGymPhoto)
                    <button class="w-full rounded-2xl bg-[#D9D9D9] overflow-hidden transition-all duration-300 opacity-50">
                        <img src="{{ Storage::url($itemGymPhoto->photo) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                    </button>
                @endforeach
            </div>
            <div id="place-info" class="flex flex-col w-full rounded-3xl p-8 gap-12 bg-white">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-['ClashDisplay-SemiBold'] text-[32px] leading-[40px] tracking-05">
                            "{{ $gym->name }}"</h1>
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/images/icons/location.svg') }}" class="flex shrink-0" alt="icon"
                                width="24" height="24">
                            <p class="text-xl leading-6 tracking-05 opacity-50">{{ $gym->city->name }}</p>
                        </div>
                    </div>
                    @if ($gym->is_popular)
                        <p
                            class="rounded-full py-3 px-6 bg-[#1BB1F8] w-fit font-semibold leading-19 tracking-05 text-white flex items-center gap-2">
                            <img src="{{ asset('assets/images/icons/Star-white.svg') }}" alt="Star icon" class="w-5 h-5">
                            Populer
                        </p>
                    @endif
                </div>
                <div class="flex flex-col gap-6">
                    <h2 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Fasilitas Tersedia</h2>
                    <hr class="opacity-10 border-black">
                    <div class="grid grid-cols-3 gap-x-8 gap-y-6">
                        @forelse ($gym->gymFacilities as $itemFacility)
                            <div class="flex items-center gap-2">
                                <img src="{{ Storage::url($itemFacility->facility->thumbnail) }}"
                                    class="w-[56px] h-[56px] flex shrink-0" alt="icon">
                                <div class="flex flex-col gap-2">
                                    <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">
                                        {{ $itemFacility->facility->name }}</p>
                                    <p class="text-sm leading-16 tracking-05 opacity-50">
                                        {{ $itemFacility->facility->about }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm leading-16 tracking-05 opacity-50">No facilities available</p>
                        @endforelse
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <h2 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Tentang Kami</h2>
                    <hr class="opacity-10 border-black">
                    <p class="leading-[34px] tracking-05">{{ $gym->about }}</p>
                </div>
                <div class="flex items-center gap-8">
                    <div class="flex items-center gap-3 shrink-0">
                        <img src="{{ asset('assets/images/icons/Daily Time.svg') }}" class="w-20 h-20 flex shrink-0"
                            alt="icon">
                        <div class="flex flex-col gap-2">
                            <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Opening Work</p>
                            <p class="text-xs leading-14 tracking-05 opacity-50">
                                {{ $gym->open_time_at->format('H:i A') ?? 'NaN' }} -
                                {{ $gym->closed_time_at->format('H:i A') ?? 'NaN' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-8">
                        <img src="{{ asset('assets/images/icons/Adress.svg') }}" class="w-20 h-20 flex shrink-0"
                            alt="icon">
                        <div class="flex flex-col gap-3">
                            <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Detail Alamat</p>
                            <p class="leading-[22px] tracking-05 opacity-50">{{ $gym->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews" class="flex flex-col w-full rounded-3xl p-8 gap-8 bg-white">
                <div class="flex flex-col gap-4">
                    <h2 class="font-['ClashDisplay-SemiBold'] text-[48px] leading-[59px] tracking-05">Happy Stories</h2>
                    <p class="leading-19 tracking-03 opacity-60">Apa kata mereka tentang lokasi gym, fasilitas, dan lainnya
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 px-[27px]">
                    @forelse ($gym->gymTestimonials as $itemTestimonials)
                        <div
                            class="font-['Poppins'] flex flex-col w-full rounded-3xl border border-[#E4E4E4] py-4 px-6 gap-3 bg-white">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full border-[5px] border-white overflow-hidden">
                                    <img src="{{ Storage::url($itemTestimonials->photo) }}"
                                        class="w-full h-full object-cover" alt="photo">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <p class="font-semibold text-sm leading-[22px] tracking-03">
                                        {{ $itemTestimonials->name }}</p>
                                    <p class="text-xs leading-5 tracking-03 text-[#8D9397]">
                                        {{ $itemTestimonials->occupation }}</p>
                                </div>
                            </div>
                            <p class="text-sm leading-[22px] tracking-03">{{ $itemTestimonials->message }}</p>
                            <div class="flex items-center gap-1">
                                <img src="{{ asset('assets/images/icons/magic-star.svg') }}" class="w-4 h-4"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/magic-star.svg') }}" class="w-4 h-4"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/magic-star.svg') }}" class="w-4 h-4"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/magic-star.svg') }}" class="w-4 h-4"
                                    alt="icon">
                                <img src="{{ asset('assets/images/icons/magic-star.svg') }}" class="w-4 h-4"
                                    alt="icon">
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </section>
        <aside class="flex flex-col gap-6">
            <div class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Member Benefits</p>
                <div class="flex w-full h-[200px] rounded-3xl overflow-hidden bg-[#606DE5]">
                    <img src="{{ asset('assets/images/thumbnails/Regular-custom.png') }}" class="w-full h-full object-cover"
                        alt="icon">
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" class="w-8 h-8 flex shrink-0"
                        alt="icon">
                    <p class="leading-19 tracking-05">Sesi Latihan Pribadi</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" class="w-8 h-8 flex shrink-0"
                        alt="icon">
                    <p class="leading-19 tracking-05">Workshop, Event & Diskon</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" class="w-8 h-8 flex shrink-0"
                        alt="icon">
                    <p class="leading-19 tracking-05">Pendaftaran Semua Kelas</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" class="w-8 h-8 flex shrink-0"
                        alt="icon">
                    <p class="leading-19 tracking-05">Akses Semua Fasilitas Gym</p>
                </div>
                <a href="{{ route ('front.pricing') }}"
                    class="rounded-full py-3 px-6 bg-[#1BB1F8] font-semibold leading-19 tracking-05 text-white text-center">Jadi
                    Membership</a>
            </div>
            <div class="flex flex-col w-full rounded-3xl p-8 gap-4 bg-white">
                <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Kontak</p>
                <hr class="border-black opacity-10">
                <div class="flex items-center gap-3">
                    <div class="flex w-12 h-12 rounded-full overflow-hidden">
                        <img src="{{ asset('assets/images/photos/image-kontak.svg') }}" class="w-full h-full object-cover"
                            alt="photo">
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] text-sm leading-17 tracking-05">Sabrina Kayla</p>
                        <p class="text-xs leading-14 tracking-05 opacity-50">+62 812-3456-7890</p>
                    </div>
                </div>
            </div>
        </aside>
    </main>


    @include('components.footer')
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/details.js') }}"></script>
@endpush
