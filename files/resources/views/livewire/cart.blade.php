<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 text-right text-gray-800">🛒 سلة المشتريات</h2>
    
    @if(count($cartItems) == 0)
        <div class="text-center py-8">
            <div class="inline-block p-4 bg-blue-50 rounded-lg">
                <p class="text-gray-600 text-lg">📭 السلة فارغة حالياً</p>
            </div>
        </div>
    @else
        <!-- عناصر السلة -->
        <div class="space-y-4">
            @foreach($cartItems as $item)
                <div class="bg-white p-4 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                        <!-- الصورة -->
                        <div class="md:col-span-1">
                            <img 
                                src="{{ $item->service->getFirstMediaUrl() }}" 
                                alt="{{ $item->service->name }}"
                                class="w-full md:h-32 h-60 object-cover rounded-xl border-2 border-gray-100"
                            >
                        </div>
                        
                        <!-- تفاصيل الخدمة -->
                        <div class="md:col-span-3 text-right space-y-2">
                            <h3 class="font-bold text-lg text-gray-800">{{ $item->service->name }}</h3>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-gray-50 p-2 rounded-lg">
                                    <span class="text-gray-500">السعر:</span>
                                    <span class="text-blue-600 font-medium">{{ number_format($item->service->price, 2) }} دولار</span>
                                </div>
                                <div class="bg-gray-50 p-2 rounded-lg">
                                    <span class="text-gray-500">الكمية:</span>
                                    <span class="text-purple-600 font-medium">{{ $item->quantity }}</span>
                                </div>
                                <div class="col-span-2 bg-orange-50 p-2 rounded-lg">
                                    <span class="text-gray-500">الإجمالي:</span>
                                    <span class="text-green-600 font-bold">
                                        {{ number_format($item->service->price * $item->quantity, 2) }} دولار
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- زر الحذف -->
                        <div class="md:col-span-1 text-center">
                            <button 
                                wire:click="removeFromCart({{ $item->id }})" 
                                class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2.5 rounded-xl text-sm font-medium w-full transition-colors duration-200"
                            >
                                🗑️ حذف العنصر
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- المجموع الكلي وأزرار الدفع -->
        <div class="mt-8 text-right space-y-4">
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-2xl shadow-inner">
                <h3 class="text-xl font-bold text-gray-800">
                    💵 المجموع الكلي: {{ number_format($total, 2) }} دولار
                </h3>
            </div>

            <div class="flex flex-col md:flex-row gap-4 justify-end">
                <!-- زر الدفع الإلكتروني -->
                <button 
                    class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    المتابعة للدفع الآمن
                </button>
                
                <!-- زر الدفع اليدوي مع نافذة التأكيد -->
                <div x-data="{ open: false }" class="relative">
                    <button 
                        @click="open = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                        الدفع المباشر مع البائع
                    </button>

                    <!-- نافذة التأكيد -->
                    <div 
                        x-show="open"
                        x-cloak
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
                        style="backdrop-filter: blur(2px);"
                    >
                        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
                            <div class="p-6 text-right">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-red-600">⚠️ تنبيه هام!</h3>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        ✖
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        عند اختيار الدفع المباشر:
                                    </p>
                                    <ul class="list-disc pr-6 space-y-2 text-red-500">
                                        <li>الموقع غير مسئول عن أي عمليات نصب</li>
                                        <li>تأكد من هوية البائع بشكل شخصي</li>
                                        <li>لا تقم بإرسال أي معلومات مصرفية حساسة</li>
                                    </ul>
                                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                        <p class="text-sm text-yellow-700">
                                            نوصي باستخدام الدفع الإلكتروني الآمن لتجنب المخاطر
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-6 flex gap-3 justify-end">
                                    <button 
                                        @click="open = false"
                                        class="px-5 py-2.5 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors"
                                    >
                                        إلغاء
                                    </button>
                                    <button 
                                        wire:click="proceedToManualPayment"
                                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        تأكيد المتابعة
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>