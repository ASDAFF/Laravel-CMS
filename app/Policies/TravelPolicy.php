<?php

namespace App\Policies;

use App\Services\BasePolicy;

class TravelPolicy extends BasePolicy
{
	public string $modelNameSlug = 'travel';
}
