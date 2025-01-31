<?php

$cms = [
    'config' => [
        'models_namespace' => 'App\Models\\',
    ],
    'migration' => [
        'user',
        'category',
        'activity',
        'address',
        'advertise',
        'basket',
        'block',
        'blog',
        'car',
        'cinema',
        'comment',
        'factor',
        'field',
        'file',
        'follow',
        'food',
        'food-program',
        'form',
        'answer',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'like',
        'module',
        'movie',
        'music',
        'notification',
        'page',
        'post',
        'product',
        'rate',
        'restaurant',
        'setting-general',
        'setting-contact',
        'setting-developer',
        'shop',
        'showtime',
        'story',
        'tag',
        'tagend',
        'tour',
        'travel',
    ],
	// 'factory' => [
 //        'address',
 //        'advertise',
 //        'answer',
 //        'block',
 //        'blog',
 //        'car',
 //        'category',
 //        'cinema',
 //        'comment',
 //        'factor',
 //        'field',
 //        'food',
 //        'food-program',
 //        'form',
 //        'gym',
 //        'gym-action',
 //        'gym-program',
 //        'home',
 //        'hotel',
 //        'module',
 //        'movie',
 //        'music',
 //        'page',
 //        'permission',
 //        'post',
 //        'product',
 //        'restaurant',
 //        'role',
 //        'shop',
 //        'showtime',
 //        'story',
 //        'tag',
 //        'tagend',
 //        'travel',
 //        'tour',
 //        'user',
 //    ],
    'seeder' => [
        'address',
        'advertise',
        'answer',
        'blog',
        'car',
        // 'category',
        'cinema',
        'factor',
        'field',
        'food',
        'food-program',
        'form',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'movie',
        'music',
        'post',
        'product',
        'restaurant',
        'shop',
        'showtime',
        'story',
        // 'tag',
        'tagend',
        'travel',
        'tour',
    ],
    'policies' => [
        'activity',
        'advertise',
        'answer',
        'address',
        'block',
        'blog',
        'car',
        'category',
        'cinema',
        'comment',
        'factor',
        'field',
        'file',
        'follow',
        'food',
        'food-program',
        'form',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'like',
        'module',
        'movie',
        'music',
        'notification',
        'page',
        'permission',
        'post',
        'product',
        'rate',
        'restaurant',
        'role',
        'shop',
        'showtime',
        'story',
        'tag',
        'tagend',
        'tour',
        'travel',
        'user',
    ],
    'admin_routes' => [
        'activity',
        'advertise',
        'address',
        'answer',
        'block',
        'blog',
        'car',
        'category',
        'cinema',
        'comment',
        'factor',
        'field',
        'file',
        'follow',
        'food',
        'food-program',
        'form',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'like',
        'module',
        'movie',
        'music',
        'notification',
        'page',
        'permission',
        'post',
        'product',
        'rate',
        'restaurant',
        'role',
        'shop',
        'showtime',
        'story',
        'tag',
        'tagend',
        'tour',
        'travel',
        'user',
    ],
    'api_routes' => [
        'advertise',
        'answer',
        'blog',
        'car',
        'cinema',
        'food',
        'food-program',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'movie',
        'music',
        'post',
        'product',
        'restaurant',
        'shop',
        'showtime',
        'story',
        'travel',
        'tour',
    ],
    'front_routes' => [
        'advertise',
        'blog',
        'car',
        'cinema',
        'food',
        'food-program',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'movie',
        'music',
        'post',
        'product',
        'restaurant',
        'shop',
        'showtime',
        'story',
        'travel',
        'tour',
        'user',
    ],
    'admin_tests' => [
        'address',
        'advertise',
        'answer',
        'block',
        'blog',
        'car',
        'category',
        'cinema',
        'comment',
        'factor',
        'field',
        'food',
        'food-program',
        'form',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'module',
        'movie',
        'music',
        'page',
        'permission',
        'post',
        'product',
        'restaurant',
        'role',
        'shop',
        'showtime',
        'story',
        'tag',
        'tagend',
        'tour',
        'travel',
        'user',
    ],
    'front_tests' => [
        'advertise',
        'blog',
        'car',
        'cinema',
        'food',
        'food-program',
        'gym',
        'gym-action',
        'gym-program',
        'home',
        'hotel',
        'movie',
        'music',
        'post',
        'product',
        'restaurant',
        'shop',
        'showtime',
        'story',
        'travel',
        'tour',
    ],
];

$cms['social_companies'] = [
    'GOOGLE',
    'TWITTER',
    'FACEBOOK',
    'LINKEDIN',
    'GITHUB',
    'GITLAB',
    'BITBUCKET',
];

foreach($cms['social_companies'] as $social_company){
    $cms[strtolower($social_company)] = [
        'client_id' => env($social_company . '_CLIENT_ID'),
        'client_secret' => env($social_company . '_CLIENT_SECRET'),
        'redirect' => env($social_company . '_CLIENT_CALLBACK'),
    ];
}

return $cms;
