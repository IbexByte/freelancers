<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/scss/tailwind.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-arabic text-base text-slate-900">
        <!-- Loader Start -->
        <!-- <div id="preloader">
                <div id="status">
                    <div class="spinner">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
            </div> -->
        <!-- Loader End -->
    <div class="md:hidden bg-white w-screen flex  justify-center items-center absolute -translate-x-1/2 left-1/2 top-0 rounded-br-full rounded-bl-full  z-50">
    
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10  ">
    </div>
    
        <x-nav-left-light />
    
       
    
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    
  
    
        <x-footer />
    
        <!-- Start Cookie Popup -->
        {{-- <div
            class="cookie-popup fixed max-w-lg bottom-3 end-3 start-3 sm:start-0 mx-auto bg-white shadow rounded-md py-5 px-6 z-50">
            <p class="text-slate-400">This website uses cookies to provide you with a great user experience. By using it,
                you accept our <a href="https://shreethemes.in" target="_blank"
                    class="text-emerald-600 font-semibold">use of cookies</a></p>
            <div class="cookie-popup-actions text-end">
                <button class="absolute border-none bg-none p-0 cursor-pointer font-semibold top-2 end-2"><i
                        class="uil uil-times text-dark text-2xl"></i></button>
            </div>
        </div> --}}
        <!--Note: Cookies Js including in plugins.init.js (path like; assets/js/plugins.init.js) and Cookies css including in _helper.scss (path like; scss/_helper.scss)-->
        <!-- End Cookie Popup -->
    
        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top"
            class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-indigo-600 text-white leading-9"><i
                class="uil uil-arrow-up"></i></a>
        <!-- Back to top -->
    
        <!-- Switcher -->
        {{-- <div class="fixed top-[30%] -right-2 z-50">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" />
                <label
                    class="label bg-slate-900 shadow cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
                    for="chk">
                    <i class="uil uil-moon text-[20px] text-yellow-500"></i>
                    <i class="uil uil-sun text-[20px] text-yellow-500"></i>
                    <span class="ball bg-white rounded-full absolute top-[2px] left-[2px] size-7"></span>
                </label>
            </span>
        </div> --}}
        <!-- Switcher -->
    
        <!-- LTR & RTL Mode Code -->
        {{-- <div class="fixed top-[40%] -right-3 z-50">
            <a href="" id="switchRtl">
                <span
                    class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white shadow-md font-bold rtl:block ltr:hidden">LTR</span>
                <span
                    class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white shadow-md font-bold ltr:block rtl:hidden">RTL</span>
            </a>
        </div> --}}
        <!-- LTR & RTL Mode Code -->
        <script src="{{ asset('build/assets/app-CqflisoM.js') }}"></script>
        <!-- JAVASCRIPTS -->
        <script src="assets/libs/tobii/js/tobii.min.js"></script>
        <script src="assets/libs/tiny-slider/min/tiny-slider.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>
</html>
