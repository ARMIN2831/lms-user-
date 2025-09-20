<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'students_courses','students_id','courses_id')
            ->withPivot('active','remain');
    }

    public function course()
    {
        return $this->hasMany(Course::class,'courses_id');
    }
}
