<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $conversation;
    public $newMessage = '';
    public $messages;
    public $recipient;

    protected $listeners = ['messageReceived' => 'loadMessages'];

    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->recipient = $conversation->user_id == Auth::id()
            ? $conversation->provider
            : $conversation->user;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        $this->validate(['newMessage' => 'required|max:1000']);

        $message = $this->conversation->messages()->create([
            'sender_id' => Auth::id(),
            'content' => $this->newMessage
        ]);

        $this->newMessage = '';
        $this->loadMessages();
        $this->dispatchBrowserEvent('scroll-bottom');
        $this->emitSelf('messageReceived');
    }

    // في ChatComponent
    public function markAsRead()
    {
        $this->conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->update(['read' => true]);
    }

    public function getListeners()
    {
        return [
            "echo-private:conversation.{$this->conversation->id},MessageSent" => 'notifyNewMessage',
        ];
    }

    

    public function notifyNewMessage()
    {
        $this->emitSelf('messageReceived');
        $this->markAsRead();
    }

    public function render()
    {
        return view('livewire.chat-component')->layout('layouts.dashboard');
    }
}
