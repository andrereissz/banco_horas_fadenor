<?php

namespace App\Http\Controllers\Fundacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('fundacao.profile.edit', [
            'user' => $request->user('fundacao'), // Pega o usuário do guarda correto
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user('fundacao');
        // Adicione aqui a lógica de validação e atualização do perfil
        $user->fill($request->validated());
        $user->save();
        return Redirect::route('fundacao.profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        // Adicione aqui a lógica para apagar o perfil
        return Redirect::to('/');
    }
}
