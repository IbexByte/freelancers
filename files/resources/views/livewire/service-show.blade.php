<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
    <style>
        .prose {
            line-height: 1.75;
        }
        
        .prose h2 {
            @apply text-2xl font-bold mt-8 mb-4 text-gray-800;
        }
        
        .prose ul {
            @apply list-disc pl-6 mb-4;
        }
        
        .prose li {
            @apply mb-2;
        }
        
        .prose a {
            @apply text-blue-600 hover:underline;
        }
        </style>
    <!-- القسم العلوي -->
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
        <!-- معرض الوسائط -->
    <!-- معرض الوسائط -->
<div x-data="{ mainImageUrl: '{{ $service->getFirstMediaUrl('main') }}' }">
    <!-- الصورة الرئيسية -->
    <div class="relative group">
        <div class="aspect-square bg-gradient-to-r from-blue-50 to-purple-50  shadow-2xl overflow-hidden">
            <img :src="mainImageUrl" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                 alt="{{ $service->title }}">
            
            <!-- عناصر التحكم -->
            <div class="absolute top-4 right-4 space-y-2">
                <button wire:click="toggleFavorite"
                        class="p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-lg hover:bg-white transition-all">
                    <svg class="w-7 h-7 {{ $isFavorite ? 'text-red-500 fill-current' : 'text-gray-600' }}" 
                         viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- الصور المصغرة -->
    @if($service->media->count() > 1)
    <div class="grid grid-cols-4 gap-3 mt-6">
        @foreach($service->media as $media)
        <div @click="mainImageUrl = '{{ asset('storage/' . $media->file_path) }}'"
             class="aspect-square cursor-pointer relative overflow-hidden  bg-gray-100 hover:ring-4 ring-blue-200 transition-all">
            <img src="{{ asset('storage/' . $media->file_path) }}" 
                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            <div class="absolute inset-0 bg-black/20 hover:bg-transparent transition-colors"></div>
        </div>
        @endforeach
    </div>
    @endif
</div>

        <!-- معلومات الخدمة -->
        <div class="space-y-8">
            <!-- العنوان والتقييم -->
            <div class="border-b border-gray-200 pb-6">
                <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $service->title }}</h1>
                <div class="flex items-center gap-3 text-lg">
                    <div class="flex items-center">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-7 h-7 {{ $i < $service->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-gray-600">({{ $service->reviews_count }} تقييمات)</span>
                </div>
            </div>

            <!-- السعر والإجراءات -->
            <div class="space-y-6">
                <div class="flex items-end gap-4">
                    <span class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        {{ number_format($service->price) }} دولار
                    </span>
                    @if($service->discount)
                    <span class="text-xl text-gray-500 line-through">{{ number_format($service->original_price) }} دولار</span>
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button wire:click="addToCart"
                            class="flex-1 py-4 px-8 bg-gradient-to-r from-blue-600 to-purple-600 text-white  hover:shadow-lg transition-all flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-lg">أضف إلى السلة</span>
                    </button>
                    <button wire:click="showContactForm"
                            class="py-4 px-8 border-2 border-blue-600 text-blue-600  hover:bg-blue-50 transition-colors">
                        <span class="text-lg">تواصل مع البائع</span>
                    </button>
                </div>
            </div>

            <!-- المواصفات -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 bg-white  shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-blue-50 ">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">مدة التسليم</p>
                        <p class="font-semibold">{{ $service->delivery_time }} أيام</p>
                    </div>
                </div>
                
                <!-- كرت التحديثات -->
                <div class="p-5 bg-white  shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-purple-50 ">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">التحديثات</p>
                        <p class="font-semibold">{{ $service->revisions }} مراجعات</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- القسم السفلي -->
    <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
        <!-- الوصف التفصيلي -->
        <div class="lg:col-span-2">
            <div class="bg-white p-8  shadow-lg">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">تفاصيل الخدمة</h2>
                <div class="prose prose-lg max-w-none text-gray-600">
                    {!! $service->description !!}
                </div>
            </div>

            <!-- التقييمات -->
            <div class="mt-8 bg-white p-8  shadow-lg">
                <h3 class="text-3xl font-bold mb-6 text-gray-800">آراء العملاء ({{ $service->reviews_count }})</h3>
                <div class="space-y-6">
                    @foreach($reviews as $review)
                    <div class="p-6 bg-gray-50  hover:bg-white transition-colors">
                        <div class="flex items-start gap-4">
                            <img src="{{ $review->user->profile_photo_url }}" 
                                 class="w-12 h-12 rounded-full object-cover shadow-sm">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h4 class="font-semibold">{{ $review->user->name }}</h4>
                                    <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center gap-1 mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- معلومات البائع -->
        <div class="space-y-8">
            <div class="bg-white p-8  shadow-lg">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">معلومات البائع</h3>
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $service->user->profile_photo_url }}" 
                         class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                    <div>
                        <p class="text-xl font-semibold">{{ $service->user->name }}</p>
                        <p class="text-gray-500">عضو منذ {{ $service->user->created_at->format('Y') }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3 p-4 bg-blue-50 ">
                        <div class="p-2 bg-white  shadow-sm">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">سرعة الرد</p>
                            <p class="text-sm text-gray-500">متوسط وقت الاستجابة: 2 ساعة</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-purple-50 ">
                        <div class="p-2 bg-white  shadow-sm">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">متصل الآن</p>
                            <p class="text-sm text-gray-500">آخر ظهور قبل 15 دقيقة</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- خدمات مشابهة -->
            <div class="bg-white p-8  shadow-lg">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">خدمات مشابهة</h3>
                <div class="space-y-4">
                    @foreach($relatedServices as $service)
                    <a href="#" class="group flex items-center gap-4 p-3 hover:bg-gray-50  transition-colors">
                        <img src="{{ $service->getFirstMediaUrl('thumbnail') }}" 
                             class="w-16 h-16  object-cover shadow-sm group-hover:scale-105 transition-transform">
                        <div>
                            <p class="font-medium group-hover:text-blue-600 transition-colors">{{ $service->title }}</p>
                            <p class="text-sm text-gray-500">{{ number_format($service->price) }} دولار</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

