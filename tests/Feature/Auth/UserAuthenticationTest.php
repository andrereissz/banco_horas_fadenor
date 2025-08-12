<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected AuthServiceInterface $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->get('/fundacao/login');
        $this->authService = $this->app->make(AuthServiceInterface::class);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/fundacao/login');

        $response->assertStatus(200);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->authService->login([
            'username' => $user->username,
            'password' => 'wrong-password',
        ], false);

        $this->assertGuest();
    }

    public function test_users_can_login(): void
    {
        $user = User::factory()->create();
        $result = $this->authService->login([
            'username' => $user->username,
            'password' => 'password',
        ], false);

        $this->assertAuthenticated();
        $this->assertTrue($result);
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/fundacao/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
