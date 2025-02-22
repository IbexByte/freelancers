<div class="my-10">
    <!-- نافذة التأكيد -->
    @if ($showConfirmation)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-pop-in">
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <div class="mx-auto h-20 w-20 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">تأكيد استلام الخدمة</h3>
                    <p class="text-gray-600 mb-6">هل أنت متأكد من اكتمال الخدمة حسب الشروط المتفق عليها؟</p>
                    <div class="flex gap-3 justify-center">
                        <button wire:click="$set('showConfirmation', false)"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg transition-colors">
                            إلغاء
                        </button>
                        <button wire:click="completeOrder"
                            class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            تأكيد الاستلام
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- نافذة التقييم -->
    @if ($showReviewModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-pop-in">
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <div class="mx-auto h-20 w-20 bg-yellow-100 rounded-full flex items-center justify-center">
                            ⭐
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">كيف كانت تجربتك؟</h3>
                    <p class="text-gray-600 mb-4">ساعدنا بتحسين خدماتنا من خلال تقييمك</p>

                    <div class="flex justify-center mb-6" x-data="{ rating: {{ $rating }} }">
                        @foreach ([1, 2, 3, 4, 5] as $i)
                            <button wire:click="$set('rating', {{ $i }})"
                                class="text-3xl mx-1 transform transition-all duration-200
                           {{ $rating >= $i ? 'text-yellow-400 scale-110' : 'text-gray-300' }}
                           hover:text-yellow-500 hover:scale-125">
                                ★
                            </button>
                        @endforeach
                    </div>

                    <textarea wire:model="comment" class="w-full p-3 border rounded-lg mb-4" placeholder="أخبرنا عن تجربتك (اختياري)"
                        rows="3"></textarea>

                    <div class="flex gap-3 justify-center">
                        <button wire:click="$set('showReviewModal', false)"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg transition-colors">
                            تخطي
                        </button>
                        <button wire:click="submitReview"
                            class="px-5 py-2.5 bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white rounded-lg transition-all">
                            إرسال التقييم
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- تأثير الاحتفال -->
    @if ($showCelebration)
        <div class="fixed inset-0 z-50 pointer-events-none">
            <!-- قصاصات ملونة -->
            @for ($i = 0; $i < 50; $i++)
                <div class="absolute confetti"
                    style="
                   --color: hsl({{ rand(0, 360) }}, 100%, 50%);
                   --x: {{ rand(0, 100) }}%;
                   --delay: {{ $i * 0.02 }}s;
                   --duration: {{ rand(6, 9) }}s;
                   top: -10px;
                   left: var(--x);
                   animation: confetti var(--duration) var(--delay) ease-out forwards;
               ">
                    <div class="w-3 h-3 rounded-full" style="background: var(--color)"></div>
                </div>
            @endfor

            <!-- رسالة التهنئة -->
            <div class="absolute inset-0 flex items-center z-999 justify-center animate-jump-in">
                <div
                    class="bg-gradient-to-r from-purple-600 to-blue-500 text-white px-8 py-4 rounded-full shadow-xl text-2xl font-bold">
                    🎉 تم الاستلام بنجاح!
                </div>
            </div>
        </div>
    @endif

    <!-- resources/views/livewire/my-services.blade.php -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center relative">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-500">
                الخدمات المشتراة
            </span>
            <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 h-1 w-24 bg-gradient-to-r from-purple-400 to-blue-300 rounded-full">
            </div>
        </h1>

        @if (session('success'))
            <div
                class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-lg shadow-lg animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div
                class="bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 mb-6 rounded-lg shadow-lg animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
            @forelse ($orders as $order)
                <div
                    class="relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 group">
                    <!-- الخلفية المتحركة المعدلة -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-purple-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-[1]">
                    </div>

                    <div class="flex flex-col z-999 md:flex-row p-6">
                        <!-- Media Section -->
                        <div class="md:w-1/3 lg:w-1/4 relative overflow-hidden rounded-xl">
                            @if ($order->service->media->isNotEmpty())
                                @foreach ($order->service->media->take(1) as $media)
                                    <div class="aspect-w-16 aspect-h-9">
                                        @if ($media->type === 'image')
                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Service image"
                                                class="object-cover w-full h-full transform hover:scale-105 transition-transform duration-300">
                                        @else
                                            <video class="w-full h-full object-cover rounded-xl" controls>
                                                <source src="{{ asset($media->file_path) }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-gray-100 w-full h-full flex items-center justify-center rounded-xl">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details Section -->
                        <div class="md:w-2/3 lg:w-3/4 md:pl-6 mt-4 md:mt-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $order->service->title }}</h3>
                                    <div class="flex items-center space-x-2 mb-4">
                                        <span
                                            class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                            {{ trans($order->status) }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $order->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-purple-600">
                                        {{ $order->service->price }}دولار
                                    </p>
                                </div>
                            </div>

                            <!-- Progress Timeline -->
                            <div class="relative pt-4">
                                <div class="absolute left-0 top-6 h-1 w-full bg-gray-200"></div>
                                <div class="flex justify-between">
                                    @php
                                        $statusTranslations = [
                                            'pending_approval' => 'بانتظار الموافقة',
                                            'approved' => 'تمت الموافقة',
                                            'in_progress' => 'قيد التنفيذ',
                                            'delivered' => 'تم التوصيل',
                                            'completed' => 'منتهية',
                                        ];
                                    @endphp

                                    @foreach (['pending_approval', 'approved', 'in_progress', 'delivered', 'completed'] as $step)
                                        @php
                                            $stepsKeys = array_keys(config('order_steps'));
                                            $currentStepIndex = array_search($order->status, $stepsKeys);
                                            $stepIndex = array_search($step, $stepsKeys);
                                            // في حال لم يتم العثور على أحد القيم، إعطاء قيمة افتراضية كبيرة أو صغيرة حسب السياق
                                            $currentStepIndex =
                                                $currentStepIndex !== false ? $currentStepIndex : PHP_INT_MAX;
                                            $stepIndex = $stepIndex !== false ? $stepIndex : PHP_INT_MAX;
                                        @endphp
                                        <div class="relative">
                                            <div
                                                class="w-6 h-6 rounded-full 
                                        {{ $order->status === $step
                                            ? 'bg-purple-600 border-2 border-white ring-4 ring-purple-200'
                                            : ($stepIndex <= $currentStepIndex
                                                ? 'bg-green-500'
                                                : 'bg-gray-300') }}">
                                            </div>
                                            <span
                                                class="absolute top-8 left-1/2 -translate-x-1/2 text-xs text-gray-600 whitespace-nowrap">
                                                {{ $statusTranslations[$step] ?? $step }}
                                            </span>
                                        </div>
                                    @endforeach


                                </div>
                            </div>

                            <!-- Provider Info -->
                            <div class="mt-6 flex items-center space-x-4 border-t pt-4">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover border-2 border-purple-200"
                                        src="{{ $order->provider->profile_photo_url ?? asset('default-avatar.png') }}"
                                        alt="{{ $order->provider->name }}">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $order->provider->name }}</p>
                                    <p class="text-sm text-gray-500">مزود الخدمة</p>
                                </div>
                            </div>

                            <!-- Actions -->
                            @if ($order->status === 'delivered')
                                <div class="mt-6 grid grid-cols-2 gap-4">
                                    <button wire:click="confirmDelivery({{ $order->id }})"
                                        class="py-2 px-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-[1.02] shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>تأكيد الاستلام</span>
                                    </button>

                                    <button wire:click="reportIssue({{ $order->id }})"
                                        class="py-2 px-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-[1.02] shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <span>إبلاغ عن مشكلة</span>
                                    </button>
                                </div>
                            @endif
                            @if ($order->status === 'completed')
                                <div class="mt-6 border-t pt-4">
                                    @if ($order->service->reviews()->where('user_id', auth()->id())->exists())
                                        <div class="bg-green-50 p-4 rounded-lg">
                                            <p class="text-green-600 font-medium">✔️ لقد قمت بتقييم هذه الخدمة</p>
                                            <div class="mt-2">
                                                @php
                                                    $userReview = $order->service
                                                        ->reviews()
                                                        ->where('user_id', auth()->id())
                                                        ->first();
                                                @endphp
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span
                                                            class="text-xl {{ $i <= $userReview->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                    @endfor
                                                </div>
                                                @if ($userReview->comment)
                                                    <p class="mt-2 text-gray-600">"{{ $userReview->comment }}"</p>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        @if ($showReviewForm)
                                            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
                                                <h3 class="text-lg font-bold mb-4">تقييم الخدمة</h3>


                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">التقييم
                                                        بالنجوم</label>
                                                    <div class="flex gap-1" x-data="{
                                                        rating: $wire.entangle('rating'),
                                                        tempRating: $wire.entangle('rating'),
                                                        hoverRating: 0
                                                    }"
                                                        @mouseleave="hoverRating = 0">
                                                        @foreach ([1, 2, 3, 4, 5] as $star)
                                                            <button type="button"
                                                                @click="rating = {{ $star }}"
                                                                @mouseover="hoverRating = {{ $star }}"
                                                                class="text-3xl transition-all duration-200 transform hover:scale-125"
                                                                :class="{
                                                                    'text-yellow-400': {{ $star }} <= (
                                                                        hoverRating || rating),
                                                                    'text-gray-300': {{ $star }} > (
                                                                        hoverRating || rating)
                                                                }">
                                                                ★
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                    @error('rating')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">التعليق
                                                        (اختياري)</label>
                                                    <textarea wire:model="comment" rows="3"
                                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                                        placeholder="اكتب تعليقك عن الخدمة..."></textarea>
                                                    @error('comment')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="flex gap-3 justify-end">
                                                    <button wire:click="cancelReview" type="button"
                                                        class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                                                        إلغاء
                                                    </button>
                                                    <button wire:click="submitReview({{ $order->id }})"
                                                        type="button"
                                                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 flex items-center gap-2">
                                                        <svg wire:loading.remove class="w-5 h-5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        <span wire:loading>جاري الإرسال...</span>
                                                        <span wire:loading.remove>إرسال التقييم</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <button wire:click="showReview({{ $order->id }})"
                                                class="text-purple-600 hover:text-purple-700 underline flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 114.95 0 2.5 2.5 0 01-4.95 0zM12 15v3m0 3H9m3 0h3m-3 0H9m3 0v-3m0-6V9m0 0h3m-3 0H9" />
                                                </svg>
                                                اكتب تقييمك للخدمة
                                            </button>
                                        @endif
                                    @endif

                                    {{-- بقية كود التقييمات --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-4 text-xl font-medium text-gray-900">لا توجد خدمات مشتراة</h3>
                        <p class="mt-1 text-gray-500">سيظهر هنا جميع الخدمات التي قمت بشرائها</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-pop-in {
            animation: popIn 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
        }

        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-jump-in {
            animation: jumpIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes jumpIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        .confetti {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        @keyframes confetti {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(120vh) rotate(720deg) translateX(calc((var(--x) - 50%) * 0.5));
                opacity: 0;
            }
        }

        .animate-pop-in {
            animation: popIn 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
        }

        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-jump-in {
            animation: jumpIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes jumpIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        .confetti {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        @keyframes confetti {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(120vh) rotate(720deg) translateX(calc((var(--x) - 50%) * 0.5));
                opacity: 0;
            }
        }
    </style>

</div>
