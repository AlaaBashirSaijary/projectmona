<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'api']);

        // إنشاء الصلاحيات
        $permissions = [
            'view HomeImage', 'create HomeImage', 'update HomeImage', 'delete HomeImage',
            'view post', 'create post', 'update post', 'delete post',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }

        // تعيين الصلاحيات لدور "admin"
        $adminPermissions = [
            'view HomeImage', 'create HomeImage', 'update HomeImage', 'delete HomeImage',
            'view post', 'create post', 'update post', 'delete post',
        ];

        foreach ($adminPermissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }

        // تعيين الصلاحيات لدور "user"
        $userPermissions = [
            'view post', 'create post', 'update post', 'delete post',
        ];

        foreach ($userPermissions as $permission) {
            $userRole->givePermissionTo($permission);
        }
    }
}
