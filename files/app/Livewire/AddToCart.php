<?php 
namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $serviceId;

    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function addToCart()
    {
        // التحقق من أن المستخدم مسجل الدخول
        if (!Auth::check()) {
            return redirect()->route('login'); // إعادة توجيه غير المسجلين إلى صفحة تسجيل الدخول
        }

        // التحقق من وجود الخدمة
        $service = Service::find($this->serviceId);
        if (!$service) {
            session()->flash('error', 'الخدمة غير موجودة.');
            return;
        }

        // التحقق من أن الخدمة ليست مضافَة مسبقاً في السلة
        $existingCartItem = CartItem::where('user_id', Auth::id())
            ->where('service_id', $this->serviceId)
            ->first();

        if ($existingCartItem) {
            session()->flash('error', 'الخدمة مضافَة مسبقاً إلى السلة.');
            return;
        }

        // إضافة الخدمة إلى السلة
        CartItem::create([
            'user_id' => Auth::id(),
            'service_id' => $this->serviceId,
            'quantity' => 1, // الكمية الافتراضية
        ]);

        $this->dispatch('cartUpdated');

        session()->flash('success', 'تمت إضافة الخدمة إلى السلة بنجاح.');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}