<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Conversation;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection; // أضف هذا الاستيراد

class Cart extends Component
{
    /**
     * عناصر السلة.
     *
     * @var Collection<int, CartItem>
     */
    public $cartItems;

    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function proceedToManualPayment()
    {
        try {
            // التحقق من وجود عناصر في السلة
            if ($this->cartItems->isEmpty()) {
                $this->dispatchBrowserEvent('error', [
                    'message' => 'السلة فارغة. أضف خدمات قبل المتابعة.'
                ]);
                return;
            }

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => auth()->id(),
                'service_id' => $this->cartItems->first()->service_id,
                'provider_id' => $this->cartItems->first()->service->user_id,
                'status' => 'pending_approval'
            ]);

            // إنشاء المحادثة
            $conversation = Conversation::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'provider_id' => $order->provider_id
            ]);

            // إفراغ السلة بعد إنشاء الطلب
            $this->clearCart();

            // توجيه إلى صفحة المحادثة
            return redirect()->route('chat', $conversation);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', [
                'message' => 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage()
            ]);
        }
    }

    // تحميل عناصر السلة للمستخدم الحالي
    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = CartItem::with('service')
                ->where('user_id', Auth::id())
                ->get();
            $this->calculateTotal();
        }
    }

    // حساب المجموع الكلي للسلة
    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cartItems as $item) {
            $this->total += $item->service->price * $item->quantity;
        }
    }

    // إضافة خدمة إلى السلة
    public function addToCart($serviceId)
    {
        if (!Auth::check()) {
            // إذا لم يكن المستخدم مسجلاً، يمكنك إعادة التوجيه إلى صفحة الدخول
            return redirect()->route('login');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('service_id', $serviceId)
            ->first();

        if ($cartItem) {
            // زيادة الكمية إذا كانت الخدمة موجودة بالسلة
            $cartItem->update(['quantity' => $cartItem->quantity + 1]);
        } else {
            // إنشاء سجل جديد للسلة
            CartItem::create([
                'user_id'    => Auth::id(),
                'service_id' => $serviceId,
                'quantity'   => 1,
            ]);
        }

        $this->loadCart();
    }

    // حذف عنصر من السلة
    public function removeFromCart($itemId)
    {
        CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadCart();
    }

    // إفراغ السلة
    public function clearCart()
    {
        CartItem::where('user_id', Auth::id())->delete();
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.dashboard');
    }
}