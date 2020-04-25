<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Request;

class BaseAuthPolicy
{
    use HandlesAuthorization;

    public $model_slug;

    public function __construct()
    {
        if(!$this->model_slug){
            $this->model_slug = Request::segment(2);
        }
    }

    public function index(User $user)
    {
    	return true;
    }

    public function view(User $user, $list)
    {
    	if($user->can($this->model_slug. '_view')){
    		return true;
    	}

        return $user->id === $list->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, $list)
    {
    	if($user->can($this->model_slug. '_update')){
    		return true;
    	}

        return $user->id === $list->user_id;
    }

    public function delete(User $user, $list)
    {
    	if($user->can($this->model_slug. '_delete')){
    		return true;
    	}

        return $user->id === $list->user_id;
    }
}
