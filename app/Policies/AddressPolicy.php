<?php

namespace App\Policies;

use App\Services\BasePolicy;

class AddressPolicy extends BasePolicy
{
	public string $modelNameSlug = 'address';
}
