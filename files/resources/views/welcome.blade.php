<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Techwind - Tailwind CSS Multipurpose Landing & Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tailwind CSS Multipurpose Landing & Admin Dashboard Template">
    <meta name="keywords"
        content="agency, application, business, clean, creative, cryptocurrency, it solutions, modern, multipurpose, nft marketplace, portfolio, saas, software, tailwind css">
    <meta name="author" content="Shreethemes">
    <meta name="website" content="https://shreethemes.in">
    <meta name="email" content="support@shreethemes.in">
    <meta name="version" content="2.4.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Css -->
    <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet">
    <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
    <!-- Main Css -->
    <link href="assets/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/tailwind.scss', 'resources/js/app.js'])
    @else
    @endif

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


    <x-nav-left-light />

    <!-- Start Hero -->
    <!-- Start Hero Section -->
    <section
        class="relative md:h-screen md:py-0 py-36 items-center overflow-hidden bg-indigo-600 bg-[url('../../assets/images/bg3.png')] bg-center bg-no-repeat bg-cover">
        <div class="container relative">
            <div class="grid grid-cols-1 md:mt-36 mt-10 text-center">
                <h4 class="font-bold text-white lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5">
                    {{ __('site.hero_title') }} <span class="text-orange-500"><br> {{ __('site.hero_subtitle') }}</span>
                </h4>

                <!-- Search Form -->
                <div class="search-form mt-6 mb-3">
                    <form class="relative max-w-xl mx-auto">
                        <input type="text" id="search-service" name="service"
                            class="form-input border-0 py-4 pe-40 ps-6 w-full h-[50px] outline-none text-slate-900 rounded-full bg-white shadow"
                            placeholder="{{ __('site.search_placeholder') }}">
                        <button type="submit"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center absolute top-[2px] end-[3px] h-[46px] bg-orange-500 hover:bg-orange-600 border-orange-500 hover:border-orange-600 text-white rounded-full">
                            {{ __('site.search_button') }} <i class="uil uil-search"></i>
                        </button>
                    </form><!-- end form -->
                </div>

                <!-- Popular Searches -->
                <div class="popular-searches mt-4">
                    <span class="text-white text-lg font-medium">{{ __('site.popular_searches') }}</span>
                    <div class="flex justify-center mt-2 space-x-3">
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full text-white text-sm cursor-pointer hover:bg-white/30">
                            {{ __('site.popular_search_example1') }}
                        </span>
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full text-white text-sm cursor-pointer hover:bg-white/30">
                            {{ __('site.popular_search_example2') }}
                        </span>
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full text-white text-sm cursor-pointer hover:bg-white/30">
                            {{ __('site.popular_search_example3') }}
                        </span>
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full text-white text-sm cursor-pointer hover:bg-white/30">
                            {{ __('site.popular_search_example4') }}
                        </span>
                    </div>
                </div>

                <span class="text-slate-400 font-medium mt-4">
                    {{ __('site.need_help') }} <a href=""
                        class="text-orange-500">{{ __('site.contact_us') }}</a>
                </span>

                <div class="overflow-hidden mt-8">
                    <img src="assets/images/saas/dashboard.png" alt="{{ __('site.dashboard_image_alt') }}">
                </div>
            </div><!-- end grid -->
        </div><!-- end container -->
    </section><!-- end section -->

    <!--end section-->
    <div class="relative">
        <div class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden text-white">
            <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 48" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!-- End Hero -->


    <!-- Start -->
    <section class="relative md:py-24 py-16 overflow-hidden">


        <!-- Start Categories Section -->
        <section class="py-16">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                        {{ __('site.categories_section_title') }}
                    </h3>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
                    @forelse ($categories as $category)
                        <!-- Category 1 -->
                        <div class="relative group overflow-hidden rounded-xl shadow-lg">
                            <img src="{{ $category->getImageUrlAttribute() }}"
                                alt="{{ __('site.category_web_design') }}"
                                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-black/50 flex justify-center items-center text-white text-xl font-semibold">
                                {{ $category->name }}
                            </div>
                        </div>

                    @empty
                        {{ 'لاتوجد تصنيفات' }}
                    @endforelse


                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->



        <!-- Start Popular Services Section -->
        <section class="py-16 bg-gray-100">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                        {{ __('site.popular_services_section_title') }}
                    </h3>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
                    <!-- Service 1 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-lg bg-white p-6 flex flex-col items-center text-center hover:bg-indigo-600 hover:text-white transition-all duration-500">
                        <div class="bg-indigo-100 text-indigo-600 rounded-full p-4 mb-4">
                            <i class="uil uil-palette text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-medium">{{ __('site.service_graphic_design') }}</h4>
                        <p class="text-slate-500 group-hover:text-white mt-2">تصميم شعارات، هويات بصرية وإبداعات أخرى.
                        </p>
                    </div>

                    <!-- Service 2 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-lg bg-white p-6 flex flex-col items-center text-center hover:bg-orange-500 hover:text-white transition-all duration-500">
                        <div class="bg-orange-100 text-orange-600 rounded-full p-4 mb-4">
                            <i class="uil uil-megaphone text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-medium">{{ __('site.service_digital_marketing') }}</h4>
                        <p class="text-slate-500 group-hover:text-white mt-2">إعلانات مدفوعة، حملات تسويقية
                            واستراتيجيات النمو.</p>
                    </div>

                    <!-- Service 3 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-lg bg-white p-6 flex flex-col items-center text-center hover:bg-green-500 hover:text-white transition-all duration-500">
                        <div class="bg-green-100 text-green-600 rounded-full p-4 mb-4">
                            <i class="uil uil-chart-line text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-medium">{{ __('site.service_seo') }}</h4>
                        <p class="text-slate-500 group-hover:text-white mt-2">تحسين ترتيب موقعك على محركات البحث.</p>
                    </div>

                    <!-- Service 4 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-lg bg-white p-6 flex flex-col items-center text-center hover:bg-red-500 hover:text-white transition-all duration-500">
                        <div class="bg-red-100 text-red-600 rounded-full p-4 mb-4">
                            <i class="uil uil-video text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-medium">{{ __('site.service_video_editing') }}</h4>
                        <p class="text-slate-500 group-hover:text-white mt-2">مونتاج احترافي وإنتاج مقاطع فيديو
                            إبداعية.</p>
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->



        <!-- Start Recommended Services Section -->
        <section class="py-16 bg-gradient-to-b from-gray-100 to-white">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                        {{ __('site.recommended_services_section_title') }}
                    </h3>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                    <!-- Service Card 1 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-xl bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <img src="data:image/jpeg;base64,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"
                            alt="{{ __('site.service_graphic_design') }}"
                            class="w-full h-44 object-cover rounded-md">
                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-md">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold">{{ __('site.service_graphic_design') }}</h4>
                            <p class="text-gray-500 text-sm mt-2">{{ __('site.category_web_design') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-orange-500 font-semibold">{{ __('site.service_starting_from') }}
                                    $50</span>
                                <span class="flex items-center text-yellow-500">
                                    <i class="uil uil-star"></i> 4.8
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-xl bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <img src="data:image/jpeg;base64,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"
                            alt="{{ __('site.service_digital_marketing') }}"
                            class="w-full h-44 object-cover rounded-md">
                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-md">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold">{{ __('site.service_digital_marketing') }}</h4>
                            <p class="text-gray-500 text-sm mt-2">{{ __('site.category_social_media') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-orange-500 font-semibold">{{ __('site.service_starting_from') }}
                                    $40</span>
                                <span class="flex items-center text-yellow-500">
                                    <i class="uil uil-star"></i> 4.7
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-xl bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <img src="data:image/jpeg;base64,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"
                            alt="{{ __('site.service_seo') }}" class="w-full h-44 object-cover rounded-md">
                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-md">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold">{{ __('site.service_seo') }}</h4>
                            <p class="text-gray-500 text-sm mt-2">{{ __('site.category_programming') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-orange-500 font-semibold">{{ __('site.service_starting_from') }}
                                    $30</span>
                                <span class="flex items-center text-yellow-500">
                                    <i class="uil uil-star"></i> 4.9
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Service Card 4 -->
                    <div
                        class="relative group overflow-hidden rounded-xl shadow-xl bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <img src="data:image/jpeg;base64,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"
                            alt="{{ __('site.service_video_editing') }}" class="w-full h-44 object-cover rounded-md">
                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-md">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold">{{ __('site.service_video_editing') }}</h4>
                            <p class="text-gray-500 text-sm mt-2">{{ __('site.category_content_writing') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-orange-500 font-semibold">{{ __('site.service_starting_from') }}
                                    $60</span>
                                <span class="flex items-center text-yellow-500">
                                    <i class="uil uil-star"></i> 4.6
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->

        <!-- Start Business Solutions Section -->
        <section class="py-16 bg-gray-50">
            <div class="container relative">
                <div class="text-center pb-8">
                    <h3 class="mb-6 md:text-3xl text-2xl font-semibold">
                        {{ __('site.business_solutions_section_title') }}
                    </h3>
                </div>

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
                    <!-- Solution Card -->
                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-indigo-600 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_digital_transformation') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-orange-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_start_business') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-green-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_create_store') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-blue-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_launch_website') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-purple-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_wordpress') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-red-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_digital_marketing') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-yellow-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_create_course') }}
                        </h4>
                    </a>

                    <a href="#"
                        class="group relative block rounded-xl overflow-hidden shadow-lg bg-white p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                        <div
                            class="absolute inset-0 bg-teal-500 opacity-20 group-hover:opacity-50 transition-opacity duration-500">
                        </div>
                        <h4
                            class="relative z-10 text-lg font-semibold text-center text-gray-800 group-hover:text-white">
                            {{ __('site.solution_publish_book') }}
                        </h4>
                    </a>
                </div>
            </div>
        </section>

        <!-- Start How It Works Section -->
        <section class="py-16 bg-gray-100">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-8 text-center">
                    <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                        {{ __('site.how_it_works') }}
                    </h3>
                    <p class="text-slate-500 max-w-xl mx-auto">
                        {{ __('site.how_it_works_desc') }}
                    </p>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                    <!-- Service 1 -->
                    <div class="group relative bg-white shadow p-6 duration-500 rounded-xl text-center h-fit">
                        <div class="relative text-indigo-600 text-3xl flex justify-center items-center">
                            <i class="uil uil-airplay"></i>
                        </div>
                        <div class="mt-6">
                            <a href=""
                                class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">
                                {{ __('site.service_ux_ui') }}
                            </a>
                            <p class="text-slate-400 mt-3">
                                تصميم واجهات وتجربة مستخدم احترافية لتحسين تجربة العملاء.
                            </p>
                        </div>
                    </div>
                    <!-- Service 2 -->
                    <div class="group relative bg-white shadow p-6 duration-500 rounded-xl text-center h-fit md:mt-16">
                        <div class="relative text-indigo-600 text-3xl flex justify-center items-center">
                            <i class="uil uil-shutter"></i>
                        </div>
                        <div class="mt-6">
                            <a href=""
                                class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">
                                {{ __('site.service_ios') }}
                            </a>
                            <p class="text-slate-400 mt-3">
                                تطوير تطبيقات iOS عالية الجودة بأحدث التقنيات.
                            </p>
                        </div>
                    </div>
                    <!-- Service 3 -->
                    <div class="group relative bg-white shadow p-6 duration-500 rounded-xl text-center h-fit">
                        <div class="relative text-indigo-600 text-3xl flex justify-center items-center">
                            <i class="uil uil-cog"></i>
                        </div>
                        <div class="mt-6">
                            <a href=""
                                class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">
                                {{ __('site.service_security') }}
                            </a>
                            <p class="text-slate-400 mt-3">
                                تأمين مواقع الويب وحماية البيانات من التهديدات السيبرانية.
                            </p>
                        </div>
                    </div>
                    <!-- Service 4 -->
                    <div class="group relative bg-white shadow p-6 duration-500 rounded-xl text-center h-fit md:mt-16">
                        <div class="relative text-indigo-600 text-3xl flex justify-center items-center">
                            <i class="uil uil-comment"></i>
                        </div>
                        <div class="mt-6">
                            <a href=""
                                class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">
                                {{ __('site.service_support') }}
                            </a>
                            <p class="text-slate-400 mt-3">
                                دعم فني متاح على مدار الساعة لمساعدتك في أي وقت.
                            </p>
                        </div>
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- Partners -->
        <section class="py-6 border-t border-b border-gray-100">
            <div class="container relative">
                <div class="grid md:grid-cols-6 grid-cols-2 justify-center gap-[30px]">
                    <div class="mx-auto py-4">
                        <img src="assets/images/client/amazon.svg" class="h-6" alt="">
                    </div>

                    <div class="mx-auto py-4">
                        <img src="assets/images/client/google.svg" class="h-6" alt="">
                    </div>

                    <div class="mx-auto py-4">
                        <img src="assets/images/client/lenovo.svg" class="h-6" alt="">
                    </div>

                    <div class="mx-auto py-4">
                        <img src="assets/images/client/paypal.svg" class="h-6" alt="">
                    </div>

                    <div class="mx-auto py-4">
                        <img src="assets/images/client/shopify.svg" class="h-6" alt="">
                    </div>

                    <div class="mx-auto py-4">
                        <img src="assets/images/client/spotify.svg" class="h-6" alt="">
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section>
        <!-- Partners -->

    </section><!--end section-->
    <!-- End -->

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
