<?php

namespace App\Policies;

use App\Services\BaseAuthPolicy;

class PostPolicy extends BaseAuthPolicy
{
	public $model_slug = 'post';
}
