<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequests\UpdateProfileRequest;
use App\Services\CourseDetailService;
use App\Services\DashboardService;
use App\Services\PaymentsService;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentHomeController extends Controller
{
    protected $profileService;
    protected $dashboardService;
    protected $coursesService;
    protected $courseDetailService;
    protected $paymentsService;
    protected $user;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->user = $user = request()->user();
        $this->profileService = new ProfileService($user);
        $this->dashboardService = new DashboardService($user);
        $this->courseDetailService = new CourseDetailService($user);
        $this->paymentsService = new PaymentsService($user);
    }

    public function getCardsData(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->dashboardService->getStudentCardsData(),
        ]);
    }


    public function getAttends(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->dashboardService->getStudentAttends(),
        ]);
    }


    public function getCourses(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->coursesService->getStudentCourses(),
        ]);
    }


    public function getCourseData(Request $request,$id)
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->courseDetailService->getCourseData($id),
        ]);
    }


    public function readComment(Request $request,$id)
    {
        $this->courseDetailService->readComment($id);
        return response()->json([
            'status' => 'success',
            'message' => '',
        ]);
    }


    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->profileService->updateProfile($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => trans('messages.profile_updated'),
        ]);
    }


    public function uploadProfile(Request $request)
    {
        $this->profileService->uploadProfile($request->file('avatar'));
        return response()->json([
            'status' => 'success',
            'message' => trans('messages.profile_updated'),
        ]);
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        if (!Hash::check($request->current_password, $this->user->password))
            return response()->json([
                'status' => 'error',
                'message' => trans('messages.password_wrong')
            ],422);
        $this->profileService->changePassword($request->input());

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.password_changed')
        ]);
    }


    public function getStudentPayments(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->paymentsService->getStudentPayments(),
        ]);
    }
}
