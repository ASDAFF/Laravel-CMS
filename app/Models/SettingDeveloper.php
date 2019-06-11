<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingDeveloper extends Model
{
    use SoftDeletes;

    public $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    public $columns = [
        [
            'name' => 'cdn_url',
            'type' => 'string',
            'form_type' => '',
        ],
        [
            'name' => 'throttle',
            'type' => 'string',
            'form_type' => '',
        ],
        [
            'name' => 'app_debug',
            'type' => 'boolean',
            'form_type' => 'checkbox',
        ],
        [
            'name' => 'lazy_loading',
            'type' => 'boolean',
            'form_type' => 'checkbox',
        ],
        [
            'name' => 'app_env',
            'type' => 'boolean',
            'form_type' => 'switch-bootstrap-m',
        ],
        [
            'name' => 'email_username',
            'type' => 'string',
            'form_type' => '',
        ],
        [
            'name' => 'email_password',
            'type' => 'string',
            'form_type' => '',
        ],
        [
            'name' => 'email_defult_subject',
            'type' => 'string',
            'form_type' => '',
        ],
        [
            'name' => 'email_defult_ccc',
            'type' => 'string',
            'form_type' => '',
        ],
    ];

    public function getColumns()
    {
        return $this->columns;
    }
}
