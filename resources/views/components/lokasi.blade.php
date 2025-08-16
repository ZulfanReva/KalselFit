<section id="location" class="flex flex-col w-full max-w-[1280px] gap-8 mx-auto px-10 mt-[120px]">
     <div class="flex items-center justify-between">
         <div class="flex flex-col gap-4">
             <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Lokasi Gym</h2>
             <p class="leading-19 tracking-03 opacity-60">Temukan Gym terdekat di lokasi Anda, nikmati fasilitas top di
                 Jakarta, Bandung, Surabaya, dan kota lainnya</p>
         </div>
     </div>
     <div class="flex items-center justify-center gap-4 flex-wrap">
         @forelse ($cities as $itemcity)
             <a href="location-result.html" tabindex="0"
                 class="focus-lokasi rounded-full transition-all duration-200 block">
                 <div
                     class="focus-border-lokasi flex items-center rounded-full p-3 pr-6 gap-3 bg-white border-2 border-transparent hover:border-[#1BB1F8] transition-all duration-200">
                     <div class="w-10 h-10 flex shrink-0 rounded-full overflow-hidden">
                         <img src="{{ Storage::url($itemcity->photo) }}" class="w-full h-full object-cover"
                             alt="icon">
                     </div>
                     <span class="leading-19 tracking-03 text-black">{{ $itemcity->name }}</span>
                 </div>
             </a>
         @empty
             <p>Belum ada data</p>
         @endforelse
     </div>
 </section>
