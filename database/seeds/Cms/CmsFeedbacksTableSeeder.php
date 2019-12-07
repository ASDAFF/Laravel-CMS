<?php

use Illuminate\Database\Seeder;
use App\Models\Feedback;

class CmsFeedbacksTableSeeder extends Seeder
{
    public function run()
    {
        $feedbacks = [
            [
            	'id' => 1,
            	'title' => '',
            	'full_name' => '#13 Customer',
            	'description' => '“ I really love this cms because its really the best cms I ever seen. ”',
            	'image' => 'images/front/themes/1-original/client-1.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 2,
            	'title' => 'Chief Technology Officer',
            	'full_name' => 'Farid Sh',
            	'description' => '“ I developed this cms and all of its features with a very very clean code who you can not ignore it, all of the packages that used is the best packages and the basic classes are developed with full design patterns. ”',
            	'image' => 'images/front/themes/1-original/client-4.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 3,
            	'title' => '#4 Customer',
            	'full_name' => 'Client 3',
            	'description' => '“ I did not see a developer like Farid, he is awsome in coding! ”',
            	'image' => 'images/front/themes/1-original/client-3.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 4,
            	'title' => 'Manager',
            	'full_name' => 'Client 4',
            	'description' => '“ This CMS is made by a lot of experiences and efforts. ”',
            	'image' => 'images/front/themes/1-original/client-2.jpg',
            	'activated' => 1,
            ],
        ];

        foreach($feedbacks as $feedback){
            Feedback::updateOrCreate(['id' => $feedback['id']], $feedback);
        }
    }
}
