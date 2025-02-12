<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class Sidebar extends Component
{
    public $categories;
    public $currentCategory;
    public $activeCategory = null;

    public function mount($currentCategory)
    {
        $this->currentCategory = $currentCategory;
        $this->categories = Category::with('services')
            ->where('status', true)
            ->where('id', '!=', $this->currentCategory->id)
            ->get();
    }

    public function toggleCategory($categoryId)
    {
        $this->activeCategory = $this->activeCategory === $categoryId ? null : $categoryId;
    }

    public function render()
    {
        return view('livewire.categories.sidebar');
    }
}
