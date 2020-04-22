<?php

namespace App\Services;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
	public function run()
	{
		$models = config('cms.seeder');

	    foreach($models as $model) {
	    	$model_class_name = 'App\\Models\\' . ucfirst($model);
	    	$repository = new $model_class_name();
	    	if(! $repository->first()){
	        	factory('App\\Models\\' . ucfirst($model), 5)->create();
	        }
	    }
	}
}
