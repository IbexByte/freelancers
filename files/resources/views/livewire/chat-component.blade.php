<div class="bg-[#eee]">
    <!-- حاوية عامة للتجاوب والمسافات -->
    <div class="container mx-auto px-2 sm:px-6 md:px-8 bg-[#eee]">

        @if (!$conversation)
            <div class="max-w-2xl w-full mt-36 mx-auto">
                <!-- الهيدر -->
                <div class="flex items-center justify-between my-6">
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-800">الدردشات</h1>
                    <div class="flex items-center gap-3">
                        <!-- زر العودة للصفحة الرئيسية -->
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01
                                   M12 6a1 1 0 110-2 1 1 0 010 2zm0 7
                                   a1 1 0 110-2 1 1 0 010 2zm0 7
                                   a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- قائمة المحادثات مع ظل مخصص يعطي عمقاً أكثر -->
                <div class="bg-white rounded-2xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] divide-y divide-gray-100">
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
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold text-gray-800 transition-colors">
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
            <div class="relative flex flex-col bg-[#eee] no-scrollbar">

                <!-- الهيدر مع ظل خفيف يعطي إحساساً بالعمق -->
                <div
                    class="md:top-0 top-0 left-0 right-0 bg-white p-4 border-b flex items-center gap-3 fixed 
                        md:rounded-md shadow-[0_2px_8px_rgba(0,0,0,0.1)] z-50">
                    <!-- زر الرجوع -->
                    <button wire:click="backToList" type="button"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- صورة الطرف الآخر -->
                    <img src="{{ $recipient->profile_photo_url }}" 
    class="w-10 h-10 rounded-lg object-cover shadow border-2 border-white">

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
                
                <div class="h-12 invisible"></div>
                <div class="h-12 invisible"></div>

                <!-- عرض الرسائل مع تقليل الحافة العلوية للنصف -->
                <div class="bg-[#eee] no-scrollbar w-full overflow-y-auto pb-44 pt-26 md:pt-22 px-0 space-y-3 scroll-smooth"
                    x-data="{ scrollToBottom() { this.$el.scrollTop = this.$el.scrollHeight } }" x-init="scrollToBottom()" x-on:messageReceived.window="scrollToBottom()">

                    @php
                        $lastDate = null;
                    @endphp

                    @foreach ($messages as $message)
                        @php
                            $currentDate = $message->created_at->format('Y-m-d');
                        @endphp

                        @if ($currentDate != $lastDate)
                            <!-- عرض التاريخ -->
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
                            class="flex items-end gap-x-2 {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div
                                class="max-w-[85%] min-h-10 min-w-24 px-4 relative pb-6 pt-2 rounded-3xl {{ $message->sender_id == Auth::id()
                                    ? 'bg-gray-700 text-white rounded-bl-none'
                                    : 'bg-white border border-gray-100 rounded-br-none shadow-[0_2px_8px_rgba(0,0,0,0.08)]' }}">
                                <p class="text-sm md:text-base leading-relaxed break-words">
                                    {{ $message->content }}
                                </p>

                                <!-- عرض المرفقات إن وجدت -->
                                @if ($message->attachments->isNotEmpty())
                                    <div class="mt-2 space-y-2">
                                        @foreach ($message->attachments as $attachment)
                                            @if ($attachment->type === 'image')
                                                <!-- عرض الصورة -->
                                                <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                    alt="{{ $attachment->file_name }}" class="max-w-full rounded-lg">
                                            @else
                                                <!-- عرض رابط للملف -->
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}" download
                                                    class="text-blue-500 underline">
                                                    {{ $attachment->file_name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <!-- وقت الإرسال مع أيقونة القراءة -->
                                <div
                                    class="absolute bottom-1 flex items-center justify-center gap-1 mt-1 {{ $message->sender_id == Auth::id() ? 'text-blue-100 left-1' : 'text-gray-600 right-1' }}">
                                    <span class="text-[10px] opacity-80">
                                        {{ str_replace(['AM', 'PM'], ['ص', 'م'], $message->created_at->format('h:i A')) }}
                                    </span>
                                    @if ($message->read)
                                        <svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- حقل الإدخال مع ظل مخصص في الأسفل -->
                <div
                    class="bg-white p-4 border-t fixed bottom-0 left-0 right-0 z-50 shadow-[0_-8px_30px_-10px_rgba(0,0,0,0.15)]">
                    <form wire:submit.prevent="sendMessage" class="flex gap-2 items-end max-w-2xl mx-auto w-full"
                        x-data="{
                            attachments: [],
                            resetInput() {
                                this.$nextTick(() => {
                                    const textarea = this.$refs.messageInput;
                                    textarea.style.height = '48px';
                                    textarea.dispatchEvent(new Event('input'));
                                });
                            },
                            handleFileSelect(event) {
                                const files = Array.from(event.target.files);
                                const maxSize = 5 * 1024 * 1024; // 5MB
                        
                                this.attachments = files.map(file => ({
                                    name: file.name,
                                    size: file.size,
                                    type: file.type.startsWith('image/') ? 'image' : 'file',
                                    preview: file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
                                    fileObject: file
                                })).filter(file => {
                                    if (file.size > maxSize) {
                                        alert('الملف ' + file.name + ' يتجاوز الحجم المسموح (5MB)');
                                        return false;
                                    }
                                    return true;
                                });
                            },
                            removeAttachment(index) {
                                this.attachments.splice(index, 1);
                                this.$wire.attachments.splice(index, 1);
                            }
                        }" @message-sent.window="resetInput; attachments = []">

                        <!-- زر المرفقات -->
                        <div class="flex items-center gap-1 mb-2">
                            <button type="button" @click="$refs.fileInput.click()"
                                class="p-2 text-gray-500 hover:text-blue-600 transition-transform transform hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <input type="file" x-ref="fileInput" class="hidden" wire:model="attachments"
                                    multiple accept="image/*, .pdf, .doc, .docx">
                            </button>
                        </div>

                        <!-- حقل الإدخال -->
                        <div class="flex-1 relative group">
                            <textarea x-ref="messageInput" wire:model.debounce.300ms="newMessage" placeholder="اكتب رسالتك..."
                                x-data="{
                                    baseHeight: 48,
                                    maxHeight: 96,
                                    resize() {
                                        this.$el.style.height = `${this.baseHeight}px`;
                                        this.$el.style.height = `${Math.min(this.$el.scrollHeight, this.maxHeight)}px`;
                                    }
                                }" x-init="resize()" x-on:input="resize()"
                                class="w-full px-4 py-2.5 no-scrollbar bg-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 
                            text-base resize-none overflow-y-auto transition-all duration-200 ease-in-out 
                            hover:bg-gray-50 focus:bg-white"
                                style="min-height: 48px; max-height: 96px" @keydown.enter.prevent="if (!event.shiftKey) $wire.sendMessage()"></textarea>

                            <!-- توجيهات الكتابة -->
                            <div
                                class="absolute -top-6 right-2 bg-white px-2 py-1 rounded-lg shadow-sm text-xs text-gray-500 
                       opacity-0 group-focus-within:opacity-100 transition-opacity">
                                Shift + Enter ↵ للسطر الجديد
                            </div>
                        </div>

                        <!-- زر الإرسال -->
                        <button type="submit"
                            class="mb-2 p-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-200 shadow-lg transform hover:scale-110 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>

                    <!-- منطقة عرض المرفقات -->
                    <div class="max-w-2xl mx-auto mt-2" x-show="attachments.length > 0">
                        <div class="flex gap-2 animate-fade-in flex-wrap">
                            <template x-for="(attachment, index) in attachments" :key="index">
                                <div
                                    class="px-3 py-1.5 bg-white border rounded-full shadow-sm text-sm text-gray-600 flex items-center gap-2 hover:bg-gray-50 transition-colors relative">
                                    <template x-if="attachment.type === 'image'">
                                        <img :src="attachment.preview" class="w-8 h-8 rounded-full object-cover"
                                            alt="معاينة الصورة">
                                    </template>
                                    <template x-if="attachment.type === 'file'">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </template>
                                    <span
                                        x-text="attachment.name.substring(0, 15) + (attachment.name.length > 15 ? '...' : '')"></span>
                                    <button @click="removeAttachment(index)"
                                        class="text-gray-400 hover:text-red-500 transition-colors">&times;</button>
                                </div>
                            </template>
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
