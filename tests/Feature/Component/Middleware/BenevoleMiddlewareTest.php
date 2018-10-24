<?php

namespace Tests\Unit\Component\Middleware;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BenevoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_benevoles_index()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('benevoles.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_benevoles_index()
    {
        $user = factory(User::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('display benevoles');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('benevoles.index'));

        $response->assertOk();
        $response->assertViewIs('pages.benevole.index');
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_benevole_show_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('benevoles.show', $user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_benevole_show_page()
    {
        $user = factory(User::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('show benevoles');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('benevoles.show', $user->id));

        $response->assertOk();
        $response->assertViewIs('pages.benevole.show');
    }

    /**
     * @test
     * @return void
     */
    public function it_cant_access_benevole_edit_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('benevoles.edit', $user->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_benevole_edit_page()
    {
        $user = factory(User::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('edit benevole');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('benevoles.edit', $user->id));

        $response->assertOk();
        $response->assertViewIs('pages.benevole.edit');
    }
}