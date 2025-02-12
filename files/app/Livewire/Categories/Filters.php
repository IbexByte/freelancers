<?php

namespace App\Livewire\Categories;

use Livewire\Component;

class Filters extends Component
{
    public $sortBy = 'newest';
    public $priceRange = [0, 1000];

    public function updated()
    {
        $this->emit('filtersUpdated', [
            'sortBy' => $this->sortBy,
            'priceRange' => $this->priceRange
        ]);
    }

    public function render()
    {
        return view('livewire.categories.filters');
    }
}