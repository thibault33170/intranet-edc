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
    public function run() {
        /** @var Role $role */
        $role = Role::create(['name' => 'admin']);

        Permission::create([
            "name" => "add benevole"
        ]);

        Permission::create([
            "name" => "add capture"
        ]);

        Permission::create([
            "name" => "add cat"
        ]);

        Permission::create([
            "name" => "display benevoles"
        ]);

        Permission::create([
            "name" => "display captures"
        ]);

        Permission::create([
            "name" => "display cats"
        ]);

        $permissions = [
            'add benevole',
            'add capture',
            'add cat',
            'display benevoles',
            'display captures',
            'display cats',
        ];

        $role->givePermissionTo($permissions);

        factory(App\User::class, 200)->create()->each(
            function (User $user) use ($role) {
                $user->assignRole($role);
            }
        );

        factory(App\Capture::class, 40)->create();

        factory(App\Cat::class, 50)->create();
    }
}
