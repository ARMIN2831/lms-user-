<?php


namespace App\Services;

use App\Models\Fee;
use App\Models\StudentCourse;
use App\Models\User;

class PaymentsService
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


    public function getStudentPayments()
    {
        $model = $this->model;
        $fee = Fee::where('year',1404)->first();
        $studentCourses = StudentCourse::with(['course.title','payments' => function($query) use ($model) {
            $query->where('students_id', $model->id);
        }])->where('students_id', $model->id)->get()
            ->map(function ($studentCourse) use ($model, $fee) {
                $remainPrice = 0;
                if ($studentCourse->remain >= 0){
                    $studentCourse->payment_count = $remainPrice;
                    $studentCourse->payment_with_discount = 0;
                }else{
                    if ($studentCourse->course->courseType_id == 1) {
                        $fieldName = "fee_" . $studentCourse->perclocko;
                        if (isset($fee->$fieldName)) {
                            $remainPrice += $studentCourse->remain * $fee->$fieldName;
                        }
                    } else if ($studentCourse->course->courseType_id == 2) {
                        $remainPrice += $studentCourse->remain * $fee->feeg;
                    }
                    $studentCourse->payment_count = $remainPrice * (-1);
                    $studentCourse->payment_with_discount = round((100 - $model->discount) * ($remainPrice * (-1)) / 100 , 2);
                }
                $studentCourse->total_payed = $studentCourse->payments->sum('pay_amount');
                $studentCourse->total_payed_count = $studentCourse->payments->sum('count');
                return $studentCourse;
            });



        return [
            'payments' => $studentCourses,
        ];
    }
}
