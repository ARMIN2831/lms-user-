<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;


    public function course()
    {
        return $this->belongsTo(Course::class,'courses_id');
    }


    public function studentCourse()
    {
        return $this->belongsTo(StudentCourse::class,'students_courses_id ');
    }


    public function status()
    {
        return $this->belongsTo(AttendStatus::class,'attend_status_id');
    }


    public function teacherPayment()
    {
        return $this->belongsTo(TeacherPayment::class,'feeFlag');
    }
}
