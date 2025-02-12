<div dir="rtl" class="p-6 rtl space-y-6" x-data="{ showTips: true }">
    <!-- رسالة النجاح -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-emerald-500 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-emerald-700 font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <!-- زر الإضافة الرئيسي -->
    @if (!$showForm)
        <div class="flex justify-end mb-6">
            <button wire:click="showAddForm"
                class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3  transition-all shadow-lg">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                إضافة خدمة جديدة
            </button>
        </div>
    @endif

    <!-- نموذج الإضافة/التعديل -->
    @if ($showForm)
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- العمود الرئيسي -->
            <div class="lg:col-span-3 bg-white  shadow-sm p-6 border">
                <div class="flex justify-between items-start mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">
                        @if ($isEditing)
                            ✏️ تعديل الخدمة
                        @else
                            🚀 إضافة خدمة جديدة
                        @endif
                    </h2>
                    <button wire:click="resetForm" class="text-gray-400 hover:text-gray-600 text-2xl">
                        &times;
                    </button>
                </div>

                <form wire:submit.prevent="{{ $isEditing ? 'updateService' : 'createService' }}"
                    enctype="multipart/form-data" class="space-y-6">
                    <!-- العنوان -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">🏷 عنوان الخدمة</label>
                        <input type="text" wire:model.defer="title"
                            class="w-full px-4 py-3 border border-gray-300  focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="مثال: تصميم شعار احترافي ثلاثي الأبعاد">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- الوصف -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">📝 وصف الخدمة</label>
                        <textarea wire:model.defer="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300  focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="وصف تفاصيل الخدمة المقدمة..."></textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">⏳ وقت التسليم (بالأيام)</label>
                        <input type="number" wire:model.defer="delivery_time"
                               class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="مثال: 7 أيام">
                        @error('delivery_time')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                          clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <!-- التصنيفات مع Alpine.js -->
                    <div x-data="{
                        open: false,
                        search: '',
                        selected: @entangle('category_id'),
                        categories: @js(\App\Models\Category::all()),
                        get filteredCategories() {
                            return this.categories.filter(cat =>
                                cat.name.toLowerCase().includes(this.search.toLowerCase())
                            );
                        },
                        init() {
                            // التأكد من تحميل التصنيفات إذا كانت فارغة
                            if (this.categories.length === 0) {
                                this.categories = @js(\App\Models\Category::all());
                            }
                        }
                    }" class="relative mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">📂 التصنيف</label>

                        <!-- الزر الرئيسي -->
                        <button type="button" @click="open = !open"
                            class="w-full px-4 py-3 text-right bg-white border border-gray-300  flex justify-between items-center hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            <span x-text="selected ? categories.find(c => c.id == selected)?.name : 'اختر تصنيف الخدمة'"
                                :class="{ 'text-gray-400': !selected }" class="truncate pr-2"></span>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- القائمة المنسدلة -->
                        <div x-show="open" x-cloak x-transition.opacity @click.away="open = false"
                            class="absolute z-50 w-full mt-1 bg-white border border-gray-200  shadow-lg">
                            <div class="p-2 border-b">
                                <input type="text" x-model="search" @input.debounce.300ms=""
                                    placeholder="ابحث عن تصنيف..."
                                    class="w-full px-3 py-2 text-sm border-none focus:ring-0 ">
                            </div>
                            <ul class="max-h-60 overflow-y-auto">
                                <template x-for="cat in filteredCategories" :key="cat.id">
                                    <li @click="selected = cat.id; open = false"
                                        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center justify-between"
                                        :class="{ 'bg-blue-50': cat.id === selected }">
                                        <span x-text="cat.name" class="truncate"></span>
                                        <svg x-show="cat.id === selected" class="w-5 h-5 text-blue-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </li>
                                </template>

                                <template x-if="filteredCategories.length === 0">
                                    <li class="px-4 py-3 text-gray-500 text-center">لا توجد نتائج</li>
                                </template>
                            </ul>
                        </div>

                        <!-- عرض رسائل الخطأ -->
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- تحميل الصور -->
                    <!-- قسم تحميل الوسائط -->
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- مؤشر التحميل -->
                        <!-- مؤشر التحميل -->
                        <!-- Progress Bar -->
                    
                   
                        <!-- قسم تحميل الوسائط -->
                        <div @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                            @drop.prevent="isDragging = false; $wire.addMediaFiles(Array.from($event.dataTransfer.files))">
                            <label class="block text-sm font-medium text-gray-700 mb-2">📸 معرض الأعمال</label>
                            <div class="border-2 border-dashed border-gray-300 p-4 relative transition-colors"
                                :class="{ 'border-blue-500 bg-blue-50': isDragging }">
                                <input type="file" wire:model="mediaFiles" multiple accept="image/*,video/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    @change="if ($event.target.files.length) $wire.addMediaFiles(Array.from($event.target.files))">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        اسحب الملفات هنا أو انقر للاختيار
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">JPEG, PNG, MP4 (الحد الأقصى 5 ملفات، 5MB لكل
                                        ملف)</p>
                                        <div x-show="isUploading">
                                            <progress  max="100" x-bind:value="progress"></progress>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <!-- معاينة الوسائط -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                            @foreach ($mediaFiles as $index => $file)
                                <div class="relative group"
                                    wire:key="media-{{ $index }}-{{ $file->getFilename() }}">
                                    @if (str_starts_with($file->getMimeType(), 'video'))
                                        <video class="h-32 w-full object-cover border-2 border-gray-200 rounded-lg"
                                            controls>
                                            <source src="{{ $file->temporaryUrl() }}">
                                        </video>
                                    @else
                                        <img src="{{ $file->temporaryUrl() }}"
                                            class="h-32 w-full object-cover border-2 border-gray-200 rounded-lg">
                                    @endif
                                    <button type="button" wire:click="removeSelectedImage({{ $index }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- فيديو يوتيوب -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">🎥 فيديو توضيحي (اختياري)</label>
                        <input type="url" wire:model.defer="videoUrl"
                            class="w-full px-4 py-3 border border-gray-300  focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="https://youtu.be/...">
                        @error('videoUrl')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror

                        <!-- معاينة الفيديو -->
                        @if ($videoUrl)
                            <div class="mt-4 aspect-video bg-gray-100  overflow-hidden">
                                <iframe class="w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $this->getYoutubeId($videoUrl) }}"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        @endif
                    </div>

                    <!-- السعر والحالة -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">💵 السعر (دولار)</label>
                            <input type="number" step="0.01" wire:model.defer="price"
                                class="w-full px-4 py-3 border border-gray-300  focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">🔔 حالة الخدمة</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model.defer="status" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-blue-600 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                                </div>
                                <span class="mr-3 text-sm text-gray-600" x-text="status ? 'نشطة' : 'معلقة'"></span>
                            </label>
                        </div>
                    </div>

                    <!-- أزرار التحكم -->
                    <div class="border-t pt-6 flex justify-end gap-4">
                        <button type="button" wire:click="resetForm"
                            class="px-6 py-2.5 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700  transition-colors">
                            إلغاء
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white hover:bg-blue-700  transition-colors flex items-center">
                            @if ($isEditing)
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                حفظ التغييرات
                            @else
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                نشر الخدمة
                            @endif
                        </button>
                    </div>
                </form>
            </div>

            <!-- العمود الجانبي للنصائح -->
            <div class="lg:col-span-1">
                <div class="bg-blue-50 border-l-4 border-blue-400 p-6 ">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">💡 نصائح مهمة</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1 mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-blue-700">استخدم عناوين جذابة تعبر عن الخدمة بدقة</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1 mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-blue-700">اختر أفضل الصور لعرض جودة عملك</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1 mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span class="text-blue-700">استخدم فيديو يوتيوب لتوضيح تفاصيل الخدمة</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1 mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-blue-700">راجع البيانات قبل الحفظ للتأكد من صحتها</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- قائمة الخدمات -->
    @if (!$showForm)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
                <div class="bg-white border  shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <!-- رأس البطاقة -->
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-800 truncate">{{ $service->title }}</h3>
                            <span
                                class="px-3 py-1 text-sm rounded-full {{ $service->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $service->status ? 'نشطة' : 'معلقة' }}
                            </span>
                        </div>

                        @if($service->media->count() > 0)
                        <div x-data='@json(["media" => $service->media->map(function($media) {
                                    return [
                                        "url" => Storage::url($media->file_path)
                                    ];
                                })->toArray(), "active" => 0])' class="relative">
                            <!-- عرض الصورة النشطة في السلايدر -->
                            <template x-for="(item, index) in media" :key="index">
                                <div x-show="active === index" class="w-full h-64 flex items-center justify-center">
                                    <img :src="item.url" class="w-full h-full object-cover border-2 border-gray-200">
                                </div>
                            </template>
                            <!-- زر "السابق" -->
                            <button @click="active = active > 0 ? active - 1 : media.length - 1" 
                                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-2 rounded-none opacity-75 hover:opacity-100">
                                ‹
                            </button>
                            <!-- زر "التالي" -->
                            <button @click="active = active < media.length - 1 ? active + 1 : 0" 
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-2 rounded-none opacity-75 hover:opacity-100">
                                ›
                            </button>
                        </div>
                    @endif
                    

                        <!-- معلومات الخدمة -->
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm line-clamp-3">{{ $service->description }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="text-blue-600 font-bold">{{ number_format($service->price, 2) }}
                                    دولار</span>
                                <span class="mx-2">•</span>
                                <span>{{ $service->category->name ?? 'بدون تصنيف' }}</span>
                            </div>
                        </div>

                  <!-- أزرار التحكم -->
<div class="flex justify-end gap-2 mt-4">
    <!-- زر معاينة الخدمة -->
    <a href="{{ route('services.show', $service->id) }}" target="_blank"
       class="p-2 text-gray-400 hover:text-green-600 rounded-full hover:bg-gray-100 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <!-- أيقونة العين لعرض المعاينة -->
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
        </svg>
    </a>

    <!-- زر التعديل -->
    <button wire:click="editService({{ $service->id }})"
            class="p-2 text-gray-400 hover:text-blue-600 rounded-full hover:bg-gray-100 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
        </svg>
    </button>

    <!-- زر الحذف -->
    <button wire:click="deleteService({{ $service->id }})"
            class="p-2 text-gray-400 hover:text-red-600 rounded-full hover:bg-gray-100 transition-colors"
            onclick="return confirm('هل أنت متأكد من رغبتك في الحذف؟')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </button>
</div>

                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center border ">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-gray-500">لا توجد خدمات مضافة حالياً</p>
                </div>
            @endforelse
        </div>
    @endif
</div>

<script>
    function getYoutubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }
</script>
