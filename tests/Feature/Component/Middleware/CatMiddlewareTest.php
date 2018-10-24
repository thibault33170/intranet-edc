<?php

namespace Tests\Unit\Component\Middleware;

use App\Cat;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CatMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_cats_index()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('cats.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_cats_index()
    {
        $user = factory(User::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('display cats');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('cats.index'));

        $response->assertOk();
        $response->assertViewIs('pages.cat.index');
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_cat_show_page()
    {
        $user = factory(User::class)->create();
        $cat = factory(Cat::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('cats.show', $cat->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_cat_show_page()
    {
        $user = factory(User::class)->create();
        $cat = factory(Cat::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('show cats');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('cats.show', $cat->id));

        $response->assertOk();
        $response->assertViewIs('pages.cat.show');
    }

    /**
     * @test
     * @return void
     */
    public function it_cant_access_cat_edit_page()
    {
        $user = factory(User::class)->create();
        $cat = factory(Cat::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('cats.edit', $cat->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_cat_edit_page()
    {
        $user = factory(User::class)->create();
        $cat = factory(Cat::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('edit cat');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('cats.edit', $cat->id));

        $response->assertOk();
        $response->assertViewIs('pages.cat.edit');
    }
}