<div class="header header-auto-show header-fixed header-logo-app">
    <a href="{{ route('profile') }}" id="header_title" data-back-button="" class="header-title font-13 user_title">پکیج آموزشی</a>

</div>
<div class="page-title page-title-fixed user_title flex items-center space-x-3 space-x-reverse pl-4 flex justify-between" style="margin-top: 13px;">
    <a href="{{ route('profile') }}" class="flex justify-center items-center mr-4 relative">
        <span>
            <div class="w-16 h-16 rounded-full bg-purple-100 border-4 border-white shadow-lg overflow-hidden">
                <img id="header_image" class="w-full h-full object-cover">
            </div>
            <span class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span>
        </span>
        <h2 id="header_title2" class="mr-4 font-bold text-lg">صفحات</h2>
    </a>


    <div class="flex justify-center items-center gap-2">
        <button class="p-2 bg-gray-100 rounded-full text-gray-600 hover:bg-gray-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>
        <a href="#" class="page-title-icon shadow-xl bg-theme color-theme" data-menu="menu-main"><i class="fa fa-bars"></i></a>
    </div>


</div>
<div class="page-title-clear"></div>
