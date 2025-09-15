<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;


    public function title()
    {
        return $this->belongsTo(CourseTitle::class,'courseTitle_id');
    }


    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teachers_id');
    }
}
