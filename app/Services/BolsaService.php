<?php

namespace App\Services;

use App\Jobs\SendSolicitacaoMail;
use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function updateStatus(Bolsa $bolsa, int $newStatus): bool
    {
        return $bolsa->update(['status' => $newStatus]);
    }

    public function solicitar(array $data, array $uploadedFiles): Bolsa
    {
        $temporaryPaths = [];
        $bolsa = $this->create([
            'id' => Str::uuid(),
            'user_id' => isset($data['user_id']) ? $data['user_id'] : Auth::user()->id,
            'token' => Str::uuid(),
            'projeto_cod' => $data['projeto_cod'],
            'projeto_nome' => $data['projeto_nome'],
            'projeto_num' => $data['projeto_num'],
            'tipo' => $data['tipo'],
            'nome' => $data['nome'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim']
        ]);

        foreach ($uploadedFiles as $uploadedFile) {
            if ($uploadedFile instanceof UploadedFile) {
                $temporaryPaths[] = Storage::disk('tmp')->putFile('uploads', $uploadedFile);
            }
        }

        try {
            SendSolicitacaoMail::dispatch(
                Auth::user(),
                $bolsa,
                $data['emailCoordenador'],
                $temporaryPaths
            );
        } catch (\Exception $e) {
            throw $e;
        }

        return $bolsa;
    }

    public function registrar(string $token, array $data, array $files): Bolsa
    {
        $bolsa = Bolsa::where('token', $token)->firstOrFail();
        $this->update($bolsa, $data);
        $this->updateStatus($bolsa, 1);
        foreach ($files as $file) {
            if($file instanceof UploadedFile){
                $bolsa->documentos()->create([
                    'nome' => $file->getClientOriginalName(),
                    'caminho' => $file->store('documentos/'.$bolsa->id),
                    'tipo' => $data['tipo']
                ]);
            }
        }

        return $bolsa;
    }
}
