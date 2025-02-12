<section class="container mx-auto px-4 py-5 mt-3">
    <!-- قسم رأس الصفحة: عرض بيانات التصنيف -->
    <header class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">{{ $category->name }}</h1>
        <p class="text-gray-600 mt-2 max-w-2xl mx-auto">{{ $category->description }}</p>
    </header>

    <!-- المحتوى الرئيسي: عرض خدمات كبطاقات مع سلايدر للوسائط -->
    <main>
        @if($services->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-200 border border-gray-100">
                        <!-- سلايدر الوسائط -->
                        <div class="relative aspect-video bg-gray-100 rounded-t-lg overflow-hidden">
                            @if($service->media->count())
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($service->media as $media)
                                            <div class="swiper-slide">
                                                @if($media->type == 'image')
                                                    <img src="{{ asset('storage/'.$media->file_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                                                @elseif($media->type == 'video')
                                                    <video src="{{ asset('storage/'.$media->file_path) }}" controls class="w-full h-full object-cover"></video>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Navigation -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            @else
                                <!-- حالة عدم وجود وسائط: عرض صورة بديلة -->
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- تفاصيل الخدمة -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $service->title }}</h3>
                                <span class="text-blue-600 font-bold">{{ number_format($service->price) }}دولار</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $service->description }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $service->user->profile_photo_url }}" alt="{{ $service->user->name }}" class="w-6 h-6 rounded-full">
                                    <span>{{ $service->user->name }}</span>
                                </div>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ $service->rating }}
                                </span>
                            </div>
                        </div>

                        <!-- زر عرض التفاصيل -->
                        <div class="px-4 pb-4">
                            <a href="{{ route('services.show', $service) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ترقيم الصفحات -->
            <div class="mt-8">
                {{ $services->links() }}
            </div>
        @else
            <!-- حالة عدم وجود خدمات -->
            <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">لا توجد خدمات متاحة</h3>
                <p class="mt-1 text-gray-500">حاول تعديل فلترات البحث الخاصة بك</p>
            </div>
        @endif
    </main>

<!-- تهيئة السلايدر لكل عنصر -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.swiper-container').forEach(function (slider) {
            new Swiper(slider, {
                loop: true,
                pagination: {
                    el: slider.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: slider.querySelector('.swiper-button-next'),
                    prevEl: slider.querySelector('.swiper-button-prev'),
                },
            });
        });
    });
</script>

<!-- (اختياري) تخصيص إضافي لشريط النطاق إن استخدمته -->
<style>
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 16px;
        width: 16px;
        background: #2563eb;
        border-radius: 50%;
        cursor: pointer;
    }
</style>
</section>


