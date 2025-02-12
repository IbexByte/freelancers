<div class="bg-white shadow-lg rounded-lg p-4">
    <img src="{{ asset('storage/' .  ) }}" alt="{{ $service->title }}" class="w-full h-48 object-cover rounded-lg">
    <h3 class="text-lg font-bold mt-4">{{ $service->title }}</h3>
    <p class="text-gray-600">{{ $service->description }}</p>
    <div class="flex justify-between items-center mt-4">
        <span class="text-blue-600 font-bold">{{ $service->price }} دولار</span>
        <span class="text-yellow-500">⭐ {{ $service->rating }}</span>
    </div>
</div>