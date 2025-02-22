<a href="{{ route('cart.index') }}" class="mobile-nav-item relative" aria-label="سلة المشتريات">
    @if($cartCount > 0)
      <span class="absolute animate-bounce top-0 left-0 -translate-x-1/2 bg-red-600 h-5 w-5 rounded-full flex items-center justify-center text-white text-xs">
        {{ $cartCount > 99 ? '99+' : $cartCount }}
      </span>
    @endif
    <i class="fas fa-shopping-cart text-xl"></i>
    <span class="text-xs">السلة</span>
</a>