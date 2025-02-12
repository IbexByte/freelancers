<?php

namespace App\Livewire\Categories;

use App\Models\Service;
use Livewire\Component;

class FeaturedServices extends Component
{

    public $services;

    public function mount()
    {
        $this->services = Service::where('is_featured', true)
            ->orderBy('rating', 'desc')
            ->limit(5)
            ->get();
    }
    public function render()
    {
        return view('livewire.categories.featured-services');
    }
}
