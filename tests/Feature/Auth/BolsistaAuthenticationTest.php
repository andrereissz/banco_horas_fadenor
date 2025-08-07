<?php

namespace Tests\Feature\Auth;

use App\Models\Bolsista;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BolsistaAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected AuthServiceInterface $authService;

    public function setUp(): void
    {
        parent::setUp();
        $this->get('/bolsistas/login');
        $this->authService = $this->app->make(AuthServiceInterface::class);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/bolsistas/login');

        $response->assertStatus(200);
    }

    public function test_bolsistas_can_not_authenticate_with_invalid_password(): void
    {
        $bolsista = Bolsista::factory()->create();

        $this->authService->login([
            'cpf' => $bolsista->cpf,
            'password' => 'wrong-password'
        ], false);

        $this->assertGuest();
    }



    public function test_bolsistas_can_login(): void
    {
        $bolsista = Bolsista::factory()->create();

        $this->authService->login([
            'cpf' => $bolsista->cpf,
            'password' => 'password'
        ], false);

        $this->assertAuthenticated('bolsistas');
    }

    public function test_users_can_logout(): void
    {
        /** @var \App\Models\Bolsista $bolsista */
        $bolsista = Bolsista::factory()->create();

        $this->authService->login([
            'cpf' => $bolsista->cpf,
            'password' => 'password'
        ], false);

        $this->actingAs($bolsista)->post('/bolsistas/logout');

        $this->assertGuest();
    }
}
