<?php

namespace Tests\Unit\Services;

use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\User;
use App\Services\BolsaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class BolsaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BolsaService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BolsaService();
        User::factory()->create();
    }

    public function test_get_all_bolsas()
    {
        Bolsa::factory()->count(3)->create();

        $result = $this->service->get();

        $this->assertCount(3, $result);
        $this->assertInstanceOf(Bolsa::class, $result->first());
    }

    public function test_find_bolsa_by_uuid()
    {
        $bolsa = Bolsa::factory()->create();
        $result = $this->service->find($bolsa->id);

        $this->assertEquals($bolsa->id, $result->id);
    }

    public function test_find_bolsa_by_token()
    {
        $bolsa = Bolsa::factory()->create();
        $result = $this->service->findBolsaByToken($bolsa->token);

        $this->assertEquals($bolsa->id, $result->id);
    }

    public function test_create_bolsa()
    {
        $user = User::factory()->create();
        Auth::expects('user')->andReturn($user);

        $data = [
            'user_id' => Auth::user()->id,
            'nome' => 'Nome da Bolsa',
            'token' => 'abc123',
            'projeto_cod' => '111',
            'projeto_nome' => 'projeto teste',
            'projeto_num' => 'APQ-09512',
            'tipo' => 1,
            'data_inicio' => '2025-07-01',
            'data_fim' => '2026-07-01'
        ];

        $bolsa = $this->service->create($data);

        $this->assertDatabaseHas('bolsas', [
            'id' => $bolsa->id,
            'user_id' => $user->id,
            'nome' => 'Nome da Bolsa',
            'token' => 'abc123',
        ]);
    }

    public function test_update_bolsa()
    {
        $bolsa = Bolsa::factory()->create([
            'nome' => 'Antigo Nome',
        ]);

        $updated = $this->service->update($bolsa, ['nome' => 'Novo Nome']);

        $this->assertTrue($updated);
        $this->assertEquals('Novo Nome', $bolsa->fresh()->nome);
    }

    public function test_delete_bolsa()
    {
        $bolsa = Bolsa::factory()->create();

        $deleted = $this->service->delete($bolsa);

        $this->assertTrue($deleted);
        $this->assertModelMissing($bolsa);
    }

    public function test_update_status_bolsa()
    {
        $bolsa = Bolsa::factory()->create();

        $this->service->updateStatus($bolsa, 1);

        $this->assertEquals(1, $bolsa->status);
    }

    public function test_solicitar_envia_email()
    {
        Mail::fake();

        $user = User::factory()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'user_id' => Auth::user()->id,
            'nome' => 'Solicitação',
            'emailCoordenador' => 'coord@example.com',
            'projeto_cod' => '111',
            'projeto_nome' => 'projeto teste',
            'projeto_num' => 'APQ-09512',
            'tipo' => 1,
            'data_inicio' => '2025-07-01',
            'data_fim' => '2026-07-01'
        ];

        $files = [UploadedFile::fake()->create('documento.pdf')];

        $this->service->solicitar($data, $files);

        Mail::assertSent(SolicitarBolsa::class);
        $this->assertDatabaseHas('bolsas', ['nome' => 'Solicitação']);
    }

    public function test_registrar_bolsa_com_documentos()
    {
        Storage::fake('local');
        $user = User::factory()->create();
        Auth::shouldReceive('user')->andReturn($user);
        $bolsa = Bolsa::factory()->create();
        $data = [
            'nome_mae' => 'Maria',
            'nome_pai' => 'João',
            'estado_civil' => 1,
            'raca_cor' => 1,
            'tipo' => "teste",
        ];

        $files = [UploadedFile::fake()->create('arquivo1.pdf')];
        $bolsa = $this->service->registrar($bolsa->token, $data, $files);

        $this->assertDatabaseHas('bolsas', ['nome' => $bolsa->nome, 'status' => 1]);
        $this->assertDatabaseCount('documentos', 1);

        Storage::assertExists($bolsa->documentos->first()->caminho);
    }
}
