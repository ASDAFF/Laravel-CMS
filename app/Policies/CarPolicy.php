<?php

namespace App\Policies;

use App\Services\BasePolicy;

class CarPolicy extends BasePolicy
{
	public string $modelNameSlug = 'car';
}
