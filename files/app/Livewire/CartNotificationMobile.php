<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart; // إذا كنت تستخدم هذه الحزمة

class CartNotificationMobile extends Component
{
    public $cartCount;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->cartCount = CartItem::count(); // أو طريقة أخرى لجلب عدد العناصر
    }

    public function updateCartCount()
    {
        $this->cartCount = CartItem::count();
        $this->dispatch('cartCountUpdated'); // إرسال حدث إذا لزم الأمر
    }

    public function render()
    {
        return view('livewire.cart-notification-mobile');
    }
}