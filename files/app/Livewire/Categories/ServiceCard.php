<?php

namespace App\Livewire\Categories;

use App\Models\Service;
use Livewire\Component;

class ServiceCard extends Component
{

    public $service;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.categories.service-card');
    }
}
