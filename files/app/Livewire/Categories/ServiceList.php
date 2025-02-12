<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;

class ServiceList extends Component
{
    use WithPagination;
    
    public $category;
    public $search = '';
    public $sortBy = 'newest';
    public $priceRange = [0, 1000];
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
        'page' => ['except' => 1]
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $services = Service::query()
            ->where('category_id', $this->category->id)
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->sortBy === 'price_asc', fn($q) => $q->orderBy('price'))
            ->when($this->sortBy === 'price_desc', fn($q) => $q->orderByDesc('price'))
            // ->when($this->sortBy === 'popular', fn($q) => $q->orderByDesc('orders_count'))
            ->whereBetween('price', $this->priceRange)
            ->with('user')
            ->paginate($this->perPage);
    
        return view('livewire.categories.service-list', [
            'services' => $services
        ]);
    }
}