<?php


namespace App\Services;

use App\Models\Course;
use App\Models\StudentCourse;
use App\Models\User;
use App\Traits\HandlesUserTypeTrait;

class CoursesService
{
    use HandlesUserTypeTrait;

    public function __construct(User $user)
    {
        $this->initUser($user);
    }


    public function StudentGetCourses()
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


    public function TeacherGetCourses()
    {
        $courses = Course::where('teachers_id',$this->model->id)->with('title','teacher','attends.status')->get();
        //$studentCourse = StudentCourse::where('students_id', $this->model->id)->with('course.title','course.teacher','attends.status')->get();
        foreach ($courses as $key => $course) {
            $attends = $course->attends;

            $totalClasses = $attends->count();
            $presentClasses = $attends->where('attend_status_id', 3)->count();
            $absentClasses = $attends->whereIn('attend_status_id', [4, 7])->count();
            $studentCourse[$key] = [
                'id' => $course->id,
                'title' => $course->title->coTitle ?? '',
                'cover' => $course->title->coCover ?? '',
                'teacher' => $course->teacher,
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
