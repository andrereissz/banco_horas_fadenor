<?php

namespace Tests\Unit\Services;

use App\Models\Bolsa;
use App\Models\Bolsista;
use App\Models\User;
use App\Services\AuthBolsistaServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthBolsistaServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected AuthBolsistaServiceInterface $authBolsistaService;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authBolsistaService = $this->app->make(AuthBolsistaServiceInterface::class);
        $this->user = User::factory()->create(['id' => 1]);

    }
    public function test_if_a_bolsista_can_register()
    {
        $bolsistaAttributes = Bolsista::factory()->make()->toArray();
        $bolsista = $this->authBolsistaService->register($bolsistaAttributes);

        $this->assertInstanceOf(Bolsista::class, $bolsista);
        $this->assertNotNull($bolsista->id);
        $this->assertEquals($bolsistaAttributes['nome'], $bolsista->nome);
        $this->assertEquals($bolsistaAttributes['email'], $bolsista->email);
        $this->assertEquals($bolsistaAttributes['cpf'], $bolsista->cpf);
        $this->assertEquals($bolsistaAttributes['data_nasc'], $bolsista->data_nasc);
        $this->assertEquals($bolsistaAttributes['rg'], $bolsista->rg);
        $this->assertEquals($bolsistaAttributes['rg_orgao'], $bolsista->rg_orgao);
        $this->assertEquals($bolsistaAttributes['rg_data_emissao'], $bolsista->rg_data_emissao);
        $this->assertEquals($bolsistaAttributes['titulo_eleitor'], $bolsista->titulo_eleitor);
        $this->assertEquals($bolsistaAttributes['titulo_zona'], $bolsista->titulo_zona);
        $this->assertEquals($bolsistaAttributes['titulo_secao'], $bolsista->titulo_secao);
        $this->assertEquals($bolsistaAttributes['certificado_reservista'], $bolsista->certificado_reservista);
    }

    public function test_if_a_bolsista_can_login()
    {
        $bolsista = Bolsista::factory()->create();

        $result = $this->authBolsistaService->login([
            'email' => $bolsista->email,
            'password' => 'password'
        ]);

        $this->assertTrue($result);
    }

    public function test_if_a_bolsista_can_logout()
    {
        $bolsista = Bolsista::factory()->create();

        /** @var \App\Models\Bolsista $bolsista */
        $this->actingAs($bolsista, 'bolsistas');
        $this->assertAuthenticated('bolsistas');

        $this->authBolsistaService->logout();
        $this->assertGuest('bolsistas');
    }
}
