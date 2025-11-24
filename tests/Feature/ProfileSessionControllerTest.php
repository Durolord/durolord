<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mockery;
use Tests\TestCase;

class ProfileSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_logs_out_other_sessions_when_password_is_valid(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $guard = Mockery::mock(StatefulGuard::class);
        $guard->shouldReceive('logoutOtherDevices')->once()->with('password');

        $this->app->instance(StatefulGuard::class, $guard);

        $response = $this
            ->from('/profile')
            ->actingAs($user)
            ->delete(route('profile.sessions.destroy'), [
                'password' => 'password',
            ]);

        $response->assertRedirect('/profile');
        $response->assertSessionHas('status', 'sessions-terminated');
    }

    public function test_it_requires_a_valid_password_before_signing_out_other_sessions(): void
    {
        $user = User::factory()->create();

        $guard = Mockery::mock(StatefulGuard::class);
        $guard->shouldReceive('logoutOtherDevices')->never();

        $this->app->instance(StatefulGuard::class, $guard);

        $response = $this
            ->from('/profile')
            ->actingAs($user)
            ->delete(route('profile.sessions.destroy'), [
                'password' => 'invalid-password',
            ]);

        $response->assertRedirect('/profile');
        $response->assertSessionHasErrors('password', null, 'logoutOtherSessions');
    }

    public function test_it_removes_other_database_sessions_when_driver_is_database(): void
    {
        config(['session.driver' => 'database']);

        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        Session::setId('current-session-id');
        Session::start();

        DB::table('sessions')->insert([
            'id' => Session::getId(),
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
            'payload' => 'payload',
            'last_activity' => now()->timestamp,
        ]);

        DB::table('sessions')->insert([
            'id' => 'other-session-id',
            'user_id' => $user->id,
            'ip_address' => '192.168.1.10',
            'user_agent' => 'Safari on macOS',
            'payload' => 'payload',
            'last_activity' => now()->subMinute()->timestamp,
        ]);

        $guard = Mockery::mock(StatefulGuard::class);
        $guard->shouldReceive('logoutOtherDevices')->once()->with('password');

        $this->app->instance(StatefulGuard::class, $guard);

        $response = $this
            ->withCookie(config('session.cookie'), Session::getId())
            ->from('/profile')
            ->actingAs($user)
            ->delete(route('profile.sessions.destroy'), [
                'password' => 'password',
            ]);

        $response->assertRedirect('/profile');
        $response->assertSessionHas('status', 'sessions-terminated');

        $this->assertDatabaseHas('sessions', [
            'id' => Session::getId(),
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseMissing('sessions', [
            'id' => 'other-session-id',
            'user_id' => $user->id,
        ]);

        config(['session.driver' => 'array']);
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}
