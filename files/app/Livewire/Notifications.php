<?php

 namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $message;
    public $type;
    public $show = false;

    protected $listeners = ['notify' => 'showNotification'];

    public function showNotification($type, $message, $timeout = 3000)
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;
        
        $this->dispatch('reset-notification', timeout: $timeout);
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
