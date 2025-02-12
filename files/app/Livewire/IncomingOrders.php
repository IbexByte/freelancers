<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class IncomingOrders extends Component
{
    public $orders;

    // نستقبل حدث "orderUpdated" لتحديث القائمة عند حدوث تغييرات
    protected $listeners = ['orderUpdated' => 'loadOrders'];

    public function mount()
    {
        $this->loadOrders();
    }

    // تحميل الطلبات الواردة للبائع الحالي
    public function loadOrders()
    {
        $this->orders = Order::with(['service', 'provider'])
            ->where('provider_id', Auth::id())
            ->orderBy('requested_at', 'desc')
            ->get();
    }

    // مثال إجراء: الموافقة على الطلب
    public function approveOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->provider_id == Auth::id()) {
            $order->status = 'approved'; // يمكنك تغيير الحالة إلى in_progress حسب متطلبات سير العمل
            $order->approved_at = now();
            $order->save();

            session()->flash('success', 'تمت الموافقة على الطلب بنجاح.');
            $this->loadOrders();
            $this->dispatch('orderUpdated');
        }
    }

    // مثال إجراء: تأكيد التسليم
    public function deliverOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->provider_id == Auth::id()) {
            $order->status = 'delivered';
            $order->delivered_at = now();
            $order->save();

            session()->flash('success', 'تم تأكيد التسليم بنجاح.');
            $this->loadOrders();
            $this->dispatch('orderUpdated');
        }
    }

    public function render()
    {
        return view('livewire.incoming-orders')->layout('layouts.user');
    }
}
