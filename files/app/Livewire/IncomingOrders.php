<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class IncomingOrders extends Component
{
    public $orders;
    public $selectedStatus = null;
    
    protected $listeners = ['orderUpdated' => 'loadOrders'];

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $query = Order::with(['service', 'user'])
            ->where('provider_id', Auth::id());

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        $this->orders = $query->orderBy('requested_at', 'desc')->get();
    }

    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->loadOrders();
    }

    public function getStatusCountsProperty()
    {
        return Order::where('provider_id', Auth::id())
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function getStatusKeysProperty()
    {
        return [
            'pending_approval',
            'approved',
            'in_progress',
            'delivered',
            'completed',
            'cancelled',
        ];
    }

    public function render()
    {
        return view('livewire.incoming-orders')->layout('layouts.user');
    }
}