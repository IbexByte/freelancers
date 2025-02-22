<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Review;

class MyServices extends Component
{
    public $showConfirmation = false;
    public $selectedOrderId;
    public $showCelebration = false;

    public $showReviewModal = false;
    public $rating = 5;
    public $comment = '';
    public $showReviewForm = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500',
    ];

    public function showReview($orderId)
    {
        
        $this->selectedOrderId = $orderId;
        $this->showReviewForm = true;
        $this->resetErrorBag();
        $this->reset(['rating', 'comment']);
    }

    public function cancelReview()
    {
        $this->reset(['showReviewForm', 'selectedOrderId', 'rating', 'comment']);
    }



    public function confirmDelivery($orderId)
    {
        $this->selectedOrderId = $orderId;
        $this->showConfirmation = true;
    }
    public function completeOrder()
    {
        $order = Order::findOrFail($this->selectedOrderId);

        if ($order->status === 'delivered') {
            $order->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $this->showConfirmation = false;
            $this->showReviewModal = true;
            // إخفاء الرسالة بعد 3 ثواني
            $this->dispatch('hide-celebration', delay: 60000);
        }
    }

    protected $listeners = ['hide-celebration' => 'hideCelebration'];

    public function hideCelebration()
    {
        sleep(5);
        $this->showCelebration = false;
    }

    public function reportIssue($orderId)
    {
        // يمكنك إضافة منطق الإبلاغ عن مشكلة هنا
        session()->flash('error', 'تم الإبلاغ عن مشكلة في التسليم');
    }




    public function submitReview($orderId = null)
    {

        if ($orderId) {
            $order = Order::findOrFail($orderId);
        } else {

            $order = Order::findOrFail($this->selectedOrderId);
        }

        if ($order->service->reviews()->where('user_id', auth()->id())->exists()) {
            $this->addError('rating', 'لقد قمت بتقييم هذه الخدمة مسبقاً');
            return;
        }
       
        $order->service->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->showReviewModal = false;
        if ($this->selectedOrderId) {

            $this->showCelebration = true;
            $this->dispatch('hide-celebration', delay: 60000);
        }
        $this->cancelReview();
        session()->flash('review_success', 'تم إرسال التقييم بنجاح!');
    }

    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['service.media', 'provider'])
            ->latest()
            ->get();

        return view('livewire.my-services', [
            'orders' => $orders
        ])->layout('layouts.user');
    }
}