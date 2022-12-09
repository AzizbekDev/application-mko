<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $supper_admin_permissions = Permission::all();

        Role::findOrFail(1)->permissions()->sync($supper_admin_permissions->pluck('id'));

        $admin_permissions = $supper_admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 11)!= 'permission_'
                && substr($permission->title, 0, 8) != 'profile_'
                && substr($permission->title, 0, 10)!= 'marketing_'
                && substr($permission->title, 0, 7) != 'brands_'
                && substr($permission->title, 0, 10) != 'merchants_'
                && substr($permission->title, 0, 9) != 'merchant_'
                && substr($permission->title, 0, 7) != 'report_'
                && substr($permission->title, 0, 12) != 'application_'
                && substr($permission->title, 0, 7) != 'client_'
                && substr($permission->title, 0, 4) != 'new_'
                && substr($permission->title, 0, 7) != 'viewed_'
                && substr($permission->title, 0, 9) != 'approved_'
                && substr($permission->title, 0, 9) != 'rejected_'
                && substr($permission->title, 0, 8) != 'blocked_';
        });
        Role::findOrFail(2)->permissions()->sync($admin_permissions);

        $user_permission = $supper_admin_permissions->filter(function ($permission){
            return $permission->title == 'profile_password_edit';
        });
        Role::findOrFail(3)->permissions()->sync($user_permission);
    }
}
