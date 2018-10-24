<?php

namespace Tests\Unit\Component\Middleware;

use App\Capture;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CaptureMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_captures_index()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('captures.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_captures_index()
    {
        $user = factory(User::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('display captures');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('captures.index'));

        $response->assertOk();
        $response->assertViewIs('pages.capture.index');
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_cant_access_capture_show_page()
    {
        $user = factory(User::class)->create();
        $capture = factory(Capture::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('captures.show', $capture->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_capture_show_page()
    {
        $user = factory(User::class)->create();
        $capture = factory(Capture::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('show captures');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('captures.show', $capture->id));

        $response->assertOk();
        $response->assertViewIs('pages.capture.show');
    }

    /**
     * @test
     * @return void
     */
    public function it_cant_access_capture_edit_page()
    {
        $user = factory(User::class)->create();
        $capture = factory(Capture::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('captures.edit', $capture->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_access_capture_edit_page()
    {
        $user = factory(User::class)->create();
        $capture = factory(Capture::class)->create();

        /** @var Role $role */
        $role = Role::findOrCreate('admin');

        /** @var Permission $permission */
        $permission = Permission::findOrCreate('edit capture');

        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $role = Role::findByName('admin');

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->get(route('captures.edit', $capture->id));

        $response->assertOk();
        $response->assertViewIs('pages.capture.edit');
    }
}