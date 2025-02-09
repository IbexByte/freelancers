<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">جميع التصنيفات</h3>
                    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + إضافة تصنيف جديد
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($categories as $category)
                   
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $category->getImageUrlAttribute() }}" alt="{{ $category->name }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($category->description, 60) }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        {{ $category->status ? '🟢 مفعّل' : '🔴 غير مفعّل' }}
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700">
                                            ✏️ تعديل
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('هل أنت متأكد؟')">
                                                🗑 حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
