<div>
    <!-- زر إضافة إلى السلة -->
    <div class="flex flex-col sm:flex-row gap-3">
        <button wire:click="addToCart"
                class="flex-1 py-4 px-8 bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:shadow-lg transition-all flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="text-lg">أضف إلى السلة</span>
        </button>
        <button wire:click="showContactForm"
                class="py-4 px-8 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 transition-colors">
            <span class="text-lg">تواصل مع البائع</span>
        </button>
    </div>

    <!-- رسائل النجاح أو الخطأ -->
    @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>