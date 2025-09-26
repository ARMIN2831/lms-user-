<?php


namespace App\Services;

use App\Models\Attend;
use App\Models\Course;
use App\Models\Fee;
use App\Models\StudentCourse;
use App\Models\TeacherPayment;
use App\Models\User;
use App\Traits\HandlesUserTypeTrait;
use Illuminate\Support\Facades\DB;

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
        DB::enableQueryLog();
        $model = $this->model;
        $fee = Fee::where('year', 1404)->first();

        // دریافت تمام دوره‌های استاد با روابط لازم
        $courses = Course::where('teachers_id', $model->id)
            ->with([
                'title',
                'attends' => function($query) {
                    $query->select('id', 'courses_id', 'students_courses_id', 'feeFlag', 'date');
                },
                'attends.studentCourse', // رابطه برای محاسبه هزینه
                'attends.teacherPayment'
            ])
            ->select('id', 'courseTitle_id', 'courseType_id')
            ->get();

        // دریافت تمام student_courses_id های مورد نیاز
        $studentCourseIds = $courses->pluck('attends')
            ->flatten()
            ->pluck('students_courses_id')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        // دریافت تمام studentCourseها در یک کوئری
        $studentCourses = StudentCourse::whereIn('id', $studentCourseIds)
            ->get()
            ->keyBy('id');

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
            // جدا کردن جلسات پرداخت شده و نشده
            $attends = $course->attends;
            $paidAttends = $attends->whereNotNull('feeFlag');
            $unpaidAttends = $attends->whereNull('feeFlag');

            // گروه‌بندی جلسات پرداخت شده بر اساس payment_id
            $groupedPaidAttends = $paidAttends->groupBy('feeFlag');

            $paidSessionsByPayment = [];
            $courseTotalPaid = 0;

            foreach ($groupedPaidAttends as $paymentId => $attendsGroup) {
                $payment = $attendsGroup->first()->teacherPayment;

                $sessions = [];
                $sessionsTotalAmount = 0;

                foreach ($attendsGroup as $attend) {
                    $price = 0;

                    // محاسبه هزینه با استفاده از داده‌های از پیش لود شده
                    if ($attend->students_courses_id && isset($studentCourses[$attend->students_courses_id])) {
                        $studentCourse = $studentCourses[$attend->students_courses_id];

                        if ($course->courseType_id == 1) {
                            $fieldName = "fee_" . $studentCourse->perclocko;
                            if (isset($fee->$fieldName)) {
                                $price = $fee->$fieldName;
                            }
                        } else if ($course->courseType_id == 2) {
                            $price = $fee->feeg;
                        }
                    }

                    $sessionsTotalAmount += $price;

                    $sessions[] = [
                        'attend_id' => $attend->id,
                        'session_date' => $attend->date,
                        'amount' => $price
                    ];
                }

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

            // محاسبه هزینه جلسات پرداخت نشده
            $courseTotalUnpaid = 0;
            $unpaidSessions = [];

            foreach ($unpaidAttends as $attend) {
                $price = 0;

                if ($attend->students_courses_id && isset($studentCourses[$attend->students_courses_id])) {
                    $studentCourse = $studentCourses[$attend->students_courses_id];

                    if ($course->courseType_id == 1) {
                        $fieldName = "fee_" . $studentCourse->perclocko;
                        if (isset($fee->$fieldName)) {
                            $price = $fee->$fieldName;
                        }
                    } else if ($course->courseType_id == 2) {
                        $price = $fee->feeg;
                    }
                }

                $courseTotalUnpaid += $price;

                $unpaidSessions[] = [
                    'attend_id' => $attend->id,
                    'session_date' => $attend->date,
                    'amount' => $price
                ];
            }

            $courseData = [
                'course_id' => $course->id,
                'course_name' => $course->title->coTitle ?? 'بدون عنوان',
                'paid_sessions' => $paidSessionsByPayment,
                'unpaid_sessions' => [
                    'sessions_count' => $unpaidAttends->count(),
                    'sessions' => $unpaidSessions,
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
        $queries = DB::getQueryLog();
        return $result;
    }
}
