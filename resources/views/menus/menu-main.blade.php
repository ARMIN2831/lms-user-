<div class="card rounded-0 bg-6" data-card-height="150">
    <div class="card-top">
        <a href="#" class="close-menu float-end me-2 text-center mt-3 icon-40 notch-clear"><i class="fa fa-times color-white"></i></a>
    </div>
    <div class="card-bottom">
        <h1 class="color-white ps-3 mb-0 font-28">اپکیت</h1>
        <p class="mb-2 ps-3 font-12 color-white opacity-50">به آینده خوش آمدید</p>
    </div>
    <div class="card-overlay bg-gradient"></div>
</div>
<div class="mt-4"></div>
<h6 class="menu-divider">منو</h6>

<div class="list-group list-custom-small list-menu">
    <a id="nav-welcome" href="{{ route('dashboard') }}">
        <i class="fa fa-heart gradient-red color-white"></i>
        <span>خانه</span>
        <i class="fa fa-angle-left"></i>
    </a>
    <a id="nav-homepages" href="{{ route('course') }}">
        <i class="fas fa-book-open gradient-green color-white"></i>
        <span>دوره ها</span>
        <i class="fa fa-angle-left"></i>
    </a>
    <a id="nav-components" href="{{ route('payments') }}">
        <i class="fas fa-wallet gradient-blue color-white"></i>
        <span>شهریه</span>
        <i class="fa fa-angle-left"></i>
    </a>
    <a id="nav-pages" href="{{ route('profile') }}">
        <i class="fas fa-user-circle gradient-brown color-white"></i>
        <span>پروفایل</span>
        <i class="fa fa-angle-left"></i>
    </a>
</div>
