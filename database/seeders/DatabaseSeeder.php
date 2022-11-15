<?php

namespace Database\Seeders;

use App\Models\CashierSale;
use App\Models\Dish;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use App\Models\Table;
use App\Models\Category;
use App\Models\ChefSale;
use App\Models\Supplier;
use App\Models\Ingredient;
use App\Models\SaleDetail;
use App\Models\WaiterSale;
use App\Models\OrderDetail;
use App\Models\DishIngredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*     User::factory()->create([
            'email' => 'admin@admin.com',
            'password'=>Hash::make('password'),
        ]);
        User::factory(10)->create();
        Supplier::factory(5)->create();
        Category::factory(5)->create();
        Ingredient::factory(50)->create();
        Table::factory(20)->create();
        Dish::factory(50)->create();
        Order::factory(10)->create();
        OrderDetail::factory(50)->create();
        Sale::factory(50)->create();
        SaleDetail::factory(50)->create();
        DishIngredient::factory(50)->create();
        WaiterSale::factory(10)->create();
        ChefSale::factory(10)->create();
        CashierSale::factory(10)->create(); */



        /* $role = Role::create(['admin' => 'admin']);
        $permission = Permission::create(['name' => 'edit articles']); */
    }
}
