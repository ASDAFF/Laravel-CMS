<?php

namespace App\Models;

use App\Base\BaseModel;

class SettingDeveloper extends BaseModel
{
    public $columns = [
        [
            'name' => 'app_debug',
            'type' => 'boolean',
            'rule' => 'boolean',
            'form_type' => 'checkbox',
            'help' => 'Users can see error with details.',
        ],
        [
            'name' => 'app_env',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'Select Production always.',
            'form_type' => 'enum',
            'form_enum_class' => 'AppEnvType',
        ],
        [
            'name' => 'app_language',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
            'form_type' => '',
            'help' => 'Specify application language.',
        ],  
        [
            'name' => 'theme',
            'type' => 'string',
            'rule' => 'required',
            'form_type' => 'enum',
            'form_enum_class' => 'ThemeType',
            'help' => 'Select theme',
        ],
        [
            'name' => 'direction',
            'type' => 'string',
            'rule' => 'required',
            'form_type' => 'enum',
            'form_enum_class' => 'DirectionType',
            'help' => 'Select direction for texts',
        ],        
        [
            'name' => 'throttle',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'help' => 'Stop users who is requesting alot to server.',
            'database' => 'nullable',
        ],
        [
            'name' => 'lazy_loading',
            'type' => 'boolean',
            'rule' => 'boolean',
            'form_type' => 'checkbox',
            'help' => 'Lazy loading is neccessary for fast website initial loading.',
        ],
        [
            'name' => 'email_username',
            'type' => 'string',
            'rule' => 'email',
            'form_type' => '',
            'help' => 'email that is used for sending emails to users.',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_password',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'help' => 'email password that is used for sending emails to users.',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_default_subject',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_default_ccc',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'scripts',
            'type' => 'text',
            'rule' => '',
            'form_type' => 'textarea',
            'database' => 'nullable',
        ],
        [
            'name' => 'seo_title_min',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'seo_title_max',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'seo_url_max',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'seo_url_regex',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
    ];
}
