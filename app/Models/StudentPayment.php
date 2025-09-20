<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'st_peyment';
}
