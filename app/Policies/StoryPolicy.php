<?php

namespace App\Policies;

use App\Services\BaseAuthPolicy;

class StoryPolicy extends BaseAuthPolicy
{
	public $modelNameSlug = 'story';
}
