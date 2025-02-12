<div class="w-64 bg-white shadow-lg p-4 h-screen overflow-y-auto">
    <h2 class="text-xl font-bold mb-4">التصنيفات الأخرى</h2>
    
    @foreach($categories as $category)
    <div class="mb-4" x-data="{ open: false }">
        <div class="flex items-center justify-between p-2 hover:bg-gray-50 cursor-pointer"
             @click="open = !open">
            <span class="font-medium">{{ $category->name }}</span>
            <svg class="w-4 h-4 transform transition-transform" 
                 :class="{ 'rotate-180': open }" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        
        <div x-show="open" class="ml-4 border-l-2 border-gray-200 pl-3">
            @foreach($category->services as $service)
            <a href="{{ route('services.show', $service) }}" 
               class="block p-2 text-sm hover:bg-blue-50">
                {{ $service->title }}
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>