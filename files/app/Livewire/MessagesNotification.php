<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessagesNotification extends Component
{
    public $unreadMessages;  // قائمة المحادثات
 
    public function mount()
    {
        // تحميل قائمة المحادثات
        $this->getUnreadMessaes();
       

    }

        /**
     * تحميل محادثات المستخدم
     */
    public function getUnreadMessaes()
    {
       $this->unreadMessages = Conversation::where(function($query){
        $query->where('user_id', Auth::id())
        ->orWhere('provider_id', Auth::id());


       })
       ->whereHas('messages', function($q){
        $q->where('sender_id' , '!=' , Auth::id())
        ->where('read', false);
       })->count();
      
        }

    public function render()
    {
        return view('livewire.messages-notification');
    }
}
