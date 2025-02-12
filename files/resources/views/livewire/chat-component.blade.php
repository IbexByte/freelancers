{{-- resources/views/livewire/chat-component.blade.php --}}
<div class="flex flex-col h-screen bg-gray-100 md:rounded-lg md:shadow-lg md:max-h-[90vh]">
    <!-- Header -->
    <div class="bg-blue-600 text-white p-4 md:rounded-t-lg flex items-center justify-between gap-3">
        <div class="flex items-center gap-3 min-w-0">
            <img src="{{ $recipient->profile_photo_url }}" 
                 class="w-10 h-10 rounded-full border-2 border-white shrink-0">
            <div class="min-w-0">
                <h3 class="font-bold truncate">{{ $recipient->name }}</h3>
                <p class="text-sm opacity-90 truncate">
                    {{ $recipient->id == $conversation->provider_id ? 'مقدم الخدمة' : 'العميل' }}
                </p>
            </div>
        </div>
        <button wire:click="$emit('closeChat')" 
                class="p-2 hover:bg-blue-700 rounded-full transition-transform transform hover:scale-110">
            ✕
        </button>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
         x-data="{ scrollToBottom() { $el.scrollTop = $el.scrollHeight } }"
         x-init="scrollToBottom()"
         x-on:message-sent.window="scrollToBottom()"
         wire:ignore.self>
        
        @foreach($messages as $message)
            <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[85%] md:max-w-[65%] p-3 rounded-xl
                    {{ $message->sender_id == Auth::id() 
                        ? 'bg-blue-600 text-white ml-4' 
                        : 'bg-white shadow-sm mr-4' }}"
                     x-data="{ showTime: false }"
                     @mouseenter="showTime = true"
                     @mouseleave="showTime = false">
                    <p class="break-words">{{ $message->content }}</p>
                    <div class="flex items-center justify-end gap-2 mt-2 text-xs 
                              {{ $message->sender_id == Auth::id() ? 'text-blue-100' : 'text-gray-500' }}">
                        <span x-show="showTime" class="transition-opacity">
                            {{ $message->created_at->format('h:i A') }}
                        </span>
                        @if($message->sender_id == Auth::id())
                            <span class="{{ $message->read ? 'text-green-300' : 'text-gray-300' }}">
                                ✓
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input Area -->
    <div class="border-t bg-white p-4">
        <div class="flex gap-2">
            <input 
                wire:model.defer="newMessage"
                wire:keydown.enter.prevent="sendMessage"
                type="text" 
                class="flex-1 p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       placeholder-gray-400 text-sm"
                placeholder="اكتب رسالتك هنا..."
                autocomplete="off"
            >
            <button 
                wire:click="sendMessage"
                wire:loading.attr="disabled"
                class="bg-blue-600 text-white px-5 py-3 rounded-xl hover:bg-blue-700 transition 
                       flex items-center justify-center w-20"
            >
                <span wire:loading.remove>إرسال</span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </div>
        
        <p class="text-xs text-gray-500 mt-2 text-center md:text-right">
            جميع الرسائل مسجلة ومراقبة وفق
            <a href="#" class="text-blue-600 hover:underline">شروط الاستخدام</a>
        </p>
    </div>
</div>