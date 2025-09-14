<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Student;
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
}
