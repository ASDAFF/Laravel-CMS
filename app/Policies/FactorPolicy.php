<?php

namespace App\Policies;

use App\Services\BaseAuthPolicy;

class FactorPolicy extends BaseAuthPolicy
{
	public $modelNameSlug = 'factor';
}
