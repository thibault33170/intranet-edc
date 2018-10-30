<?php

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

        Permission::create(
            [
                "name" => "add benevole",
            ]
        );

        Permission::create(
            [
                "name" => "add capture",
            ]
        );

        Permission::create(
            [
                "name" => "add cat",
            ]
        );

        Permission::create(
            [
                "name" => "display benevoles",
            ]
        );

        Permission::create(
            [
                "name" => "display captures",
            ]
        );

        Permission::create(
            [
                "name" => "display cats",
            ]
        );

        Permission::create(
            [
                "name" => "show benevoles",
            ]
        );

        Permission::create(
            [
                "name" => "show captures",
            ]
        );

        Permission::create(
            [
                "name" => "show cats",
            ]
        );

        Permission::create(
            [
                "name" => "edit benevole",
            ]
        );

        Permission::create(
            [
                "name" => "edit capture",
            ]
        );

        Permission::create(
            [
                "name" => "edit cat",
            ]
        );

        $permissions = [
            'add benevole',
            'add capture',
            'add cat',
            'display benevoles',
            'display captures',
            'display cats',
            'show benevoles',
            'show captures',
            'show cats',
            'edit benevole',
            'edit capture',
            'edit cat',
        ];

        $role->givePermissionTo($permissions);

        /** @var \Illuminate\Database\Eloquent\Collection $users */
        $users = factory(App\User::class, 50)->create()->each(
            function (App\User $user) use ($role) {
                $user->assignRole($role);
            }
        );

        factory(App\Capture::class, 40)->create()->each(
            function (App\Capture $capture) use ($users) {
                $random = rand(0, 10);

                $sample = $users->random($random);

                $sample->each(
                    function (App\User $user) use($capture){
                        $capture->users()->attach($user->id);
                    }
                );
            }
        );

        factory(App\Cat::class, 50)->create();
    }
}
