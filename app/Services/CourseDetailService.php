<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\Course;
use App\Models\Student;
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


    public function StudentGetCourseData($id)
    {
        $studentCourseData = StudentCourse::where('students_id', $this->model->id)->where('id',$id)->with('course.title','course.teacher','attends.status','student')->first();
        return [
            'studentCourse' => $studentCourseData,
        ];
    }


    public function TeacherGetCourseData($id)
    {

        $CourseData = Course::where('teachers_id', $this->model->id)
            ->where('id', $id)
            ->with(['title', 'teacher', 'attends' => function($query) {
                $query->with('student')->orderBy('id', 'desc')->take(20);
            }])
            ->first();

        $students = [];
        if ($CourseData){
            $studentsCourse = StudentCourse::where('courses_id',$id)->pluck('students_id');
            $students = Student::whereIn('id',$studentsCourse)
                ->select('id','family','name','image')
                ->get();
        }
        return [
            'studentCourse' => $CourseData,
            'students' => $students,
        ];
    }


    public function readComment($id)
    {
        Attend::where('id', $id)->update(['readComment' => 1]);
    }
}
