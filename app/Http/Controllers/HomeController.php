<?php

namespace App\Http\Controllers;

use App\Models\Attend;
use App\Models\Information;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getCardsData(Request $request)
    {
        $user = $request->user();
        $courses = Student::where('users_id',$user->id)->with('courses')->get()[0]->courses;
        $count = count($courses);
        $active_count = 0;
        $paymentCount = 0;
        foreach ($courses as $course) {
            if ($course->pivot->active and $course->pivot->active == 1) $active_count++;
            $paymentCount += $course->pivot->remain;
        }
        $percent = $count > 0 ? round(($active_count / $count) * 100,2) : 0;

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
        $user = $request->user()->load('student');

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
        $studentCourseData = StudentCourse::where('students_id', $user->student->id)->where('id',$id)->with('course.title','course.teacher','attends.status')->first();
        return response()->json([
            'message' => 'success',
            'data' => [
                'studentCourse' => $studentCourseData,
            ],
        ]);
    }
}
