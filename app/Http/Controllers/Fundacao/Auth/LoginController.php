<?php
namespace App\Http\Controllers\Fundacao\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('fundacao.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);

        if (Auth::guard('fundacao')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('fundacao.dashboard'));
        }

        return back()->withErrors(['email' => 'As credenciais não correspondem.'])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::guard('fundacao')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
