<?php

namespace App\Http\Controllers;

use App\Services\BolsaService;
use Illuminate\Http\Request;

class BolsaController extends Controller
{
    protected $bolsaService;

    public function __construct()
    {
        $this->bolsaService = new BolsaService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bolsas = $this->bolsaService->get();
        return view('dashboard', compact('bolsas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bolsas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function solicitar(Request $request)
    {
        $this->bolsaService->solicitar($request->all(), $request->allFiles());
        return redirect()->route('bolsas.index');
    }

    public function registrar(Request $request)
    {
        $this->bolsaService->registrar($request->token ,$request->all(), $request->allFiles());
        return redirect()->route('bolsas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bolsa = $this->bolsaService->find($id);
        return view('bolsas.show', compact('bolsa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bolsa = $this->bolsaService->find($id);
        return view('bolsas.edit', compact('bolsa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bolsa = $this->bolsaService->find($id);
        $this->bolsaService->update($bolsa, $request->all());
        return redirect()->route('bolsas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bolsa = $this->bolsaService->find($id);
        $this->bolsaService->delete($bolsa);
        return redirect()->route('bolsas.index');
    }
}
