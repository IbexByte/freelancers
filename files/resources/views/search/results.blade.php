<x-guest-layout>
<div class="container">
    <h2 class="mb-4">نتائج البحث عن: "{{ $searchTerm }}"</h2>

    @if($services->count() > 0)
        <div class="mb-5">
            <h3 class="mb-3">الخدمات</h3>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{ $service->title }}</h5>
                                <p>{{ Str::limit($service->description, 100) }}</p>
                                <p>التصنيف: {{ $service->category->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($categories->count() > 0)
        <div class="mb-5">
            <h3 class="mb-3">التصنيفات</h3>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{ $category->name }}</h5>
                                <p>{{ Str::limit($category->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($services->count() == 0 && $categories->count() == 0)
        <div class="alert alert-info">
            لا توجد نتائج مطابقة للبحث.
        </div>
    @endif
</div>
</x-guest-layout>