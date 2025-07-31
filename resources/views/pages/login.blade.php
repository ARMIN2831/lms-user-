<!DOCTYPE HTML>
<html lang="fa" dir="rtl">
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
</head>
<body class="theme-light">
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div id="menu-signup" class="menu menu-box-modal rounded-m menu-active" data-menu-height="375" data-menu-width="350" style="display: block; width: 350px; height: 375px;">
        <div class="menu-title">
            <p class="color-highlight">ثبت نام رایگان</p>
            <h1 class="font-24">ثبت نام</h1>
        </div>
        <div class="content mb-0 mt-2">
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="name" class="form-control validate-name" id="form1acd" placeholder="نام">
                <label for="form1acd" class="color-highlight font-11 font-500">نام</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(ضروری)</em>
            </div>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="email" class="form-control validate-email" id="form1ace" placeholder="ایمیل">
                <label for="form1ace" class="color-highlight font-11 font-500">ایمیل</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(ضروری)</em>
            </div>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control validate-password" id="form1adf" placeholder="رمز عبور">
                <label for="form1adf" class="color-highlight font-11 font-500">رمز عبور</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(ضروری)</em>
            </div>
            <p class="text-center pb-0 mb-0 pt-1">
                <a href="#" data-menu="menu-signin" class="text-center font-11 color-gray2-dark">حساب کاربری دارید؟ از اینجا وارد شوید.</a>
            </p>
            <a href="#" class="btn btn-full btn-m shadow-l rounded-s font-600 bg-blue-dark mt-4">ثبت نام</a>
        </div>
    </div>

    <div id="menu-main" class="menu menu-box-right rounded-0" data-menu-load="{{ url('/menu-main') }}" data-menu-width="280" data-menu-active="nav-pages"></div>
    <div id="menu-share" class="menu menu-box-bottom rounded-m" data-menu-load="{{ url('/menu-share') }}" data-menu-height="370"></div>
    <div id="menu-colors" class="menu menu-box-bottom rounded-m" data-menu-load="{{ url('/menu-colors') }}" data-menu-height="480"></div>
</div>




<script type="text/javascript" src="{{ asset('scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/custom.js') }}"></script>
</body>
