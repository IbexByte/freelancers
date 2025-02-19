<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderDetails extends Component
{
    public $order;
    public $selectedStatus;
    public $showConfirmation = false;
     public $allowedNextStatus = null;

    protected $listeners = ['statusUpdated' => 'refreshOrder'];

    public function mount($orderId)
    {
        $this->order = Order::with(['user', 'service'])
            ->withTrashed()
            ->findOrFail($orderId);
        $this->selectedStatus = $this->order->status;
        $this->allowedNextStatus = $this->getNextStatus();

    }


    private function getNextStatus()
    {
        $statusFlow = [
            'pending_approval' => 'approved',
            'approved' => 'in_progress',
            'in_progress' => 'delivered',
            'delivered' => 'completed',
            'cancelled' => null, // لا توجد حالة بعد الإلغاء
        ];

        return $statusFlow[$this->order->status] ?? null;
    }

    public function confirmStatusChange()
    {
        if($this->allowedNextStatus) {
            $this->selectedStatus = $this->allowedNextStatus;
            $this->showConfirmation = true;
        }
    }

    public function updateStatus()
    {
        $this->order->update(['status' => $this->selectedStatus]);
        $this->showConfirmation = false;
        $this->dispatch('notify', 
            type: 'success',
            message: 'تم تحديث حالة الطلب بنجاح',
            timeout: 3000
        );
        $this->refreshOrder();
    }

    public function refreshOrder()
    {
        $this->order = $this->order->fresh();
        $this->allowedNextStatus = $this->getNextStatus(); // أضف هذا السطر
    }

    public function render()
    {
        return view('livewire.order-details')->layout('layouts.user', [
            'title' => 'تفاصيل الطلب #' . $this->order->id
        ]);
    }
}