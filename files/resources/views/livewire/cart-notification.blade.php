<a href="{{ route('cart.index') }}" class="hover:text-blue-600 relative">
    🛍️ المشتريات
    @if ($cartCount > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full transform translate-x-2 -translate-y-2">
            {{ $cartCount }}
        </span>
    @endif
</a>
