<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(TagsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        $models = [
            'Blog', 'Page',
        ];

        foreach($models as $model) {
            factory('App\\Models\\' . $model, 8)->create();
        }
    }
}
