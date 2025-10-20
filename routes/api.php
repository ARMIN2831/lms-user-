<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('SetLan')->group(function (){


    Route::middleware('logged')->group(function() {
        //Route::post('userRegister', [UserAuthController::class, 'userRegister'])->name('userRegister');
        Route::post('verifyOtp', [UserAuthController::class, 'verifyOtp'])->name('verifyOtp');
        //Route::post('resendOtp', [UserAuthController::class, 'resendOtp'])->name('resendOtp');
        Route::post('userLogin', [UserAuthController::class, 'userLogin'])->name('userLogin');
        Route::post('completeProfile', [UserAuthController::class, 'completeProfile'])->name('completeProfile');
        Route::post('userCheck', [UserAuthController::class, 'userCheck'])->name('userCheck');

        Route::post('SendOTPForgetPassword', [UserAuthController::class, 'SendOTPForgetPassword']);
        Route::post('changePassword', [UserAuthController::class, 'changePassword']);
    });

    Route::middleware(['auth:sanctum', 'checkLogin'])->group(function() {
        Route::get('/check-token', function (Request $request) {
            try {
                $user = $request->user();
                $name = '';
                $image = '';
                if ($user->user_type_id == 1) {
                    $name = $user->teacher->name . " " . $user->teacher->family;
                    $image = $user->teacher->image;
                }
                if ($user->user_type_id == 2) {
                    $name = $user->student->name . " " . $user->student->family;
                    $image = $user->student->image;
                }
                if ($user) return response()->json(['valid' => true,'type' => $user->user_type_id, 'name' => $name, 'image' => $image]);
                return response()->json(['valid' => false], 401);
            } catch (\Exception $e) {
                return response()->json(['valid' => false], 401);
            }
        });
        Route::get('/remove-token', function (Request $request) {
            try {
                $request->user()->currentAccessToken()->delete();

                return response()->json([
                    'message' => 'با موفقیت خارج شدید'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'خطا در خروج از سیستم'
                ], 500);
            }
        });
        Route::post('setPassword', [UserAuthController::class, 'setPassword']);
        Route::get('getUser', [UserAuthController::class, 'getUser'])->name('getUser');

        //user routes
        Route::controller(HomeController::class)->group(function () {
            Route::get('getCardsData', 'getCardsData')->name('getCardsData');
            Route::get('getAttends', 'getAttends')->name('getAttends');
            Route::get('getCourses', 'getCourses')->name('getCourses');
            Route::get('getCourseData/{id}', 'getCourseData')->name('getCourseData');
            Route::post('updateProfile', 'updateProfile')->name('updateProfile');
            Route::post('uploadProfile', 'uploadProfile')->name('uploadProfile');
            Route::post('changePassword', 'changePassword')->name('changePassword');
            Route::get('getPayments', 'getPayments')->name('getPayments');
            Route::post('readComment/{id?}', 'readComment')->name('readComment');
            Route::get('getFilterData', 'getFilterData')->name('getFilterData');
            Route::post('getAttendFilter', 'getAttendFilter')->name('getAttendFilter');
            Route::post('submitSessionComment', 'submitSessionComment')->name('submitSessionComment');
        });
    });
});
