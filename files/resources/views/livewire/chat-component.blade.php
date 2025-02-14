<div class="min-h-screen bg-gray-100">
    <!-- نستخدم حاوية عامة لسهولة التحكم بالتجاوب والمسافات -->
    <div class="container mx-auto px-4 py-4 sm:px-6 sm:py-6 md:px-8 md:py-8">

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
            <div class="  flex flex-col h-screen  ">

                <!-- الهيدر -->
                <div class= " fixed md:top-10 top-0 left-0 right-0 bg-white p-4 border-b flex items-center gap-3  ">
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
                <div class="flex-1 mb-16 md:mb-0 overflow-y-auto p-4 space-y-3 bg-[#f2f2f2]" x-data="{ scrollToBottom() { $el.scrollTop = $el.scrollHeight } }"
                    x-init="scrollToBottom()" x-on:messageReceived.window="scrollToBottom()">
                    @foreach ($messages as $message)
                        <div class="flex items-end gap-x-2 {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            @if ($message->sender_id == Auth::id())
                                  
                            @else
                            <img src="{{ $recipient->profile_photo_url }}" alt="صورة المرسل إليه"
                            class="w-14 h-14 rounded-full object-cover shadow border-2 border-white">
                            @endif
                            <div
                                class="max-w-[80%] px-4 py-2 rounded-tl-3xl  rounded-tr-3xl
                            {{ $message->sender_id == Auth::id()
                                ? 'bg-blue-600 text-white rounded-br-3xl'
                                : 'bg-white shadow border border-gray-100 rounded-bl-3xl' }}">
                              
                                <p class="text-sm md:text-base leading-relaxed break-words whitespace-normal">
                                    {{ $message->content }}
                                </p>
                                <div
                                    class="text-xs mt-1 
                                {{ $message->sender_id == Auth::id() ? 'text-blue-100' : 'text-gray-500' }}">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- حقل الإدخال -->
                <div class="bg-white p-4 fixed bottom-16 md:bottom-0 left-0 right-0 border-t shadow-[0_-2px_10px_-5px_rgba(0,0,0,0.05)]">
                    <form wire:submit.prevent="sendMessage" class="flex gap-2 items-center max-w-2xl mx-auto w-full">
                        <input type="text" wire:model="newMessage" placeholder="اكتب رسالتك..."
                            class="flex-1 px-4 py-2 bg-gray-100 rounded-full focus:outline-none 
                                   focus:ring-2 focus:ring-blue-500 transition-all
                                   text-sm sm:text-base">
                        <button type="submit"
                            class="p-3 bg-blue-600 text-white rounded-full 
                                   hover:bg-blue-700 transition-colors shadow-md
                                   flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
