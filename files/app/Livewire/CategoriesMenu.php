<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesMenu extends Component
{
    public $categories;

    public function mount()
    {
        // جلب جميع التصنيفات المفعلة
        $this->categories = Category::where('status', true)->get();
    }

    public function render()
    {
        return view('livewire.categories-menu');
    }
}