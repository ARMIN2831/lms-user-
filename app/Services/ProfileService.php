<?php


namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
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


    public function updateProfile($data)
    {
        $this->user->update([
            'mobile'=> $data['email'],
            'email' => $data['mobile'],
        ]);
        $this->model::where('users_id',$this->user->id)->update([
            'name' => $data['first_name'],
            'family' => $data['last_name'],
            'father' => $data['father_name'],
            'Pno' => $data['id_number'],
            'sodor' => $data['issue_place'],
            'Mid' => $data['national_code'],
            'married' => $data['marital_status'],
            'madrak' => $data['education'],
            'field' => $data['field'],
            'job' => $data['job'],
        ]);
    }


    public function uploadProfile($file)
    {
        deleteUploadedFile($this->model->image);
        $this->model->update([
            'image' => uploadFile($file),
        ]);
    }


    public function changePassword($data)
    {
        $this->user['password'] = Hash::make($data['new_password']);
        $this->user->save();
    }
}
