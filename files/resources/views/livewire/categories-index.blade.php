<div class="">
    <!-- تأكد من تضمين Alpine.js في مشروعك، مثلاً عبر CDN -->
 
<div x-data="{ sidebarOpen: false }" class="max-w-screen-xl mx-auto px-4 py-8">
    <!-- زر القائمة يظهر فقط على الشاشات الصغيرة -->
    <button 
        @click="sidebarOpen = !sidebarOpen" 
        class="md:hidden mb-4 px-4 py-2 bg-blue-600 text-white rounded-md">
        القائمة الجانبية
    </button>
    
    <div class="flex flex-col md:flex-row gap-6">
        <!-- القائمة الجانبية -->
        <aside 
            :class="{'block': sidebarOpen, 'hidden': !sidebarOpen}" 
            class="w-full md:w-64 flex-shrink-0 bg-gray-50 p-4 rounded-lg shadow md:block">
            <livewire:categories.sidebar :currentCategory="$category" />
        </aside>
        
        <!-- المحتوى الرئيسي -->
        <main class="flex-grow">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <div class="relative min-h-[400px]">
                    <livewire:categories.service-list :category="$category" />
                    
                    <!-- مؤشر التحميل -->
                    <div wire:loading class="absolute inset-0 bg-white bg-opacity-80 flex items-center justify-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</div>