<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 animate-fade-in-up">
    <!-- العنوان الرئيسي -->
    <div class="text-center mb-8 animate-slide-in-down">
        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-500 to-blue-600">
            تفاصيل الطلب #{{ $order->id }}
        </h1>
        <p class="text-gray-500 mt-2 animate-pulse">
            📅 {{ $order->created_at->translatedFormat('d M Y - h:i A') }}
        </p>
    </div>

    <!-- بطاقة العميل -->
    <div
        class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 transform transition-all hover:scale-[1.01] hover:shadow-xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="space-y-2 flex-1">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">👤</span>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $order->user->name }}</h3>
                </div>
                <div class="space-y-1">
                    <p class="text-gray-600 flex items-center gap-1">
                        <span>📧</span>{{ $order->user->email }}
                    </p>
                    @if ($order->user->phone)
                        <p class="text-gray-600 flex items-center gap-1">
                            <span>📱</span>{{ $order->user->phone }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="text-left p-4 bg-gray-50 rounded-lg min-w-[200px] mt-4 md:mt-0">
                <p class="text-lg font-medium flex items-center gap-1">
                    💵 {{ number_format($order->total, 2) }} ر.س
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    شامل الضريبة ({{ $order->tax_rate }}%)
                </p>
            </div>
        </div>
    </div>

    @php
        $steps = [
            'pending_approval' => ['icon' => '⏳', 'label' => 'بانتظار الموافقة', 'color' => 'gray'],
            'approved' => ['icon' => '✅', 'label' => 'موافَق عليه', 'color' => 'blue'],
            'in_progress' => ['icon' => '🔧', 'label' => 'قيد التنفيذ', 'color' => 'yellow'],
            'delivered' => ['icon' => '🚚', 'label' => 'تم التوصيل', 'color' => 'purple'],
            'completed' => ['icon' => '🎉', 'label' => 'مكتمل', 'color' => 'green'],
        ];

        if ($order->status === 'cancelled') {
            $steps = ['cancelled' => ['icon' => '❌', 'label' => 'ملغي', 'color' => 'red']];
        }

        $currentIndex = array_search($order->status, array_keys($steps)) ?? -1;
    @endphp

    <!-- الخط الزمني -->
    <div class="relative py-8" x-data="{ currentStep: {{ $currentIndex }} }">
        <div
            class="absolute top-8 left-1/2 w-1 bg-gray-200 h-[calc(100%-4rem)] -translate-x-1/2 transition-all duration-500 ease-in-out">
        </div>

        <div class="flex flex-wrap justify-between gap-y-8">
            @foreach ($steps as $status => $data)
                <div class="w-1/5 min-w-[120px] text-center relative" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, {{ $loop->index * 150 }})"
                    x-show="loaded" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div
                        class="mx-auto mb-4 w-16 h-16 rounded-full flex items-center justify-center text-2xl shadow-lg transition-all duration-300 
                          @if ($loop->index <= $currentIndex) bg-{{ $data['color'] }}-500 text-white ring-4 ring-{{ $data['color'] }}-200 hover:scale-110 
                          @else bg-gray-100 text-gray-400 hover:bg-gray-200 @endif">
                        {{ $data['icon'] }}
                    </div>
                    <div
                        class="text-sm font-medium @if ($loop->index <= $currentIndex) text-gray-800 @else text-gray-400 @endif">
                        {{ $data['label'] }}
                    </div>
                    @if ($order->{$status . '_at'})
                        <div class="text-xs text-gray-500 mt-1 animate-fade-in">
                            {{ $order->{$status . '_at'}->translatedFormat('d M - h:i A') }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- أزرار تغيير الحالة -->
    @if ($allowedNextStatus && $order->status !== 'cancelled')
        <div class="text-center">
            <button wire:click="confirmStatusChange"
                class="p-4 rounded-lg border transition-all hover:scale-105 active:scale-95 
                   bg-white hover:bg-{{ $steps[$allowedNextStatus]['color'] }}-50 border-{{ $steps[$allowedNextStatus]['color'] }}-200
                   flex items-center justify-center gap-2 mx-auto w-full md:w-1/2">
                <span class="text-xl">{{ $steps[$allowedNextStatus]['icon'] }}</span>
                <span class="text-sm font-medium">تغيير الحالة إلى {{ $steps[$allowedNextStatus]['label'] }}</span>
            </button>
        </div>
    @endif

    @if ($order->status !== 'cancelled')
        <div class="text-center mt-4">
            <button wire:click="confirmStatusChange('cancelled')"
                class="text-red-500 hover:text-red-700 text-sm underline">
                إلغاء الطلب
            </button>
        </div>
    @endif

    <!-- مودال التأكيد -->
    <x-modal wire:model="showConfirmation" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        <div class="p-6 text-center">
            <div class="text-4xl mb-4">⚠️</div>
            <h3 class="text-xl font-bold mb-4">تأكيد تغيير الحالة</h3>
            <p class="text-gray-600 mb-6">هل أنت متأكد من تغيير حالة الطلب إلى<br>
                <strong class="text-primary-600">{{ $steps[$selectedStatus]['label'] }}</strong>؟
            </p>
            <div class="flex justify-center gap-4">
                <button wire:click="updateStatus"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    نعم، تأكيد
                </button>
                <button wire:click="$set('showConfirmation', false)"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    إلغاء
                </button>
            </div>
        </div>
    </x-modal>

    <!-- تفاصيل الخدمة -->
    <div class="bg-white rounded-xl p-6 shadow-lg transition-all hover:shadow-xl">
        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
            <span>🛠️</span> تفاصيل الخدمة
        </h3>
        <div class="flex flex-col md:flex-row items-center gap-6">
            @if ($order->service->image)
                <img src="{{ asset($order->service->image) }}"
                    class="w-32 h-32 object-cover rounded-lg shadow-md transition-transform hover:scale-105 cursor-zoom-in"
                    alt="{{ $order->service->title }}"
                    x-on:click="window.open('{{ asset($order->service->image) }}', '_blank')">
            @endif
            <div class="flex-1 space-y-3">
                <h4 class="text-lg font-medium">{{ $order->service->title }}</h4>
                <p class="text-gray-500 text-sm">{{ $order->service->description }}</p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-primary-600 font-medium">
                            💲 {{ number_format($order->service->price, 2) }} ر.س
                        </p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-gray-600">
                            ⏳ {{ $order->service->delivery_time }} يوم
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
