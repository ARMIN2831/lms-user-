<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Traits\HandlesUserTypeTrait;

class CourseFilterService
{
    use FileUploadTrait, HandlesUserTypeTrait;

    public function __construct(User $user)
    {
        $this->initUser($user);
    }


    public function TeacherGetFilterData()
    {
        $courses = Course::where('teachers_id', $this->model->id)
            ->with(['title'])
            ->select('id','courseTitle_id')
            ->get()
            ->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title ? $course->title->coTitle : null
                ];
            });
        $studentsCourse = StudentCourse::whereIn('courses_id',$courses->pluck('id'))->pluck('students_id');
        $students = Student::whereIn('id',$studentsCourse)
            ->select('id','family','name','image')
            ->get();

        return [
            'students' => $students,
            'courses' => $courses,
        ];
    }


    public function TeacherGetAttendFilter($data)
    {
        $courses = Course::where('teachers_id', $this->model->id)->pluck('id');
        $attends = Attend::query()->whereIn('courses_id', $courses);

        if ($data['date']) {
            $startOfDay = strtotime($data['date'] . ' 00:00:00');
            $endOfDay = strtotime($data['date'] . ' 23:59:59');
            $attends->whereBetween('date', [$startOfDay, $endOfDay]);
        }

        if ($data['activeStatus']) {
            $attends->whereHas('course', function ($q) use ($data) {
                $q->where('active', $data['activeStatus']);
            });
        }
        if ($data['courses']) $attends->whereIn('courses_id', $data['courses']);
        if ($data['students']) $attends->whereIn('students_id', $data['students']);

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 15;
        $offset = ($page - 1) * $perPage;

        $total = $attends->count();
        $attends = $attends->offset($offset)->limit($perPage)
            ->with('student', 'course.title')
            ->get()
            ->map(function($attend) {
                return [
                    'id' => $attend->id ?? null,
                    'date' => $attend->date ?? null,
                    'sylabes' => $attend->sylabes ?? null,
                    'comment' => $attend->comment ?? null,
                    'attend_status_id' => $attend->attend_status_id ?? null,
                    'time' => $attend->time ?? null,
                    'duration' => $attend->duration ?? null,
                    'readComment' => $attend->readComment ?? null,
                    'grade' => $attend->grade ?? null,
                    'feeFlag' => $attend->feeFlag ?? null,

                    'name' => $attend->student->name ?? null,
                    'family' => $attend->student->family ?? null,
                    'image' => $attend->student->image ?? null,

                    'Tname' => $attend->course->teacher->name ?? null,
                    'Tfamily' => $attend->course->teacher->family ?? null,
                    'Timage' => $attend->course->teacher->image ?? null,

                    'title' => $attend->course->title->coTitle ?? null,
                    'cover' => $attend->course->title->coCover ?? null,
                ];
            });

        return [
            'data' => $attends,
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage)
            ]
        ];
    }


    public function TeacherSubmitSessionComment($data,$file)
    {
        $updateData = [
            'comment' => $data['comment'],
            'grade' => $data['grade'],
        ];
        if ($file) $updateData['sylabes'] = $this->uploadFile($file);

        Attend::where('id',$data['session_id'])->update($updateData);
        return [
            'sylabes_path' => $updateData['sylabes']
        ];
    }
}
