<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequests\UpdateProfileRequest;
use App\Models\Attend;
use App\Models\Fee;
use App\Models\StudentCourse;
use App\Services\CoursesService;
use App\Services\DashboardService;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentHomeController extends Controller
{
    protected $profileService;
    protected $dashboardService;
    protected $coursesService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->profileService = new ProfileService(auth()->user());
        $this->dashboardService = new DashboardService(auth()->user());
        $this->coursesService = new CoursesService(auth()->user());
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
        $user = $request->user()->load('student');
        $studentCourseData = StudentCourse::where('students_id', $user->student->id)->where('id',$id)->with('course.title','course.teacher','attends.status','student')->first();
        return response()->json([
            'message' => 'success',
            'studentCourse' => $studentCourseData,
        ]);
    }


    public function readComment(Request $request,$id)
    {
        Attend::where('id', $id)->update(['readComment' => 1]);
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
        $user = $request->user();
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        if (!Hash::check($request->current_password, $user->password))
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
        $user = $request->user();

        $fee = Fee::where('year',1404)->first();
        $studentCourses = StudentCourse::with(['course.title','payments' => function($query) use ($user) {
            $query->where('students_id', $user->student->id);
        }])->where('students_id', $user->student->id)->get()
        ->map(function ($studentCourse) use ($user, $fee) {
            $remainPrice = 0;
            if ($studentCourse->remain >= 0){
                $studentCourse->payment_count = $remainPrice;
                $studentCourse->payment_with_discount = 0;
            }else{
                if ($studentCourse->course->courseType_id == 1) {
                    $fieldName = "fee_" . $studentCourse->perclocko;
                    if (isset($fee->$fieldName)) {
                        $remainPrice += $studentCourse->remain * $fee->$fieldName;
                    }
                } else if ($studentCourse->course->courseType_id == 2) {
                    $remainPrice += $studentCourse->remain * $fee->feeg;
                }
                $studentCourse->payment_count = $remainPrice * (-1);
                $studentCourse->payment_with_discount = round((100 - $user->student->discount) * ($remainPrice * (-1)) / 100 , 2);
            }
            $studentCourse->total_payed = $studentCourse->payments->sum('pay_amount');
            $studentCourse->total_payed_count = $studentCourse->payments->sum('count');
            return $studentCourse;
        });



        return response()->json([
            'status' => 'success',
            'data' => $studentCourses,
        ]);
    }
}
