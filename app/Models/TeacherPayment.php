<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherPayment extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'th_peyment';


    public function attends()
    {
        $this->hasMany(Attend::class,'feeFlag');
    }
}
