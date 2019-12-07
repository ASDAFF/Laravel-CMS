<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class EricServicesTableSeeder extends Seeder
{
    public function run()
    {
        // title, description, image, activated
        $services = [
            [
            	'id' => 1,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-1.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 2,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-2.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 3,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-3.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 4,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-4.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 5,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-5.jpg',
            	'activated' => 1,
            ],
            [
            	'id' => 6,
            	'title' => '',
            	'description' => '',
            	'image' => 'storage/files/shares/synergypower/app-6.jpg',
            	'activated' => 1,
            ],
        ];

        foreach($services as $service){
            Service::updateOrCreate(['id' => $service['id']], $service);
        }
    }
}
