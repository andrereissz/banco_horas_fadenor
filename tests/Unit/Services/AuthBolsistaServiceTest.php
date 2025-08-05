<?php

namespace Tests\Unit\Services;

use App\Models\Bolsista;
use App\Services\AuthBolsistaServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthBolsistaServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected AuthBolsistaServiceInterface $authBolsistaService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authBolsistaService = $this->app->make(AuthBolsistaServiceInterface::class);
    }

    public function test_if_a_bolsista_can_register()
    {
        $bolsista = $this->authBolsistaService->register([
            'nome' => $this->faker->name,
            'data_nasc' => $this->faker->date,
            'nome_mae' => $this->faker->name,
            'nome_pai' => $this->faker->name,
            'sexo' => 'M',
            'escolaridade' => rand(1, 12),
            'estado_civil' => rand(1, 7),
            'uf_nasc' => $this->faker->stateAbbr,
            'muni_nasc' => $this->faker->city,
            'raca_cor' => rand(1, 6),
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'logradouro' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => '',
            'bairro' => $this->faker->word,
            'uf_resid' => 'MG',
            'muni_resid' => 'Montes Claros',
            'cep' => $this->faker->postcode,
            'cpf' => $this->faker->unique()->cpf(false),
            'pis' => $this->faker->unique()->numerify('###########'),
            'rg' => $this->faker->unique()->numerify('#########'),
            'rg_orgao' => 'PC',
            'rg_orgao_uf' => 'MG',
            'rg_data_emissao' => $this->faker->date,
            'titulo_eleitor' => $this->faker->unique()->numerify('###########'),
            'titulo_zona' => $this->faker->numerify('####'),
            'titulo_secao' => $this->faker->numerify('####'),
            'certificado_reservista' => '',
            'password' => 'password'
        ]);

        $this->assertInstanceOf(\App\Models\Bolsista::class, $bolsista);
        $this->assertDatabaseHas('bolsistas', [
            'email' => $bolsista->email,
            'nome' => $bolsista->nome,
        ]);
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
}
