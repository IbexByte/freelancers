<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class IncomingOrdersNotification extends Component
{

    public $incomingCount = 0;

    public function mount()
    {
        $this->updateIncomingCount();
    }

    public function updateIncomingCount()
    {
        // نفترض أن الطلبات الواردة هي تلك التي يكون حالتها "pending_approval"
        $this->incomingCount =  Order::where('provider_id', auth()->id())
            ->where('status', 'pending_approval')
            ->count();
    }

 

    public function render()
    {
        return view('livewire.incoming-orders-notification');
    }
}
