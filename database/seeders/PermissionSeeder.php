<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = Role::create(['name' => 'admin']);
        $cashier = Role::create(['name' => 'cashier']);
        $waiter = Role::create(['name' => 'waiter']);
        $chef = Role::create(['name' => 'chef']);

        //permisos en las caegorias
        Permission::create(['name' => 'category.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'category.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'category.show'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'category.delete'])->syncRoles([$admin]);

        Permission::create(['name' => 'dish.create'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'dish.edit'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'dish.show'])->syncRoles([$admin, $cashier, $waiter, $chef]);
        Permission::create(['name' => 'dish.delete'])->syncRoles([$admin]);

        Permission::create(['name' => 'table.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'table.edit'])->syncRoles([$admin, $cashier, $waiter]);
        Permission::create(['name' => 'table.show'])->syncRoles([$admin, $cashier, $waiter]);
        Permission::create(['name' => 'table.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'sales.create'])->syncRoles([$admin, $waiter]);
        Permission::create(['name' => 'sales.edit'])->syncRoles([$admin, $cashier, $waiter]);
        Permission::create(['name' => 'sales.show'])->syncRoles([$admin, $cashier, $waiter, $chef]);
        Permission::create(['name' => 'sales.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'saledetail.create'])->syncRoles([$admin, $waiter]);
        Permission::create(['name' => 'saledetail.edit'])->syncRoles([$admin,  $waiter]);
        Permission::create(['name' => 'saledetail.show'])->syncRoles([$admin, $cashier, $waiter, $chef]);
        Permission::create(['name' => 'saledetail.delete'])->syncRoles([$admin]);

        Permission::create(['name' => 'ingredients.create'])->syncRoles([$admin,  $chef]);
        Permission::create(['name' => 'ingredients.edit'])->syncRoles([$admin,  $chef]);
        Permission::create(['name' => 'ingredients.show'])->syncRoles([$admin, $waiter, $chef]);
        Permission::create(['name' => 'ingredients.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'supplier.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'supplier.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'supplier.show'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'supplier.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'order.create'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'order.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'order.show'])->syncRoles([$admin, $chef]);
        Permission::create(['name' => 'order.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'orderdetail.create'])->syncRoles([$admin,  $chef]);
        Permission::create(['name' => 'orderdetail.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'orderdetail.show'])->syncRoles([$admin,  $chef]);
        Permission::create(['name' => 'orderdetail.delete'])->syncRoles([$admin]);


        Permission::create(['name' => 'user.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$admin, $cashier, $waiter, $chef]);
        Permission::create(['name' => 'user.show'])->syncRoles([$admin, $cashier, $waiter, $chef]);
        Permission::create(['name' => 'user.delete'])->syncRoles([$admin]);
    }
}
