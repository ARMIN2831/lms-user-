<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getCourses(Request $request)
    {
        $user = $request->user();
        $courses = Student::where('users_id',$user->id)->with('courses')->get()[0]->courses;
        $count = count($courses);
        $percent = $count > 0 ? round(($courses->where('active', 1)->count() / $count) * 100,2) : 0;
        return response()->json([
            'message' => 'success',
            'data' => [
                'courseCount' => $count,
                'coursePercent' => $percent,
            ],
        ]);
    }
}
