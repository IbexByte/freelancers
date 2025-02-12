<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesIndex extends Component
{

    public $category; // متغير لتخزين التصنيف المختار

    public function mount(Category $category) // استقبال التصنيف من المسار
    {
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.categories-index')->layout('layouts.user');
    }
}
