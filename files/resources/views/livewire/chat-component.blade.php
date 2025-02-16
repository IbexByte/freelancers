<div class=" bg-[#eee] ">

    <!-- نستخدم حاوية عامة لسهولة التحكم بالتجاوب والمسافات -->
    <div class="container mx-auto px-2   sm:px-6   md:px-8   bg-[#eee]">

        @if (!$conversation)
            <div class="max-w-2xl w-full mt-36 mx-auto">
                <!-- الهيدر -->
                <div class="flex items-center justify-between my-6">
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-800">الدردشات</h1>
                    <div class="flex items-center gap-3">
                        <!-- زر الذهاب إلى الصفحة الرئيسية -->
                        <a href="/"
                            class="p-2 hover:bg-gray-200 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 active:bg-transparent">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h4m10-11v10a1 1 0 01-1 1h-4m-6 0h6" />
                            </svg>
                        </a>
                        <!-- زر الإعدادات أو القائمة -->
                        <button type="button"
                            class="p-2 hover:bg-gray-200 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 active:bg-transparent">
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
                            class="p-3 flex items-center gap-3 hover:bg-gray-50 cursor-pointer transition-all group focus:outline-none active:bg-transparent">
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
                                    <h3 class="font-semibold text-gray-800   transition-colors">
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
                <header class="sticky top-0 z-50 bg-white border-b shadow-sm">
                    <div class="flex items-center gap-3 p-4 max-w-7xl mx-auto">
                        <!-- زر الرجوع -->
                        <button wire:click="backToList" type="button"
                            class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
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
                </header>

                <!-- الرسائل -->
                <!-- منطقة الرسائل (مساحة مرنة مع تمرير ذكي) -->
                <main class="overflow-y-auto scroll-smooth space-y-4 px-4 py-6" x-data="{
                    scrollToBottom() {
                            this.$nextTick(() => {
                                this.$el.scrollTop = this.$el.scrollHeight;
                            });
                        },
                        handleScroll() {
                            // إضافة تحميل الرسائل القديمة عند التمرير لأعلى
                            if (this.$el.scrollTop < 100) {
                                $wire.loadMore();
                            }
                        }
                }"
                    x-init="scrollToBottom()" x-on:messageReceived.window="scrollToBottom()"
                    @scroll.debounce.100="handleScroll">

                    <!-- التاريخ والرسائل -->
                    <div class="max-w-3xl mx-auto w-full space-y-4">
                        @php
                            $lastDate = null;
                        @endphp
                        @foreach ($messages as $message)
                            @php
                                $currentDate = $message->created_at->format('Y-m-d');
                            @endphp
                            @if ($currentDate != $lastDate)
                                <!-- تاريخ اليوم -->
                                <div class="flex justify-center my-4">
                                    <span class="px-3 py-1 text-xs text-gray-600 bg-gray-100 rounded-full">
                                        @if ($message->created_at->isToday())
                                            اليوم
                                        @elseif ($message->created_at->isYesterday())
                                            أمس
                                        @else
                                            {{ $message->created_at->translatedFormat('j F Y') }}
                                        @endif
                                    </span>
                                </div>
                                @php $lastDate = $currentDate @endphp
                            @endif

                            <!-- الرسالة -->
                            <div
                                class="flex gap-2 {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[70%] relative">
                                    <!-- فقاعة الرسالة -->
                                    {{-- @if ($message->sender_id != Auth::id())
                                <img src="{{ $recipient->profile_photo_url }}" alt="صورة المرسل"
                                    class="w-10 h-10 rounded-full object-cover shadow border-2 border-white">
                            @endif --}}
                                    <div
                                        class="{{ $message->sender_id == Auth::id()
                                            ? 'bg-[#d9fdd3] rounded-s-xl rounded-ee-xl'
                                            : 'bg-white rounded-e-xl rounded-es-xl' }} p-3 shadow-sm">
                                        {{ $message->content }}
                                        <!-- الوقت -->
                                        <div class="absolute bottom-1 right-2 flex gap-1 items-center">
                                            <span class="text-[10px] text-[#667781]">
                                                {{ $message->created_at->format('h:i A') }}
                                            </span>
                                            @if ($message->sender_id == Auth::id())
                                                <svg class="w-3 h-3 opacity-80" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </main>

                <!-- حقل الإدخال -->
                <!-- منطقة الإدخال (مثبتة بأسفل الشاشة) -->
                <footer class="sticky bottom-0 bg-white border-t shadow-lg py-4">
                    <div class="max-w-3xl mx-auto px-4">
                        <form wire:submit.prevent="sendMessage" class="flex items-end gap-3">
                            <!-- حقل الإدخال الذكي -->
                            <div class="flex-1 relative">
                                <textarea wire:model.debounce.300ms="newMessage" x-data="{
                                    resize() {
                                        this.$el.style.height = '44px';
                                        this.$el.style.height = `${Math.min(this.$el.scrollHeight, 150)}px`;
                                    }
                                }" x-init="resize()" @input="resize()"
                                    class="w-full px-4 py-2 bg-[#f0f2f5] rounded-full 
                               focus:outline-none focus:ring-2 focus:ring-[#00a884]
                               resize-none overflow-hidden scroll-p-4"
                                    placeholder="اكتب رسالة..." style="height: 44px; min-height: 44px; max-height: 150px"
                                    @keydown.enter.prevent="if(!event.shiftKey) $wire.sendMessage()">
                    </textarea>
                            </div>

                            <!-- زر الإرسال -->
                            <button type="submit"
                                class="p-2 text-white bg-[#00a884] rounded-full hover:bg-[#008069] transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </footer>
            </div>


            <style>
                /* تخصيص شريط التمرير */
                .scroll-smooth::-webkit-scrollbar {
                    width: 6px;
                }

                .scroll-smooth::-webkit-scrollbar-track {
                    background: #f1f1f1;
                    border-radius: 10px;
                }

                .scroll-smooth::-webkit-scrollbar-thumb {
                    background: #c5c5c5;
                    border-radius: 10px;
                }

                .scroll-smooth::-webkit-scrollbar-thumb:hover {
                    background: #a8a8a8;
                }

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
