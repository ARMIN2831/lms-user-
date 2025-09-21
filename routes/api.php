<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentHomeController;
use App\Http\Controllers\TeacherHomeController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('SetLan')->group(function (){


    Route::middleware('logged')->group(function() {
        //Route::post('userRegister', [UserAuthController::class, 'userRegister'])->name('userRegister');
        Route::post('sendOTP', [UserAuthController::class, 'sendOTP']);
        Route::post('verifyOtp', [UserAuthController::class, 'verifyOtp']);
        Route::post('userLogin', [UserAuthController::class, 'userLogin'])->name('userLogin');
        Route::post('completeProfile', [UserAuthController::class, 'completeProfile'])->name('completeProfile');
        Route::post('userCheck', [UserAuthController::class, 'userCheck'])->name('userCheck');

        Route::post('SendOTPForgetPassword', [UserAuthController::class, 'SendOTPForgetPassword']);
        Route::post('changePassword', [UserAuthController::class, 'changePassword']);
    });

    Route::middleware(['auth:sanctum', 'checkLogin'])->group(function() {
        Route::get('/check-token', function (Request $request) {
            try {
                if ($request->user()) return response()->json(['valid' => true]);
                return response()->json(['valid' => false], 401);
            } catch (\Exception $e) {
                return response()->json(['valid' => false], 401);
            }
        });
        Route::post('setPassword', [UserAuthController::class, 'setPassword']);
        Route::get('getUser', [UserAuthController::class, 'getUser'])->name('getUser');

        //students
        Route::middleware('CheckUserType:students')->name('students.')->prefix('students')->controller(StudentHomeController::class)->group(function () {
            Route::get('getCardsData', 'getCardsData')->name('getCardsData');
            Route::get('getAttends', 'getAttends')->name('getAttends');
            Route::get('getCourses', 'getCourses')->name('getCourses');
            Route::get('getCourseData/{id}', 'getCourseData')->name('getCourseData');
            Route::post('updateProfile', 'updateProfile')->name('updateProfile');
            Route::post('uploadProfile', 'uploadProfile')->name('uploadProfile');
            Route::post('changePassword', 'changePassword')->name('changePassword');
            Route::get('getStudentPayments', 'getStudentPayments')->name('getStudentPayments');
            Route::post('readComment/{id}', 'readComment')->name('readComment');
        });


        //teachers
        Route::middleware('CheckUserType:teachers')->name('teachers.')->prefix('teachers')->controller(TeacherHomeController::class)->group(function () {
            Route::get('getCardsData', 'getCardsData')->name('getCardsData');
            Route::get('getAttends', 'getAttends')->name('getAttends');
            Route::get('getCourses', 'getCourses')->name('getCourses');
            Route::get('getCourseData/{id}', 'getCourseData')->name('getCourseData');
            Route::post('updateProfile', 'updateProfile')->name('updateProfile');
            Route::post('uploadProfile', 'uploadProfile')->name('uploadProfile');
            Route::post('changePassword', 'changePassword')->name('changePassword');
            Route::get('getStudentPayments', 'getStudentPayments')->name('getStudentPayments');
            Route::post('readComment/{id}', 'readComment')->name('readComment');
        });
    });
});
