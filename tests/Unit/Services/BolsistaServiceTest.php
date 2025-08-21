<?php

namespace Tests\Feature;

use App\Models\Bolsista;
use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BolsistaServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected BolsistaServiceInterface $bolsistaService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bolsistaService = $this->app->make(BolsistaServiceInterface::class);
    }

    public function test_if_bolsistas_can_be_found()
    {
        Bolsista::factory()->count(3)->create();

        $bolsistas = $this->bolsistaService->get();

        $this->assertCount(3, $bolsistas);
        $this->assertInstanceOf(Bolsista::class, $bolsistas->first());
    }

    public function test_if_a_bolsista_can_be_found_by_cpf()
    {
        $bolsista = Bolsista::factory()->create();

        $found = $this->bolsistaService->find($bolsista->cpf);

        $this->assertEquals($bolsista->id, $found->id);
        $this->assertDatabaseHas('bolsistas', ['cpf' => $bolsista->cpf]);
    }

    public function test_if_a_bolsista_can_be_edited()
    {
        $bolsista = Bolsista::factory()->create();

        $data = [
            'nome' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telefone' => $this->faker->phoneNumber(),
        ];

        $updated = $this->bolsistaService->update($bolsista, $data);

        $this->assertTrue($updated);
        $this->assertDatabaseHas('bolsistas', $data);
    }

    public function test_if_a_bolsista_can_be_deleted()
    {
        $bolsista = Bolsista::factory()->create();

        $deleted = $this->bolsistaService->delete($bolsista);

        $this->assertTrue($deleted);
        $this->assertModelMissing($bolsista);
    }
}
