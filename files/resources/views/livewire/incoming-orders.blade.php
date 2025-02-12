<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 text-right">الطلبات الواردة</h2>

    @if(session()->has('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($orders->isEmpty())
        <p class="text-gray-600 text-right">لا توجد طلبات واردة حالياً.</p>
    @else
        <!-- تغليف الجدول بوعاء يوفر تمرير أفقي عند الحاجة -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-right">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">الخدمة</th>
                        <th class="px-4 py-2 border">المشتري</th>
                        <th class="px-4 py-2 border">السعر</th>
                        <th class="px-4 py-2 border">الحالة</th>
                        <th class="px-4 py-2 border">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="text-right">
                            <td class="px-4 py-2 border">{{ $order->id }}</td>
                            <td class="px-4 py-2 border">
                                {{ $order->service->name ?? 'غير متاح' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $order->user->name ?? 'غير متاح' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ number_format($order->service->price, 2) }} دولار
                            </td>
                            <td class="px-4 py-2 border">
                                @switch($order->status)
                                    @case('pending_approval')
                                        <span class="text-yellow-600">قيد الموافقة</span>
                                        @break
                                    @case('approved')
                                        <span class="text-blue-600">معتمد</span>
                                        @break
                                    @case('in_progress')
                                        <span class="text-indigo-600">قيد التنفيذ</span>
                                        @break
                                    @case('delivered')
                                        <span class="text-green-600">تم التسليم</span>
                                        @break
                                    @case('completed')
                                        <span class="text-gray-600">مكتمل</span>
                                        @break
                                    @case('cancelled')
                                        <span class="text-red-600">ملغي</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-4 py-2 border">
                                @if($order->status == 'pending_approval')
                                    <button wire:click="approveOrder({{ $order->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                        موافقة
                                    </button>
                                @elseif(in_array($order->status, ['approved', 'in_progress']))
                                    <button wire:click="deliverOrder({{ $order->id }})" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                        تأكيد التسليم
                                    </button>
                                @else
                                    <span class="text-sm text-gray-500">لا توجد إجراءات</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
