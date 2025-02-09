<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('edit_category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">تعديل التصنيف</h3>

                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- اسم التصنيف -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">اسم التصنيف</label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full p-2 border rounded" required>
                    </div>

                    <!-- وصف التصنيف -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">الوصف</label>
                        <textarea name="description" id="description" class="w-full p-2 border rounded">{{ $category->description }}</textarea>
                    </div>

                    <!-- تحميل صورة التصنيف -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700">صورة التصنيف</label>
                        <input type="file" name="image" id="image" class="w-full p-2 border rounded" onchange="previewImage(event)">
                        <div class="mt-2">
                            <img id="preview" src="{{ $category->image_url }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                        </div>
                    </div>

                    <!-- زر التبديل (Toggle Switch) للحالة -->
                    <div class="mb-4 flex items-center">
                        <span class="text-gray-700 mr-3">الحالة:</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $category->status ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                        <span class="ml-2 text-sm text-gray-700">{{ $category->status ? 'مفعّل' : 'غير مفعّل' }}</span>
                    </div>

                    <!-- زر الحفظ -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">حفظ التعديلات</button>
                        <a href="{{ route('categories.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
