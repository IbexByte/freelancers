<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة تحكّم المستخدم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS / Your compiled CSS -->
    <!-- FontAwesome Icons (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/scss/tailwind.scss', 'resources/js/app.js'])
<!-- في قسم ال head -->
<link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css">
<style>
    .swiper-container {
        overflow: hidden;
        position: relative;
    }

    .swiper-button-prev,
    .swiper-button-next {
        width: 40px;
        height: 40px;
        backdrop-filter: blur(4px);
        transition: all 0.3s ease;
        --swiper-navigation-size: 20px;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-weight: 900;
    }
</style>
<!-- في نهاية قسم ال body -->
    @livewireStyles
</head>

<body class="font-arabic bg-gray-50 text-gray-700 min-h-screen flex flex-col">

 
    <x-nav-left-light />

  <!-- منطقة المحتوى الرئيسية -->
  <div class="flex-1 mt-12">
    {{ $slot }}
</div>

    <!-- 3) Footer -->
    <footer class="bg-white text-gray-400 h-10 flex items-center justify-center text-sm border-t mt-auto">
        <span>© {{ date('Y') }} اسم المنصة - جميع الحقوق محفوظة</span>
    </footer>

    @livewireScripts
    <!-- Additional JS (e.g., from your Mix/Vite or external libs) -->
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Example: Toggle the sidebar on mobile
        // Already included with the hamburger button onClick, but you can add more logic here.
    </script>
</body>

</html>
