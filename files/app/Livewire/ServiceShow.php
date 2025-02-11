<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ServiceShow extends Component
{
    public Service $service;
    public $isFavorite = false;
    public $reviews;
    public $relatedServices;

    /**
     * يتم استدعاء الدالة mount تلقائيًا عند تحميل المكوّن.
     * هنا نقوم بتمرير نموذج الخدمة وتحميل المتغيرات الأخرى.
     *
     * @param Service $service
     */
    public function mount(Service $service)
    {
        $this->service = $service;
        
        // تعيين حالة المفضلة؛ يمكنك تعديل هذا الجزء بناءً على منطقك (مثلاً تحميلها من قاعدة البيانات)
        $this->isFavorite = false;
        
        // تحميل التقييمات؛ تأكد من وجود علاقة reviews في موديل Service (مع علاقة user)
        $this->reviews = $service->reviews()->with('user')->get();

        // تحميل الخدمات المشابهة؛ مثلاً حسب التصنيف
        $this->relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->latest()
            ->take(4)
            ->get();
    }

    /**
     * تبديل حالة المفضلة.
     */
    public function toggleFavorite()
    {
        $this->isFavorite = !$this->isFavorite;
        // يمكنك هنا تحديث الحالة في قاعدة البيانات إذا كان ذلك مطلوبًا
    }

    /**
     * دالة لإضافة الخدمة إلى السلة.
     */
    public function addToCart()
    {
        // أضف منطق إضافة الخدمة إلى السلة هنا
    }

    /**
     * دالة لعرض نموذج الاتصال مع البائع.
     */
    public function showContactForm()
    {
        // أضف منطق عرض نموذج الاتصال هنا
    }

    public function render()
    {
        return view('livewire.service-show', [
            'service' => $this->service,
            'reviews' => $this->reviews,
            'relatedServices' => $this->relatedServices,
            'isFavorite' => $this->isFavorite,
        ])->layout('layouts.user');
    }
}
