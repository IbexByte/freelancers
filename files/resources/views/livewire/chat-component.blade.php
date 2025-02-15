<div class=" bg-[#eee] ">

    <!-- نستخدم حاوية عامة لسهولة التحكم بالتجاوب والمسافات -->
    <div class="container mx-auto px-2 py-4 sm:px-6 sm:py-6 md:px-8 md:py-8 bg-[#eee]">

        @if (!$conversation)
            <!-- =================== قائمة المحادثات =================== -->
            <div class="max-w-2xl w-full mx-auto">
                <!-- الهيدر -->
                <div class="flex items-center justify-between my-6">
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-800">الدردشات</h1>
                    <div class="flex items-center gap-3">
                        <button type="button"
                            class="p-2 hover:bg-gray-200 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01
                                       M12 6a1 1 0 110-2 1 1 0 010 2zm0 7
                                       a1 1 0 110-2 1 1 0 010 2zm0 7
                                       a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- قائمة المحادثات -->
                <div class="bg-white rounded-2xl shadow-sm divide-y divide-gray-100">
                    @forelse($conversations as $conv)
                        @php
                            $participant = $conv->user_id == Auth::id() ? $conv->provider : $conv->user;
                        @endphp
                        <div wire:click="selectConversation({{ $conv->id }})"
                            class="p-3 flex items-center gap-3 hover:bg-gray-50 cursor-pointer transition-colors group">
                            <div class="relative">
                                <img src="{{ $participant->profile_photo_url ?? asset('default-avatar.png') }}"
                                    alt="صورة المستخدم"
                                    class="w-12 h-12 rounded-xl object-cover border-2 border-white shadow">
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white">
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                        {{ $participant->name ?? 'مستخدم مجهول' }}
                                    </h3>
                                    <span class="text-xs text-gray-400">
                                        {{ optional(optional($conv->messages->last())->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ optional($conv->messages->last())->content ?? 'ابدأ المحادثة...' }}
                                    </p>
                                    @if ($conv->unread_count)
                                        <span
                                            class="bg-red-500 text-white px-2 py-0.5 rounded-full text-xs font-medium shadow">
                                            {{ $conv->unread_count }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            لا توجد محادثات حالياً
                        </div>
                    @endforelse
                </div>
            </div>
        @else
            <!-- =================== واجهة الدردشة =================== -->
            <!-- نستخدم flex-1 هنا كي يتمدد المحتوى على كامل الصفحة عموديًا -->
            <div class="relative flex flex-col bg-[#eee] no-scrollbar">
             
                <!-- الهيدر -->
                <div
                    class="md:top-0  top-0 left-0 right-0 bg-white p-4 border-b flex items-center gap-3 fixed 
                        md:rounded-md shadow-sm z-50">
                    <!-- زر الرجوع -->
                    <button wire:click="backToList" type="button"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- صورة الطرف الآخر -->
                    <img src="{{ $recipient->profile_photo_url }}" alt="صورة المرسل إليه"
                        class="w-10 h-10 rounded-xl object-cover shadow border-2 border-white">

                    <!-- معلومات الطرف الآخر -->
                    <div class="flex-1">
                        <h2 class="font-semibold text-gray-800 text-sm sm:text-base md:text-lg">
                            {{ $recipient->name }}
                        </h2>
                        <p class="text-xs sm:text-sm text-green-500 flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            متصل الآن
                        </p>
                    </div>

                    <!-- زر الإغلاق -->
                    <button wire:click="closeChat" type="button"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- الرسائل -->
                <div class="flex-1 bg-[#eee]  
                        no-scrollbar w-full overflow-y-auto 
                        pb-32 pt-40 px-0 space-y-3 scroll-smooth"
                    x-data="{ scrollToBottom() { this.$el.scrollTop = this.$el.scrollHeight } }" x-init="scrollToBottom()" x-on:messageReceived.window="scrollToBottom()">

                    @foreach ($messages as $message)
                        <div
                            class="flex items-end gap-x-2 {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            @if ($message->sender_id != Auth::id())
                                <img src="{{ $recipient->profile_photo_url }}" alt="صورة المرسل"
                                    class="w-10 h-10 rounded-full object-cover shadow border-2 border-white">
                            @endif

                            <div
                                class="max-w-[85%] px-4 py-2 rounded-3xl {{ $message->sender_id == Auth::id()
                                    ? 'bg-blue-600 text-white rounded-bl-none'
                                    : 'bg-white shadow border border-gray-100 rounded-br-none' }}">
                                <p class="text-sm md:text-base leading-relaxed break-words">
                                    {{ $message->content }}
                                </p>

                                <!-- التعديل على وقت الإرسال -->
                                <div
                                    class="flex items-center gap-1 mt-1 {{ $message->sender_id == Auth::id() ? 'text-blue-100' : 'text-gray-600' }}">

                                    <!-- أيقونة الساعة الصغيرة -->
                                    <svg class="w-3 h-3 opacity-80" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <!-- نص الوقت -->
                                    <span class="text-[10px] opacity-80 hover:opacity-100 transition-opacity">
                                        {{ $message->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- حقل الإدخال -->
                <div class="bg-white p-4 border-t shadow-[0_-8px_30px_-10px_rgba(0,0,0,0.1)] fixed bottom-0 left-0 right-0 z-50">
                    <form wire:submit.prevent="sendMessage" 
                          class="flex gap-2 items-end max-w-2xl mx-auto w-full"
                          x-data="{
                              resetInput() {
                                  this.$nextTick(() => {
                                      const textarea = this.$refs.messageInput;
                                      textarea.style.height = '48px';
                                      textarea.dispatchEvent(new Event('input'));
                                  });
                              }
                          }"
                          @message-sent.window="resetInput">
                        
                        <!-- أزرار المرفقات والتسجيل -->
                        <div class="flex items-center gap-1 mb-2">
                            <button type="button" class="p-2 text-gray-500 hover:text-blue-600 transition-transform transform hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <button type="button" class="p-2 text-gray-500 hover:text-red-600 transition-transform transform hover:scale-110">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z" />
                                    <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z" />
                                </svg>
                            </button>
                        </div>
                
                        <!-- حقل الإدخال -->
                        <div class="flex-1 relative group">
                            <textarea 
                           
                                x-ref="messageInput"
                                wire:model.debounce.300ms="newMessage"
                                placeholder="اكتب رسالتك..."
                                x-data="{
                                    baseHeight: 48,
                                    maxHeight: 96,
                                    resize() {
                                        this.$el.style.height = `${this.baseHeight}px`;
                                        this.$el.style.height = `${Math.min(this.$el.scrollHeight, this.maxHeight)}px`;
                                    }
                                }"
                                x-init="resize()"
                                x-on:input="resize()"
                                class="w-full px-4 py-2.5  no-scrollbar  bg-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 
                                       text-base resize-none overflow-y-auto  h-5 no-scrollbar
                                       transition-all duration-200 ease-in-out hover:bg-gray-50 focus:bg-white"
                                style="min-height: 48px; max-height: 96px"
                                @keydown.enter.prevent="if (!event.shiftKey) $wire.sendMessage()"
                            ></textarea>
                            
                            <!-- توجيهات الكتابة -->
                            <div class="absolute -top-6 right-2 bg-white px-2 py-1 rounded-lg shadow-sm text-xs text-gray-500 
                                        opacity-0 group-focus-within:opacity-100 transition-opacity">
                                Shift + Enter ↵ للسطر الجديد
                            </div>
                        </div>
                
                        <!-- زر الإرسال -->
                        <button type="submit" 
                                class="mb-2 p-3 bg-blue-600 text-white rounded-full 
                                       hover:bg-blue-700 transition-all duration-200 shadow-lg
                                       transform hover:scale-110 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                
                    <!-- منطقة المرفقات -->
                    <div class="max-w-2xl mx-auto mt-2 hidden">
                        <div class="flex gap-2 animate-fade-in">
                            <div class="px-3 py-1.5 bg-white border rounded-full shadow-sm text-sm text-gray-600 
                                        flex items-center gap-2 hover:bg-gray-50 transition-colors">
                                <span>مرفق 1</span>
                                <button class="text-gray-400 hover:text-red-500 transition-colors">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .scroll-smooth {
                    scroll-behavior: smooth;
                }

                .hide-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }

                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }
            </style>

        @endif
    </div>
</div>
