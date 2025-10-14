<div id="footer-bar" class="footer-bar-6">
    <a href="{{ route('course') }}" class="@if(request()->is('course') || request()->is('courseDetail')) active-nav @endif"><i class="fas fa-book-open"></i><span>دوره ها</span></a>
    <a href="{{ route('payments') }}" class="@if(request()->is('payments')) active-nav @endif"><i class="fas fa-wallet"></i><span>شهریه</span><em></em></a>
    <a href="{{ route('dashboard') }}" class="@if(request()->is('dashboard')) active-nav @endif circle-nav"><i class="fas fa-home"></i><span>خانه</span><strong><u></u></strong></a>
    <a data-menu="menu-main" class="cursor-pointer @if(request()->is('payments')) active-nav @endif"><i class="fas fa-project-diagram"></i><span>منو</span></a>
    <a href="{{ route('profile') }}" class="@if(request()->is('profile')) active-nav @endif"><i class="fas fa-user-circle"></i><span>پروفایل</span></a>
</div>
