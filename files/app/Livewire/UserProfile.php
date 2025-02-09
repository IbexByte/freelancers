<?php

namespace App\Livewire;

use Livewire\Component;

class UserProfile extends Component
{
    public $userType; // buyer or freelancer
    public $tab = 'account'; // افتراضاً

    // حقول الحساب الأساسية
    public $name, $email, $bio;
    public $password;

    // إعدادات أخرى...

    public function mount()
    {
        // استرجع بيانات المستخدم الحالي (مثلاً Auth::user())
        $user = auth()->user();
        // عيّن قيم الحقول
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->userType = $user->type; // مثلاً "buyer" أو "freelancer"
    }

    public function switchTab($tabName)
    {
        $this->tab = $tabName;
    }

    public function updateAccount()
    {
        // تحقق من المدخلات
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            // password اختياري
        ]);

        $user = auth()->user();
        $user->name = $this->name;
        $user->email = $this->email;
        if(!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }
        $user->bio = $this->bio;
        $user->type = $this->userType;
        $user->save();

        session()->flash('message', 'تم تحديث الحساب بنجاح!');
    }

    public function render()
    {
        return view('livewire.user-profile') ->layout('layouts.dashboard');
    }
}
