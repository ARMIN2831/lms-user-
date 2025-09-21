<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\StudentCourse;
use App\Models\User;

class CourseDetailService
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


    public function getCourseData($id)
    {
        $studentCourseData = StudentCourse::where('students_id', $this->model->id)->where('id',$id)->with('course.title','course.teacher','attends.status','student')->first();
        return [
            'studentCourse' => $studentCourseData,
        ];
    }


    public function readComment($id)
    {
        Attend::where('id', $id)->update(['readComment' => 1]);
    }
}
