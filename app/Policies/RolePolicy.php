<?php

namespace App\Policies;

use App\Services\BasePolicy;

class RolePolicy extends BasePolicy
{
	public string $modelNameSlug = 'role';
}
