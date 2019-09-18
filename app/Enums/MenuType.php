<?php

namespace App\Enums;

use App\Base\BaseEnum;

final class MenuType extends BaseEnum
{
    const data = [
		'1' => 'top-menu',
		'2' => 'footer-menu',
		'3' => 'side-menu',
	];
}
