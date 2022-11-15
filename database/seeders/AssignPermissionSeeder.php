<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_admin = User::find(1);
        $user_cashier = User::find(2);
        $user_waiter = User::find(3);
        $user_chef = User::find(4);

        $role_admin = Role::find(1);
        $role_cashier = Role::find(2);
        $role_waiter = Role::find(3);
        $role_chef = Role::find(4);


        $user_admin->assignRole($role_admin);
        $user_cashier->assignRole($role_cashier);
        $user_waiter->assignRole($role_waiter);
        $user_chef->assignRole($role_chef);
    }
}
