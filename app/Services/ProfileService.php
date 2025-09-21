<?php


namespace App\Services;

use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Traits\HandlesUserTypeTrait;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    use FileUploadTrait, HandlesUserTypeTrait;

    public function __construct(User $user)
    {
        $this->initUser($user);
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
        $this->deleteUploadedFile($this->model->image);
        $this->model->update([
            'image' => $this->uploadFile($file),
        ]);
    }


    public function changePassword($data)
    {
        $this->user['password'] = Hash::make($data['new_password']);
        $this->user->save();
    }
}
