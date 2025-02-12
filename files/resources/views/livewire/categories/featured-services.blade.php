<div class="mb-8">
    <h2 class="text-xl font-bold mb-4">الخدمات المميزة</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($services as $service)
        <livewire:service-card :service="$service" :key="$service->id" />
        @endforeach
    </div>
</div>