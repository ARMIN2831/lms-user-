<!DOCTYPE HTML>
<html lang="fa" dir="rtl" class="isPWA">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>اپکیت</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/all.min.css') }}">
    <link rel="manifest" href="{{ asset('_manifest.json') }}" data-pwa-version="3.4">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app/icons/icon-192x192.png') }}">
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <style>
        /* استایل‌های toast notification */
        .toast-alert-container {
            pointer-events: none;
        }

        .toast-alert {
            pointer-events: auto;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.5s ease;
        }

        .toast-close-btn {
            transition: all 0.2s ease;
            border-radius: 50%;
            padding: 2px;
        }

        .toast-close-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: rotate(90deg);
        }

        /* انیمیشن‌های toast */
        @keyframes toastSlideIn {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes toastSlideOut {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="theme-light" data-highlight="highlight-red">
    <div id="preloader" class="preloader-hide"><div class="spinner-border color-highlight" role="status"></div></div>
    <div id="page" class="device-is-android">

        <x-shared.footer/>

        <div class="page-content">
            <x-shared.header/>


            <script src="https://cdn.tailwindcss.com"></script>
            <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


            {{ $slot }}
        </div>
        <!-- Page content ends here-->
        <div id="menu-main" class="menu menu-box-right rounded-0" data-menu-load="{{ url('/menu-main') }}" data-menu-width="280" data-menu-active="nav-pages"></div>
        <div id="menu-share" class="menu menu-box-bottom rounded-m" data-menu-load="{{ url('/menu-share') }}" data-menu-height="370"></div>
        <div id="menu-colors" class="menu menu-box-bottom rounded-m" data-menu-load="{{ url('/menu-colors') }}" data-menu-height="480"></div>
    </div>

    <script type="text/javascript" src="{{ asset('scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/custom.js') }}"></script>
    <p class="offline-message bg-red-dark color-white">شما به اینترنت متصل نیستید</p><p class="online-message bg-green-dark color-white">اتصال به اینترنت برقرار شد</p>
</body>
</html>
