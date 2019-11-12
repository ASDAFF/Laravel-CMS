<?php

namespace App\Models;

use App\Base\BaseModel;

class Feedback extends BaseModel
{
    public $columns = [
        ['name' => 'title'],
        ['name' => 'full_name'],
        ['name' => 'image'],
        ['name' => 'description'],
        ['name' => 'activated'],
    ];
}
