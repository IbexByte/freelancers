<div class="" x-data="{ open: false }" @mouseleave="open = false">
    <!-- زر القائمة الرئيسي -->
    <button @mouseover="open = true" class="hover:text-blue-600">
       📂 التصنيفات
        
    </button>



    <!-- القائمة المنبثقة -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute z-50 w-screen max-w-6xl bg-white shadow-xl rounded-lg p-6 grid grid-cols-4 gap-6 left-1/2   -translate-x-1/2">

        @foreach ($categories as $category)
            <div class="space-y-4" wire:key="category-{{ $category->id }}">

                <!-- التصنيف الرئيسي -->
                <div class="flex items-center space-x-2">
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="w-8 h-8 object-cover rounded-full">
                    @endif
                    <a href="{{ route('category.show', $category->id) }}"
                        class="font-medium text-gray-900 hover:text-blue-600">
                        {{ $category->name }}
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>
