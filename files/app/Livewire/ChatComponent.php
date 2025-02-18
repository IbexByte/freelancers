<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ChatComponent extends Component
{
    use WithFileUploads;
    public $conversations;  // قائمة المحادثات
    public $conversation;   // المحادثة المحددة
    public $messages = [];  // رسائل المحادثة المحددة
    public $attachments = [];
    public $recipient;      // الطرف الآخر
    public $newMessage = '';

    protected $listeners = [
        'messageReceived' => 'loadMessages',
    ];

    protected $rules = [
        'newMessage' => 'required|max:1000',
    ];

    public function mount()
    {
        // تحميل قائمة المحادثات
        $this->loadConversations();


    }

    /**
     * تحميل محادثات المستخدم
     */
    public function loadConversations()
    {
        $this->conversations = Conversation::where('user_id', Auth::id())
            ->orWhere('provider_id', Auth::id())
            ->with(['messages' => fn($q) => $q->latest()])
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($conv) {
                // حساب الرسائل غير المقروءة
                $conv->unread_count = $conv->messages()
                    ->where('sender_id', '!=', Auth::id())
                    ->where('read', false)
                    ->count();
                return $conv;
            });
    }

    /**
     * اختيار محادثة
     */
    public function selectConversation($conversationId)
    {
        $this->conversation = Conversation::findOrFail($conversationId);
        $this->setupConversation();
    }

    /**
     * تجهيز بيانات المحادثة الحالية
     */
    private function setupConversation()
    {
        $this->recipient = $this->conversation->user_id == Auth::id()
            ? $this->conversation->provider
            : $this->conversation->user;

        $this->loadMessages();
        $this->markAsRead();
    }

    /**
     * تحميل الرسائل
     */
    public function loadMessages()
    {
        if (!$this->conversation) {
            $this->messages = [];
            return;
        }

        $this->messages = $this->conversation->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * إرسال رسالة جديدة
     */
    public function sendMessage()
    {
 
        if (!$this->conversation) return;

        $message =   $this->conversation->messages()->create([
            'sender_id' => Auth::id(),
            'content'   => $this->newMessage
        ]);

        foreach ($this->attachments as $attachment) {
            $path = $attachment->store('attachments', 'public');
            
            $message->attachments()->create([
                'file_path' => $path,
                'file_name' => $attachment->getClientOriginalName(),
                'type' => str_starts_with($attachment->getMimeType(), 'image/') ? 'image' : 'file'
            ]);
        }

        $this->reset(['newMessage', 'attachments']);

        $this->loadMessages();
        $this->dispatch('messageReceived'); // للتمرير لأسفل
    }

    /**
     * تعليم الرسائل كمقروءة
     */
    public function markAsRead()
    {
        if (!$this->conversation) return;

        $this->conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('read', false)
            ->update(['read' => true]);
    }

    /**
     * زر الرجوع إلى القائمة
     */
    public function backToList()
    {
        $this->conversation = null;
        $this->messages = [];
        $this->recipient = null;
        $this->newMessage = '';
    }

    /**
     * زر الإغلاق (مثلاً للعودة للصفحة الرئيسية)
     */
    public function closeChat()
    {
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.chat-component')->layout('layouts.chat');
    }
}
