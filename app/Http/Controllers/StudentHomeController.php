<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequests\UpdateProfileRequest;
use App\Models\Attend;
use App\Models\Fee;
use App\Models\Information;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\Teacher;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentHomeController extends Controller
{
    protected $profileService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->profileService = new ProfileService(auth()->user());
    }

    public function getCardsData(Request $request)
    {
        $user = $request->user();
        $active_count = 0;
        $paymentCount = 0;
        $count = 0;
        $percent = 0;
        if ($user->user_type_id == 1){
            $courses = Teacher::where('users_id',$user->id)->with('courses')->get()[0]->courses;
            $count = count($courses);
            foreach ($courses as $course) if ($course->active == 1) $active_count++;
        }

        if ($user->user_type_id == 2) {
            $courses = Student::where('users_id',$user->id)->with('courses')->get()[0]->courses;
            $count = count($courses);
            foreach ($courses as $course) {
                if ($course->pivot->active and $course->pivot->active == 1) $active_count++;
                $paymentCount += $course->pivot->remain;
            }
            $percent = $count > 0 ? round(($active_count / $count) * 100,2) : 0;
        }
        $news = Information::where('namayesh',1)->where('activeMainpage',1)->get();


        return response()->json([
            'message' => 'success',
            'data' => [
                'courseCount' => $count,
                'coursePercent' => $percent,
                'paymentCount' => $paymentCount,
                'news' => $news,
            ],
        ]);
    }


    public function getAttends(Request $request)
    {
        $user = $request->user();
        if ($user->user_type_id == 2) {
            $user = $user->load('student');
            $upcomingAttends = Attend::where('students_id', $user->student->id)
                ->with('course.title')
                ->where('date', '>=', time())
                ->orderBy('date', 'asc')
                ->get();

            $lastPastAttend = Attend::where('students_id', $user->student->id)
                ->with('course.teacher','status')
                ->where('date', '<', time())
                ->orderBy('date', 'desc')
                ->first();

            $comments = Attend::where('students_id', $user->student->id)
                ->whereNotNull('comment')
                ->where('readComment', 0)
                ->get();

            return response()->json([
                'message' => 'success',
                'data' => [
                    'upcoming_attends' => $upcomingAttends,
                    'last_past_attend' => $lastPastAttend,
                    'comments' => $comments,
                ],
            ]);
        }
        if ($user->user_type_id == 1) {
            $user = $user->load('teacher');
            $upcomingAttends = Attend::where('date', '>=', time())
                ->whereHas('course',function ($query) use ($user) {
                    $query->where('teachers_id', $user->teacher->id);
                })
                ->with('course.title')
                ->orderBy('date', 'asc')
                ->get();

            $lastPastAttend = Attend::where('date', '<', time())
                ->whereHas('course',function ($query) use ($user) {
                    $query->where('teachers_id', $user->teacher->id);
                })
                ->with('course.teacher','status')
                ->orderBy('date', 'desc')
                ->first();

            return response()->json([
                'message' => 'success',
                'data' => [
                    'upcoming_attends' => $upcomingAttends,
                    'last_past_attend' => $lastPastAttend,
                ],
            ]);
        }
    }


    public function getCourses(Request $request)
    {
        $user = $request->user()->load('student');
        $studentCourse = StudentCourse::where('students_id', $user->student->id)->with('course.title','course.teacher','attends.status')->get();
        return response()->json([
            'message' => 'success',
            'data' => [
                'studentCourse' => $studentCourse,
            ],
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


    public function readComment(Request $request,$id)
    {
        Attend::where('id', $id)->update(['readComment' => 1]);
        return response()->json([
            'status' => 'success',
            'message' => '',
        ]);
    }
}
