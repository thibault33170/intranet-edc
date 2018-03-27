<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Role $role */
        $role = Role::create(['name' => 'admin']);

        /** @var Permission $permission */
        $permission = Permission::create(['name' => 'edit articles']);

        factory(App\User::class, 50)->create()->each(function (User $user) use ($role, $permission) {
            $user->assignRole($role);
            $user->givePermissionTo($permission);
        });

        factory(App\Capture::class, 10 )->create();
    }
}
