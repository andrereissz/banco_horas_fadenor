<?php

namespace App\Services;

use App\Enums\BolsaStatus;
use App\Jobs\SendSolicitacaoMail;
use App\Models\Bolsa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BolsaService implements BolsaServiceInterface
{
    public function get(): Collection
    {
        return Bolsa::all();
    }

    public function find(string $uuid): Bolsa
    {
        return Bolsa::where('id', $uuid)->firstOrFail();
    }

    public function findBolsaByToken(string $token): ?Bolsa
    {
        return Bolsa::where('token', $token)->first();
    }

    public function create(array $data): Bolsa
    {
        return Bolsa::create($data);
    }

    public function update(Bolsa $bolsa, array $data): bool
    {
        return $bolsa->update($data);
    }

    public function delete(Bolsa $bolsa): bool
    {
        return $bolsa->delete();
    }

    public function updateStatus(Bolsa $bolsa, BolsaStatus $newStatus): bool
    {
        return $bolsa->update(['status' => $newStatus]);
    }

    public function solicitar(array $data): Bolsa
    {
        if (str_contains($data['valor'], ',')) {
            $data['valor'] = str_replace(',', '.', $data['valor']);
        }

        $bolsa = $this->create([
            'id' => Str::uuid(),
            'user_id' => isset($data['userId']) ? $data['userId'] : Auth::user()->id,
            'token' => Str::random(32),
            'projeto_cod' => $data['projetoCod'],
            'projeto_nome' => $data['projetoNome'],
            'projeto_num' => $data['projetoNum'],
            'tipo' => $data['tipo'],
            'data_inicio' => $data['dataInicio'],
            'data_fim' => $data['dataFim'],
            'valor' => (int) ((float) $data['valor'] * 100),
        ]);

        try {
            SendSolicitacaoMail::dispatch(
                Auth::user(),
                $bolsa,
                $this->formataText($data['nome']),
                $data['emailDestinatario']
            );
        } catch (\Exception $e) {
            throw $e;
        }

        return $bolsa;
    }

    public function uploadDocumentos(Bolsa $bolsa, array $data, array $files): void
    {
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $bolsa->documentos()->create([
                    'nome' => $file->getClientOriginalName(),
                    'caminho' => $file->store('documentos/'.$bolsa->id),
                    'tipo' => $data['tipo'],
                ]);
            }
        }
    }

    public function registrar(string $token, array $data, array $files): Bolsa
    {
        $bolsa = Bolsa::where('token', $token)->where('status', BolsaStatus::AguardandoResposta)->firstOrFail();
        $this->updateStatus($bolsa, BolsaStatus::Respondido);
        $this->uploadDocumentos($bolsa, $data, $files);

        return $bolsa;
    }

    public function formataText(string $text): string
    {
        return str::upper(str::slug($text, ' ', 'pt_BR'));
    }
}
