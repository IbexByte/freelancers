<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة تحكّم المستخدم</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

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

        /* قم بوضع هذا في ملف CSS منفصل أو داخل وسم <style> في أعلى الصفحة */

        .hide-scrollbar {
            /* لإخفاء الشريط في فايرفوكس */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            /* لإخفاء الشريط في كروم وسفاري */
            width: 0px;
            height: 0px;
            display: none;
        }
    </style>
    <!-- في نهاية قسم ال body -->
    @livewireStyles
</head>

<body class=" h-full font-arabic-noto  overflow-hidden bg-[#eee] text-gray-900 antialiased font-sans no-scrollbar">
     
    <div class="h-screen w-screen overflow-auto">
        <!-- العنصر الابن يسمح بالتمرير عند الحاجة -->
        <div class="h-full w-full overflow-auto no-scrollbar">
            {{ $slot }}
        </div>
    </div>






    @livewireScripts
    <!-- Additional JS (e.g., from your Mix/Vite or external libs) -->
 
</body>

</html>
