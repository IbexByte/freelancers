<!--
  ملاحظات أساسية:
  1) وضعنا class="hidden" على div.sidebar-overlay لإخفائه افتراضياً.
  2) عند الضغط على زر الهمبرغر, نقوم بtoggle لكلا:
      - body.classList('sidebar-open')
      - overlay.classList('hidden')
  3) الآن، حين يكون مخفيًا، لن يعيق النقر على المحتوى.
  4) حينما يكون ظاهراً (عند فتح الـSidebar)، يمكن النقر في أي مكان لغلقه.
-->

<div dir="rtl" class="rtl">

    <!-- شريط التنقل العلوي (Top Navbar) - للشاشات المتوسطة فأعلى -->
    <nav class="hidden md:flex bg-white shadow-lg fixed top-0 left-0 w-full z-50 h-13 ">
        <div class="container mx-auto px-4 py-1 flex items-center justify-between">

            <!-- يمين: زر همبرغر + الشعار -->
            <div class="flex items-center gap-4">
                <button class="hamburger-menu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10">
            </div>

            <!-- الروابط الرئيسية -->
            <div class="flex gap-6">
                <a href="{{ route('services') }}" class="hover:text-blue-600">➕ أضف خدمة</a>
                <livewire:categories-menu />
                <livewire:cart-notification />

                <livewire:incoming-orders-notification />

            </div>

            <!-- أدوات المستخدم -->
            <div class="flex items-center gap-4">
                @guest
                    <!-- إذا لم يكن مسجّل الدخول: زر تسجيل الدخول وزر التسجيل -->
                    <a href="{{ route('login') }}" class="hover:text-blue-600">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="ms-1">تسجيل الدخول</span>
                    </a>
                    <a href="{{ route('register') }}" class="hover:text-blue-600">
                        <i class="fas fa-user-plus"></i>
                        <span class="ms-1">إنشاء حساب</span>
                    </a>
                @endguest

                @auth
                    <!-- إذا كان المستخدم مسجّل الدخول: أيقونات الأدوات -->
                    <button class="hover:text-blue-600">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <button class="hover:text-blue-600">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="hover:text-blue-600">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="hover:text-blue-600">
                        <i class="fas fa-bell"></i>
                    </button>

                    <!-- أفاتار المستخدم + القائمة المنسدلة -->
                    <div class="relative group">
                        <button class="user-avatar">
                            <i class="fas fa-user"></i>
                        </button>
                        <div
                            class="dropdown-menu hidden group-hover:block absolute right-0 w-48 bg-white shadow-lg rounded-lg p-2">
                            <x-dropdown-link href="{{ route('userProfile') }}">
                                {{ __('site.profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('userProfile') }}">
                                {{ __('site.settings') }}
                            </x-dropdown-link>
                            <!-- تسجيل الخروج -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </nav>

    <!-- شريط سفلي (Bottom Navbar) - للشاشات الصغيرة -->
    <nav class="md:hidden fixed bottom-0 w-full bg-white border-t-2 z-50">
        <div class="flex justify-around py-1">
            <a href="#" class="mobile-nav-item active">
                <i class="fas fa-home text-xl"></i>
                <span class="text-xs">الرئيسية</span>
            </a>
            <a href="{{ route('cart.index') }}" class="mobile-nav-item">
                <i class="fas fa-envelope"></i>
                <span class="text-xs">الرسائل</span>
            </a>
            <a href="{{ route('cart.index') }}" class="mobile-nav-item">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="text-xs">السلة</span>
            </a>
            <!-- زر همبرغر للشاشات الصغيرة -->
            <a href="#" class="mobile-nav-item" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
                <span class="text-xs">القائمة</span>
            </a>
        </div>
    </nav>

    <!-- القائمة الجانبية (Sidebar) + خلفية التعتيم -->
    <!-- sidebar.blade.php -->
    <div dir="rtl" class="rtl relative">

        <!-- شريط علوي (للكبيرة) - افتراض ارتفاعه 64px -->
        <nav class="hidden md:flex bg-white shadow-lg fixed top-0 left-0 w-full h-13  z-60 ">
            <div class="container mx-auto px-4  flex items-center justify-between h-full">

                <div class="flex items-center gap-4">
                    <!-- زر همبرغر يفتح/يغلق الـSidebar -->
                    <button class="hamburger-menu" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <img src="logo.png" alt="Logo" class="h-10">
                </div>

                <!-- الروابط الرئيسية -->
                <div class="flex gap-6">
                    <a href="{{ route('services') }}" class="hover:text-blue-600">➕ أضف خدمة</a>
                    <a href="#" class="hover:text-blue-600">📂 التصنيفات</a>
                    <livewire:cart-notification />
                    <livewire:incoming-orders-notification />

                </div>

                <!-- أدوات المستخدم -->
                <div class="flex items-center gap-4">
                    <button class="hover:text-blue-600"><i class="fas fa-shopping-cart"></i></button>
                    <button class="hover:text-blue-600"><i class="fas fa-search"></i></button>
                    <a href="{{ route('cart.index') }}" class="hover:text-blue-600"><i class="fas fa-envelope"></i></a>
                    <button class="hover:text-blue-600"><i class="fas fa-bell"></i></button>

                    <div class="relative group">
                        <button class="user-avatar">
                            <i class="fas fa-user"></i>
                        </button>
                        <div
                            class="dropdown-menu hidden group-hover:block absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-2">
                            <a href="#" class="block p-2 hover:bg-gray-100">الملف الشخصي</a>
                            <a href="#" class="block p-2 hover:bg-gray-100">الإعدادات</a>
                            <a href="#" class="block p-2 hover:bg-gray-100 text-red-600">تسجيل الخروج</a>
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <!-- شريط سفلي (للجوال) - افتراض ارتفاعه ~60px -->
        <nav class="md:hidden fixed bottom-0 w-full bg-white border-t-2 z-50 h-15 py-3">
            <div class="flex justify-around items-center h-full">
                <a href="/" class="mobile-nav-item active">
                    <i class="fas fa-home text-xl"></i>
                    <span class="text-xs">الرئيسية</span>
                </a>
                <a href="{{ route('chat') }}" class="mobile-nav-item">
                    <i class="fas fa-envelope  text-xl"></i>
                    <span class="text-xs">الرسائل</span>
                </a>
                <a href="{{ route('cart.index') }}" class="mobile-nav-item">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="text-xs">السلة</span>
                </a>
                <!-- زر همبرغر للجوال -->
                <a href="#" class="mobile-nav-item" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                    <span class="text-xs">القائمة</span>
                </a>
            </div>
        </nav>

        <!-- الـOverlay تغطي كامل الشاشة، تظهر عند الفتح -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()">
            <!-- خلفية معتمة -->
            <div class="backdrop"></div>

            <!-- الـSidebar نفسه
             منع النقر داخله من غلقه بـ stopPropagation() -->
            <aside class="sidebar z-999" onclick="event.stopPropagation()">

                <div class="p-4 border-b">
                    <div class="relative">
                        <input type="text" placeholder="ابحث عن..."
                            class="w-full rounded border pl-9 pr-3 py-2 text-sm
                                focus:outline-none focus:border-blue-400">
                        <i class="fas fa-search absolute left-3 top-2 text-gray-400 text-sm"></i>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto p-4">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('services') }}" class="sidebar-link">
                                <i class="fas fa-plus"></i>
                                <span>أضف خدمة</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index' ) }}" class="sidebar-link">
                                <i class="fas fa-shopping-bag"></i>
                                <span>المشتريات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('incoming-orders') }}" class="sidebar-link">
                                <i class="fas fa-truck"></i>
                                <span>الطلبات الواردة</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category.show', 1) }}" class="sidebar-link">
                                <i class="fas fa-box-open"></i>
                                <span>التصنيفات</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-hashtag"></i>
                                <span>تابعنا</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="border-t p-4">
                    <a href="#"
                        class="flex items-center gap-2 text-gray-600 hover:text-blue-500 transition text-sm">
                        <i class="fas fa-cog"></i>
                        <span>الإعدادات</span>
                    </a>
                </div>

                <!-- الروابط الخاصة بتسجيل الدخول أو الملف الشخصي -->
                <div class="border-t p-4">
                    @guest
                        <!-- إذا كان المستخدم غير مسجّل الدخول -->
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('login') }}"
                                class="flex items-center gap-2 text-gray-600 hover:text-blue-500 transition text-sm">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>تسجيل الدخول</span>
                            </a>
                            <a href="{{ route('register') }}"
                                class="flex items-center gap-2 text-gray-600 hover:text-blue-500 transition text-sm">
                                <i class="fas fa-user-plus"></i>
                                <span>إنشاء حساب</span>
                            </a>
                        </div>
                    @endguest

                    @auth
                        <!-- إذا كان المستخدم مسجّل الدخول -->
                        <a href="{{ route('userProfile') }}"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-500 transition text-sm">
                            <i class="fas fa-user-circle"></i>
                            <span>ملفي الشخصي</span>
                        </a>
                    @endauth
                </div>
            </aside>

        </div>
    </div>

    <!-- سكربت التحكم بالـSidebar -->
    <script>
        function toggleSidebar() {
            const overlay = document.getElementById('sidebarOverlay');
            // فتح/إغلاق عبر class .open
            overlay.classList.toggle('open');
        }
    </script>

</div>
