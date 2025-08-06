<?php

namespace App\Http\Controllers\Bolsista\Auth;

use App\Http\Controllers\Controller;
use App\Services\bolsistas\Services\AuthBolsistaService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected AuthBolsistaService $authBolsistaService){}

    public function create()
    {
        return view('bolsista.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(['cpf' => ['required', 'max:11'], 'password' => ['required']]);

        $bolsista = $this->authBolsistaService->login($credentials, bool);


    }
}
