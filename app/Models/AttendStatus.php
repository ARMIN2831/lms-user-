<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendStatus extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'attend_status';
}
