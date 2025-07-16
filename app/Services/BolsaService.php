<?php

namespace App\Services;

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
        return Bolsa::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data): Bolsa
    {
        $data['uuid'] = Str::uuid();
        $data['user_id'] = Auth::user()->id;
        $bolsa = Bolsa::create(
            [
                'uuid' => $data['uuid'],
                'user_id' => $data['user_id'],
                'nome' => $data['nome'],
                'token' => $data['token']
            ]
        );

        return $bolsa;
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

    public function solicitar(array $data, array $files): Bolsa
    {
        $bolsa = $this->create(array(
            'nome' => $data['nome'],
            'token' => Str::uuid(),
        ));

        Mail::to($data['emailCoordenador'])->send(new SolicitarBolsa($bolsa, $files));

        return $bolsa;
    }

    public function registrar(array $data, array $files): Bolsa
    {
        $bolsa = $this->create($data);
        $this->updateStatus($bolsa, 1);
        foreach ($files as $file) {
            if($file instanceof UploadedFile){
                $bolsa->documentos()->create([
                    'nome' => $file->getClientOriginalName(),
                    'caminho' => $file->store('documentos/'.$bolsa->id)
                ]);
            }
        }

        return $bolsa;
    }
}
