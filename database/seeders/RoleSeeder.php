<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name'=> 'admin']);
        $user = Role::create(['name'=> 'user']);

        $recycling_confirm = Permission::create(['name' => 'recycling confirm']);
        $payment_confirm = Permission::create(['name' => 'payment confirm']);

        $admin->givePermissionTo($recycling_confirm);
        $recycling_confirm->assignRole($admin);

        $admin->givePermissionTo($payment_confirm);
        $payment_confirm->assignRole($admin);
    }
}
