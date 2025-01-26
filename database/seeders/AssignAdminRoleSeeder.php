<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class AssignAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // البحث عن المستخدم الذي تريد تعيينه كـ admin
        $user = User::where('email', 'admin@gmail.com')->first();

        if ($user) {
            // البحث عن دور "admin"
            $adminRole = Role::where('name', 'admin')->first();

            if ($adminRole) {
                // تعيين دور "admin" للمستخدم
                $user->assignRole($adminRole);
                $this->command->info('Admin role assigned to user: ' . $user->email);
            } else {
                $this->command->error('Admin role not found!');
            }
        } else {
            $this->command->error('User not found!');
        }
    }
}
