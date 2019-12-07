<?php

use App\Models\Feature;
use Illuminate\Database\Seeder;

class DefaultFeaturesTableSeeder extends Seeder
{
    public function run()
    {
        // title, description, icon, activated
        $features = [
            [
                'id' => 1,
                'title' => 'Feature Title 1',
                'icon' => 'ti-mobile',
                'description' => 'Feature Description 1, ti-mobile, Feature Description 1, ti-mobile, Feature Description 1, ti-mobile, Feature Description 1, ti-mobile, Feature Description 1, ti-mobile, ',
            ],
            [
                'id' => 2,
                'title' => 'Feature Title 2',
                'icon' => 'ti-money',
                'description' => 'Feature Description 2 - ti-money - Feature Description 2 - ti-money - Feature Description 2 - ti-money - Feature Description 2 - ti-money - Feature Description 2 - ti-money',
            ],
            [
                'id' => 3,
                'title' => 'Feature Title 3',
                'icon' => 'ti-settings',
                'description' => 'Feature description 3 - ti-settings, Feature description 3 - ti-settings, Feature description 3 - ti-settings, Feature description 3 - ti-settings, Feature description 3 - ti-settings',
            ],
        ];

        foreach($features as $feature){
            Feature::updateOrCreate(['id' => $feature['id']], $feature);
        }
    }
}
