<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'students_courses';


    public function course()
    {
        return $this->belongsTo(Course::class,'courses_id');
    }


    public function attends()
    {
        return $this->hasMany(Attend::class,'students_courses_id');
    }
}
