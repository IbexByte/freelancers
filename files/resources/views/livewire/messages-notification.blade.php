<a href="{{ route('chat') }}" class="mobile-nav-item relative" aria-label="الرسائل">
    @if($unreadMessages > 0)
      <span class="absolute top-0 left-0 -translate-x-1/2 bg-red-600 h-5 w-5 rounded-full flex items-center justify-center text-white text-xs">
        {{ $unreadMessages }}
      </span>
    @endif
    <i class="fas fa-envelope text-xl"></i>
    <span class="text-xs">الرسائل</span>
  </a>
  