<?php

namespace App\Policies;

use App\Services\BasePolicy;

class ModulePolicy extends BasePolicy
{
	public string $modelNameSlug = 'module';
}
