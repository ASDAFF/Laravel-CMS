<?php

namespace App\Enums;

use App\Base\BaseEnum;

final class UserStatus extends BaseEnum
{
    const data = [
		'1' => 'Verified',
		'2' => 'Pending',
		'3' => 'Blocked',
	];
}
