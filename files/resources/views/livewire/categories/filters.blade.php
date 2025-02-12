<div class="bg-white p-4 rounded-lg shadow-sm mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-2">ترتيب حسب:</label>
            <select wire:model="sortBy" class="w-full px-3 py-2 border rounded-lg">
                <option value="newest">الأحدث أولاً</option>
                <option value="price_asc">السعر من الأقل للأعلى</option>
                <option value="price_desc">السعر من الأعلى للأقل</option>
                <option value="popular">الأكثر طلباً</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">نطاق السعر:</label>
            <div class="flex items-center space-x-2">
                <input type="number" 
                       wire:model="priceRange.0" 
                       class="w-1/2 px-3 py-2 border rounded-lg">
                <span class="text-gray-500">إلى</span>
                <input type="number" 
                       wire:model="priceRange.1" 
                       class="w-1/2 px-3 py-2 border rounded-lg">
            </div>
        </div>
    </div>
</div>