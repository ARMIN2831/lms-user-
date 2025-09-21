<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\Information;
use App\Models\User;

class DashboardService
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


    public function getStudentCardsData(): array
    {
        $active_count = 0;
        $paymentCount = 0;

        $courses = $this->model->courses ?? [];
        $count = count($courses);

        foreach ($courses as $course) {
            if ($course->pivot->active == 1) $active_count++;
            $paymentCount += $course->pivot->remain;
        }

        $percent = $count > 0 ? round(($active_count / $count) * 100, 2) : 0;
        $news = Information::where('namayesh',1)->where('activeMainpage',1)->get();

        return [
            'courseCount' => $count,
            'coursePercent' => $percent,
            'paymentCount' => $paymentCount,
            'news' => $news,
        ];
    }


    public function getTeacherCardsData(): array
    {
        $active_count = 0;
        $paymentCount = 0;

        $courses = $this->model->courses ?? [];
        $count = count($courses);
        $percent = 0;

        foreach ($courses as $course) {
            if ($course->active == 1) $active_count++;
        }

        $news = Information::where('namayesh',1)->where('activeMainpage',1)->get();

        return [
            'courseCount' => $count,
            'coursePercent' => $percent,
            'paymentCount' => $paymentCount,
            'news' => $news,
        ];
    }


    public function getStudentAttends()
    {
        $upcomingAttends = Attend::where('students_id', $this->model->id)
            ->with('course.title')
            ->where('date', '>=', time())
            ->orderBy('date', 'asc')
            ->get();

        $lastPastAttend = Attend::where('students_id', $this->model->id)
            ->with('course.teacher','course.title','status')
            ->where('date', '<', time())
            ->orderBy('date', 'desc')
            ->first();

        $comments = Attend::where('students_id', $this->model->id)
            ->whereNotNull('comment')
            ->where('readComment', 0)
            ->get();

        return [
            'upcoming_attends' => $upcomingAttends,
            'last_past_attend' => $lastPastAttend,
            'comments' => $comments,
        ];
    }


    public function getTeacherAttends()
    {
        $model = $this->model;
        $upcomingAttends = Attend::where('date', '>=', time())
            ->whereHas('course',function ($query) use ($model) {
                $query->where('teachers_id', $model->id);
            })
            ->with('course.title')
            ->orderBy('date', 'asc')
            ->get();

        $lastPastAttend = Attend::where('date', '<', time())
            ->whereHas('course',function ($query) use ($model) {
                $query->where('teachers_id', $model->id);
            })
            ->with('course.teacher','status')
            ->orderBy('date', 'desc')
            ->first();

        return [
            'upcoming_attends' => $upcomingAttends,
            'last_past_attend' => $lastPastAttend,
        ];
    }
}
