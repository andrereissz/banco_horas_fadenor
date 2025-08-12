<?php

namespace Tests\Unit\Services;

use App\Enums\BolsaStatus;
use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\Bolsista;
use App\Models\User;
use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BolsaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BolsaServiceInterface $bolsaService;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bolsaService = $this->app->make(BolsaServiceInterface::class);

        $this->user = User::factory()->create();
    }

    public function test_get_all_bolsas()
    {
        Bolsa::factory()->count(3)->create();

        $result = $this->bolsaService->get();

        $this->assertCount(3, $result);
        $this->assertInstanceOf(Bolsa::class, $result->first());
    }

    public function test_find_bolsa_by_uuid()
    {
        $bolsa = Bolsa::factory()->create();
        $result = $this->bolsaService->find($bolsa->id);

        $this->assertEquals($bolsa->id, $result->id);
    }

    public function test_find_bolsa_by_token()
    {
        $bolsa = Bolsa::factory()->create();
        $result = $this->bolsaService->findBolsaByToken($bolsa->token);

        $this->assertEquals($bolsa->id, $result->id);
    }

    public function test_create_bolsa()
    {
        Auth::expects('user')->andReturn($this->user);

        $data = [
            'user_id' => Auth::user()->id,
            'projeto_cod' => '111',
            'projeto_nome' => 'projeto teste',
            'projeto_num' => 'APQ-09512',
            'tipo' => 1,
            'data_inicio' => '2025-07-01',
            'data_fim' => '2026-07-01',
            'valor' => '100000',
        ];

        $bolsa = $this->bolsaService->create($data);

        $this->assertDatabaseHas('bolsas', [
            'id' => $bolsa->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_update_bolsa()
    {
        $bolsa = Bolsa::factory()->create([
            'projeto_nome' => 'Projeto Antigo',
        ]);

        $updated = $this->bolsaService->update($bolsa, ['projeto_nome' => 'Novo Nome']);

        $this->assertTrue($updated);
        $this->assertEquals('Novo Nome', $bolsa->fresh()->projeto_nome);
    }

    public function test_delete_bolsa()
    {
        $bolsa = Bolsa::factory()->create();

        $deleted = $this->bolsaService->delete($bolsa);

        $this->assertTrue($deleted);
        $this->assertModelMissing($bolsa);
    }

    public function test_update_status_bolsa()
    {
        $bolsa = Bolsa::factory()->create();

        $this->bolsaService->updateStatus($bolsa, BolsaStatus::Cadastrado);

        $this->assertEquals(BolsaStatus::Cadastrado, $bolsa->status);
    }

    public function test_solicitar_envia_email()
    {
        Mail::fake();

        $user = User::factory()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'userId' => Auth::user()->id,
            'nome' => 'Solicitação',
            'emailDestinatario' => 'coord@example.com',
            'projetoCod' => '111',
            'projetoNome' => 'projeto teste',
            'projetoNum' => 'APQ-09512',
            'tipo' => 1,
            'dataInicio' => '2025-07-01',
            'dataFim' => '2026-07-01',
            'valor' => '100000',
        ];

        $this->bolsaService->solicitar($data);

        Mail::assertSent(SolicitarBolsa::class);
    }

    public function test_binds_bolsa_to_bolsista()
    {
        $bolsista = Bolsista::factory()->create();

        $bolsa = Bolsa::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertEquals($bolsa->status, BolsaStatus::AguardandoResposta);

        $this->bolsaService->bind($bolsa, $bolsista);

        $this->assertEquals($bolsa->status, BolsaStatus::Respondido);
    }

    public function test_if_a_bolsista_can_retrieve_its_bolsas()
    {
        $bolsista = Bolsista::factory()->create();

        $bolsa = Bolsa::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->bolsaService->bind($bolsa, $bolsista);

        $this->assertEquals($bolsista->bolsas()->first()->id, $bolsa->id);
    }
}
