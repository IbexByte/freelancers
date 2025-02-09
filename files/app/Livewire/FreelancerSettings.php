<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FreelancerSettings extends Component
{
    public $services, $rates, $portfolioLink;

    public function mount()
    {
        // استرجع البيانات من المستخدم / جدول الخدمات...
        // مثال:
        $user = auth()->user();
        $this->services = $user->services;
        $this->rates = $user->rates;
        $this->portfolioLink = $user->portfolio_link;
    }

    public function updateSettings()
    {
        // تحقق من المدخلات، احفظ...
        // session()->flash('message', 'تم تحديث إعدادات الخدمة بنجاح!');
    }

    public function render()
    {
        return view('livewire.freelancer-settings');
    }
}
