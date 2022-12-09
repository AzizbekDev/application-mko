<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions_list = [];
        $permissions = [
            'user_management_access',
            'permission_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'role_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'user_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'profile_password_edit',
            'setting_access',
            'setting_delete',
            'setting_show',
            'setting_edit',
            'setting_create',
            'application_access',
            'new_application_show',
            'viewed_application_show',
            'approved_application_show',
            'rejected_application_show',
            'blocked_application_show',
            'client_access',
            'client_show',
            'client_wallet_access',
            'client_wallet_show',
            'marketing_management_access',
            'brands_access',
            'brands_show',
            'merchants_access',
            'merchants_show',
            'merchant_periods_access',
            'merchant_periods_show',
            'report_access',
        ];
        foreach ($permissions as $key => $permission) {
            $permissions_list[] = [
                'id'    => $key+1,
                'title' => $permission
            ];
        }
        Permission::insert($permissions_list);
    }
}
