<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public $category; // متغير لتخزين التصنيف المختار

    public function mount(Category $category) // استقبال التصنيف من المسار
    {
        $this->category = $category;
    }

    public function updatedSearch()
    {
        $this->emit('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.categories.search');
    }
}