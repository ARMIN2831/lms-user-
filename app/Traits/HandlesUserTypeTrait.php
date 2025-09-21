<?php
namespace App\Traits;

use App\Models\User;

trait HandlesUserTypeTrait
{
    protected $user;
    protected $model;
    protected $type;

    public function initUser(User $user)
    {
        $this->user = $user;
        $this->model = match($user->user_type_id) {
            1 => $user->teacher,
            2 => $user->student,
        };
        $this->type = $user->user_type_id === 1 ? 'teacher' : 'student';
    }


    public function __call($name, $arguments)
    {
        $typeMethod = $this->type . ucfirst($name);
        if (method_exists($this, $typeMethod)) return $this->$typeMethod(...$arguments);
        throw new \BadMethodCallException("Method {$name} does not exist");
    }
}
