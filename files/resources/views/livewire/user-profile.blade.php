<!-- القسم الرئيسي -->
<div class="flex md:flex-row  flex-col flex-1 overflow-hidden">

    <!-- الشريط الجانبي (Sidebar) -->
    <aside class="md:w-72 bg-white border-r border-gray-200 shadow-sm w-full  flex flex-row md:flex-col">
        <!-- قسم علوي: معلومات المستخدم -->


        <!-- قائمة التبويبات (Navigation Tabs) -->
        <nav class="flex-1  flex-row md:flex-col p-4 md:w-full space-y-1">
            <!-- تبويب: حسابي -->
            <button
                class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition w-full text-right
                       {{ $tab === 'account' ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-700 font-semibold' : '' }}"
                wire:click="switchTab('account')"
            >
                <i class="fas fa-user-cog text-base w-5 text-center"></i>
                <span class="flex-1">حسابي</span>
            </button>

            <!-- تبويب: الإشعارات -->
            <button
                class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition w-full text-right
                       {{ $tab === 'notifications' ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-700 font-semibold' : '' }}"
                wire:click="switchTab('notifications')"
            >
                <i class="fas fa-bell text-base w-5 text-center"></i>
                <span class="flex-1">الإشعارات</span>
            </button>

            <!-- تبويب: الخدمات (للفريلانسر) -->
            @if($userType === 'freelancer')
            <button
                class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition w-full text-right
                       {{ $tab === 'services' ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-700 font-semibold' : '' }}"
                wire:click="switchTab('services')"
            >
                <i class="fas fa-briefcase text-base w-5 text-center"></i>
                <span class="flex-1">الخدمات</span>
            </button>
            @endif

            <!-- مثال تبويب آخر: الأمان -->
            <button
                class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition w-full text-right"
            >
                <i class="fas fa-lock text-base w-5 text-center"></i>
                <span class="flex-1">الأمان</span>
            </button>

            <!-- تبويب: تسجيل الخروج -->
             <!-- Authentication -->
             <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

              
            <button
            class="flex items-center gap-2 px-3 py-2 rounded text-gray-700 hover:bg-gray-100 transition w-full text-right"
            >
            <i class="fas fa-sign-out-alt text-base w-5 text-center"></i>
                    <span class="flex-1">تسجيل الخروج</span>
                </button>
        </form>
        </nav>

        <!-- تذييل صغير في الشريط الجانبي -->
        <div class="px-6 py-4 border-t border-gray-200 text-xs text-center md:block hidden text-gray-400">
            <span>© {{ date('Y') }} اسم الموقع</span>
        </div>
    </aside>

    <!-- منطقة المحتوى (CONTENT AREA) -->
    <main class="flex-1 p-6 overflow-y-auto">
        <!-- تنبيه نجاح -->
        @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4   shadow-sm">
            <div class="flex items-center gap-2 text-green-700 text-sm">
                <i class="fas fa-check-circle"></i>
                <p>{{ session('message') }}</p>
            </div>
        </div>
        @endif

        <!-- تبويب: حسابي -->
        @if ($tab === 'account')
        <section class="bg-white border border-gray-200  p-6 shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">إعدادات الحساب</h2>
            @livewire('profile.update-profile-information-form')
            @livewire('profile.update-password-form')
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
        @endif
        </section>
        @endif

        <!-- تبويب: الإشعارات -->
        @if ($tab === 'notifications')
        <section class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">إعدادات الإشعارات</h2>
            <div class="mb-4">
                <label class="flex items-center gap-2 text-sm text-gray-700 mb-2">
                    <input type="checkbox" wire:model="notifyByEmail" class="w-4 h-4">
                    <span>إشعارات عبر البريد الإلكتروني</span>
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" wire:model="notifyBySms" class="w-4 h-4">
                    <span>إشعارات عبر الرسائل النصية</span>
                </label>
            </div>
            <button 
                class="btn-primary inline-flex items-center gap-2"
                wire:click="updateNotifications"
            >
                <i class="fas fa-save"></i>
                <span>حفظ التعديلات</span>
            </button>
        </section>
        @endif

        <!-- تبويب: الخدمات (للفريلانسر) -->
        @if($tab === 'services' && $userType === 'freelancer')
        <section class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
            <h2 class="text-xl font-bold text-gray-800 mb-4">إدارة الخدمات</h2>
            <p class="text-sm text-gray-500 mb-4">
                أضف خدماتك وأسعارك، وتابع عروضك...
            </p>
            <livewire:freelancer-settings />
        </section>
        @endif
    </main>
</div>
