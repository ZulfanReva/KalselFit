 <header class="relative flex flex-col w-full h-[1044px] overflow-hidden -mb-[140px]">
     <img src="{{ asset('assets/images/backgrounds/Header Illustration.svg') }}"
         class="absolute w-full h-full object-cover" alt="backgrounds">
     <nav class="relative flex items-center justify-between w-full max-w-[1280px] mx-auto px-10 mt-10">
         <a href="index.html">
             <img src="{{ asset('assets/images/logos/Logo.svg') }}" class="flex shrink-0" alt="logo">
         </a>
         <ul class="flex items-center gap-6 justify-end">
             <li>
                 <a href="#" class="leading-19 tracking-03 text-[#141414]">Subscribe Plan</a>
             </li>
             <li>
                 <a href="#" class="leading-19 tracking-03 text-[#141414]">Blog</a>
             </li>
             <li>
                 <a href="#" class="leading-19 tracking-03 text-[#141414]">Testimonial</a>
             </li>
             <li>
                 <a href="#" class="leading-19 tracking-03 text-[#141414]">About</a>
             </li>
             <li>
                 <a href="#"
                     class="leading-19 tracking-0.5 text-white font-semibold rounded-[22px] py-3 px-6 bg-[#1BB1F8]">My
                     Membership</a>
             </li>
         </ul>
     </nav>
     <div id="hero-text" class="relative flex flex-col items-center mx-auto mt-[96px]">
         <div class="flex items-center  align-middle w-fit rounded-[38px] p-2 pr-6 gap-3 bg-white">
             <img src="{{ asset('assets/images/photos/triple-photo-custom.png') }}"
                 class="flex shrink-0 max-w-full h-10 w-auto justify-start" alt="photos">
             <p class="leading-19 text-[#1BB1F8]">Lebih dari <span class="font-semibold">100K+</span> Member Telah
                 Bergabung!</p>
         </div>
         <h1 class="font-['ClashDisplay-Bold'] text-[48px] text-white mt-4">Healthy Can Change Your Life</h1>
         <p class="leading-19 text-white">Mulai Perjalanan Transformasimu Bersama Kami</p>
         <form action="#" class="flex items-center w-[487px] rounded-[53px] p-2 pl-6 gap-6 bg-white mt-[38px]">
             <input type="text" name="" id=""
                 class="appearance-none outline-none !bg-white w-full leading-19 font-semibold placeholder:text-[#3F3F3F80]"
                 placeholder="Cari gym terdekat..">
             <button type="submit"
                 class="rounded-[48px] py-4 px-6 bg-[#1BB1F8] font-semibold leading-19 text-white">Search</button>
         </form>
     </div>
 </header>
