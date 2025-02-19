<div class="flex flex-col md:flex-row gap-4 mt-10 p-4">
    <!-- القائمة الجانبية -->
    <div class="w-full md:w-64 bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-bold mb-4 text-right">فلترة الطلبات</h3>
        <ul class="space-y-2">
            <li class="text-right">
                <button 
                    wire:click="filterByStatus(null)"
                    class="w-full px-4 py-2 text-right hover:bg-gray-100 rounded {{ !$selectedStatus ? 'bg-blue-100' : '' }}"
                >
                    الكل ({{ array_sum($this->statusCounts) }})
                </button>
            </li>
            @foreach($this->statusKeys as $statusKey)
                <li class="text-right">
                    <button 
                        wire:click="filterByStatus('{{ $statusKey }}')"
                        class="w-full px-4 py-2 text-right hover:bg-gray-100 rounded {{ $selectedStatus === $statusKey ? 'bg-blue-100' : '' }}"
                    >
                        {{ __('site.order_statuses.' . $statusKey) }} ({{ $this->statusCounts[$statusKey] ?? 0 }})
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="flex-1">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-2xl font-bold mb-4 text-right">الطلبات الواردة</h2>

            @if($orders->isEmpty())
                <p class="text-gray-600 text-right">لا توجد طلبات واردة حالياً.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($orders as $order)
                    <a href="{{ route('order.deteal', $order->id ) }}">
                        <div 
                            
                            class="cursor-pointer border rounded-lg p-4 hover:shadow-lg transition-shadow"
                        >
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="{{ $order->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                                        class="w-12 h-12 rounded-full object-cover"
                                        alt="مقدم الخدمة"
                                    >
                                    <div class="text-right">
                                        <h3 class="font-bold text-lg">{{ $order->service->title }}</h3>
                                        <p class="text-gray-500 text-sm">{{ $order->user->name }}</p>
                                    </div>
                                </div>
                                <span class="text-lg">
                                    {{ number_format($order->service->price, 2) }} $
                                </span>
                            </div>

                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">
                                    {{ $order->created_at->diffForHumans() }}
                                </span>
                                <span @class([
                                    'px-2 py-1 rounded-full text-xs',
                                    'bg-yellow-100 text-yellow-800' => $order->status === 'pending_approval',
                                    'bg-blue-100 text-blue-800' => $order->status === 'approved',
                                    'bg-indigo-100 text-indigo-800' => $order->status === 'in_progress',
                                    'bg-green-100 text-green-800' => $order->status === 'delivered',
                                    'bg-gray-100 text-gray-800' => $order->status === 'completed',
                                    'bg-red-100 text-red-800' => $order->status === 'cancelled',
                                ])>
                                    {{ __('site.order_statuses.' . $order->status) }}
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
