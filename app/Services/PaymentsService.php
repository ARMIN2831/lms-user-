<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\Course;
use App\Models\Fee;
use App\Models\StudentCourse;
use App\Models\TeacherPayment;
use App\Models\User;
use App\Traits\HandlesUserTypeTrait;

class PaymentsService
{
    use HandlesUserTypeTrait;

    public function __construct(User $user)
    {
        $this->initUser($user);
    }


    public function StudentGetPayments()
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


    public function TeacherGetPayments()
    {
        $model = $this->model;

        // استفاده از روابط برای بهینه‌سازی بیشتر
        $courses = Course::where('teachers_id', $model->id)
            ->with([
                'title',
                'attends.teacherPayment',
                'attends' => function($query) {
                    $query->select('id', 'courses_id', 'feeFlag', 'date', 'duration');
                }
            ])
            ->select('id','courseTitle_id')
            ->get();
        $result = [
            'teacher_id' => $model->id,
            'courses' => [],
            'summary' => [
                'total_paid' => 0,
                'total_unpaid' => 0,
                'total_sessions' => 0,
                'paid_sessions' => 0,
                'unpaid_sessions' => 0
            ]
        ];

        foreach ($courses as $course) {
            // استفاده از collection methods برای جداسازی
            $attends = $course->attends;
            $paidAttends = $attends->whereNotNull('feeFlag');
            $unpaidAttends = $attends->whereNull('feeFlag');

            // گروه‌بندی با استفاده از groupBy
            $groupedPaidAttends = $paidAttends->groupBy('feeFlag');

            $paidSessionsByPayment = [];
            $courseTotalPaid = 0;

            foreach ($groupedPaidAttends as $paymentId => $attendsGroup) {
                $payment = $attendsGroup->first()->teacherPayment;

                $sessions = $attendsGroup->map(function($attend) {
                    return [
                        'attend_id' => $attend->id,
                        'session_date' => $attend->date,
                        'amount' => $attend->duration
                    ];
                })->toArray();

                $sessionsTotalAmount = $attendsGroup->sum('duration');
                $courseTotalPaid += $sessionsTotalAmount;

                $paidSessionsByPayment[] = [
                    'payment_id' => $paymentId,
                    'payment_date' => $payment->pay_date ?? null,
                    'payment_amount' => $payment->pay_amount ?? 0,
                    'sessions' => $sessions,
                    'sessions_count' => $attendsGroup->count(),
                    'sessions_total_amount' => $sessionsTotalAmount
                ];
            }

            // بقیه کد مانند قبل...
            $courseTotalUnpaid = $unpaidAttends->sum('duration');
            $courseData = [
                'course_id' => $course->id,
                'course_name' => $course->title->coTitle,
                'paid_sessions' => $paidSessionsByPayment,
                'unpaid_sessions' => [
                    'sessions_count' => $unpaidAttends->count(),
                    'sessions' => $unpaidAttends->map(function($attend) {
                        return [
                            'attend_id' => $attend->id,
                            'session_date' => $attend->date,
                            'amount' => $attend->duration
                        ];
                    })->toArray(),
                    'total_amount' => $courseTotalUnpaid
                ],
                'summary' => [
                    'total_paid' => $courseTotalPaid,
                    'total_unpaid' => $courseTotalUnpaid,
                    'total_sessions' => $attends->count(),
                    'paid_sessions_count' => $paidAttends->count(),
                    'unpaid_sessions_count' => $unpaidAttends->count()
                ]
            ];

            $result['courses'][] = $courseData;

            // به‌روزرسانی خلاصه کلی
            $result['summary']['total_paid'] += $courseTotalPaid;
            $result['summary']['total_unpaid'] += $courseTotalUnpaid;
            $result['summary']['total_sessions'] += $attends->count();
            $result['summary']['paid_sessions'] += $paidAttends->count();
            $result['summary']['unpaid_sessions'] += $unpaidAttends->count();
        }

        return $result;
    }
}
