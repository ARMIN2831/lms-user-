<?php


namespace App\Services;

use App\Models\StudentCourse;
use App\Models\User;

class CoursesService
{
    protected $user;
    protected $model;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->model = match($user->user_type_id) {
            1 => $user->teacher,
            2 => $user->student,
            default => throw new \Exception('Invalid user type')
        };
    }


    public function getStudentCourses()
    {
        $studentCourse = StudentCourse::where('students_id', $this->model->id)->with('course.title','course.teacher','attends.status')->get();
        foreach ($studentCourse as $key => $course) {
            $attends = $course->attends;

            $totalClasses = $attends->count();
            $presentClasses = $attends->where('attend_status_id', 3)->count();
            $absentClasses = $attends->whereIn('attend_status_id', [4, 7])->count();
            $studentCourse[$key] = [
                'id' => $course->id,
                'title' => $course->course->title->coTitle ?? '',
                'cover' => $course->course->title->coCover ?? '',
                'teacher' => $course->course->teacher,
                'active' => $course->pivot->active ?? 0,
                'totalClasses' => $totalClasses,
                'presentClasses' => $presentClasses,
                'absentClasses' => $absentClasses,
                'presentPercentage' => $totalClasses > 0 ? round(($presentClasses / $totalClasses) * 100) : 0,
                'absentPercentage' => $totalClasses > 0 ? round(($absentClasses / $totalClasses) * 100) : 0,
            ];
        }
        return [
            'studentCourse' => $studentCourse,
        ];
    }
}
