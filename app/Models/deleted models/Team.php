<?php

namespace App\Models;

use App\Services\BaseModel;

class Team extends BaseModel
{
    public $columns = [
        ['name' => 'title'],
        ['name' => 'full_name'],
        ['name' => 'image'],
        ['name' => 'description'],
        ['name' => 'activated'],
        ['name' => 'language'],
    ];
}
