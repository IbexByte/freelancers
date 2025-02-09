<div class="p-6 bg-white border-b border-gray-200 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold mb-4">إضافة تصنيف جديد</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">اسم التصنيف</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">الوصف</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">صورة التصنيف</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            حفظ التصنيف
        </button>
    </form>
</div>
