<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\StudentCourse;
use App\Models\User;
use App\Traits\HandlesUserTypeTrait;

class CourseDetailService
{
    use HandlesUserTypeTrait;

    public function __construct(User $user)
    {
        $this->initUser($user);
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
