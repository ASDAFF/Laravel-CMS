<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $model_slugs = config('cms.policies');
        $roles = [];
        $permissions = [];
        foreach($model_slugs as $model_slug)
        {
            $model_permissions = [];
            $model_permissions[] = Permission::updateOrCreate(['name' => $model_slug. '_index']);
            $model_permissions[] = Permission::updateOrCreate(['name' => $model_slug. '_view']);
            $model_permissions[] = Permission::updateOrCreate(['name' => $model_slug. '_create']);
            $model_permissions[] = Permission::updateOrCreate(['name' => $model_slug. '_update']);
            $model_permissions[] = Permission::updateOrCreate(['name' => $model_slug. '_delete']);

            $model_role = Role::updateOrCreate(['name' => $model_slug . '_manager']);
            $model_role->syncPermissions($model_permissions);
            $roles[] = $model_role->name;

            $permissions = array_merge($permissions, $model_permissions);
        }
        $role_manager = Role::updateOrCreate(['name' => 'manager']);
        $role_manager->syncPermissions($permissions);

        $admin_users = User::getAdminUsers();
        foreach($admin_users as $admin_user){
            $admin_user->syncRoles([$role_manager]);
        }
    }
}
