<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/start', function () {
    $log = [];

    $commands = [
        'migrate' => 'Database migrated (fresh)',
        //'db:seed --class=StartSeeder' => 'Database seeded (StartSeeder)',
        'cache:clear' => 'Cache cleared',
        'route:clear' => 'Route cache cleared',
        'config:clear' => 'Config cache cleared',
        'view:clear' => 'View cache cleared',
    ];

    foreach ($commands as $cmd => $message) {
        Artisan::call($cmd);
        $log[] = $message;
    }

    $log[] = '--- All tasks completed successfully ---';

    return response(implode(PHP_EOL, $log), 200)
        ->header('Content-Type', 'text/plain; charset=utf-8');
});

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/course', function () {
    return view('pages.course');
})->name('course');

Route::get('/courseDetail/{id}', function () {
    return view('pages.courseDetail');
});

Route::get('/courseDetailTest', function () {
    return view('pages.courseDetailTest');
});

Route::get('/courseDetailDynamic/{id}', function () {
    return view('pages.courseDetailDynamic');
});

Route::get('/payments', function () {
    return view('pages.payments');
});

Route::get('/profile', function () {
    return view('pages.profile');
});

Route::view('/menu-main', 'menus.menu-main');
Route::view('/menu-share', 'menus.menu-share');
Route::view('/menu-colors', 'menus.menu-colors');

