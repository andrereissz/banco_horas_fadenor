<div class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto"> {{-- Adicionado um container principal --}}
    <div class="flex flex-col gap-2 justify-center items-center">
        <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        <h3 class="2xl font-bold">FORMULÁRIO DE CADASTRO</h3>
        <div class="divider divider-vertical"></div>
    </div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Prezado(a) Bolsista</h1>
        <p class="text-base-content/70">Preencha os campos obrigatórios (*) e revise seus dados antes de salvar.</p>
    </div>

    <form wire:submit="registrar">
        @csrf

        <div class="flex flex-col gap-4">
            {{-- DADOS DE LOGIN --}}
            <fieldset class="grid grid-cols-1 md:grid-cols-3 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Dados de Login</legend>
                <div class="col-span-1">
                    <x-input-label for="cpf" class="label"><span class="label-text">CPF *</span></x-input-label>
                    <x-inputs.input-cpf id="cpf" name="cpf" required wire:model="cpf" />
                    @error('cpf')
                        <x-input-error :messages="$errors->get('cpf')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label for="password" class="label"><span class="label-text">Senha *</span></x-input-label>
                    <input class="input input-bordered w-full" type="password" id="password" name="password" required
                        wire:model="password" />
                    @error('password')
                        <x-input-error :messages="$errors->get('password')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label for="password_confirmation" class="label"><span class="label-text">Confirmar Senha
                            *</span></x-input-label>
                    <input class="input input-bordered w-full" type="password" id="password_confirmation"
                        name="password_confirmation" required wire:model="password_confirmation" />
                    @error('password_confirmation')
                        <x-input-error :messages="$errors->get('password_confirmation')" />
                    @enderror
                </div>
            </fieldset>

            {{-- DADOS BÁSICOS --}}
            <fieldset class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Dados Básicos</legend>
                <div class="col-span-1 md:col-span-3 lg:col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome Completo *</span></x-input-label>
                    <x-text-input type="text" name="nome" required wire:model="nome" />
                    @error('nome')
                        <x-input-error :messages="$errors->get('nome')" />
                    @enderror
                </div>

                <div class="col-span-1 md:col-span-3 lg:col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome da Mãe *</span></x-input-label>
                    <x-text-input type="text" wire:model="nomeMae" required />
                    @error('nomeMae')
                        <x-input-error :messages="$errors->get('nomeMae')" />
                    @enderror
                </div>

                <div class="col-span-1 md:col-span-3 lg:col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome do Pai</span></x-input-label>
                    <input type="text" class="input input-bordered w-full" wire:model="nomePai" required>
                    @error('nomePai')
                        <x-input-error :messages="$errors->get('nomePai')" />
                    @enderror
                </div>

                <div class="col-span-1 flex justify-start items-center">
                    <input type="checkbox" class="checkbox" name="remember" wire:model.live="flag_estrangeiro">
                    <span class="ms-2 text-sm text-gray-600">Estrangeiro</span>
                </div>

                @switch($flag_estrangeiro)
                    @case(1)
                        <div class="col-span-1 md:col-span-2 lg:col-span-1">
                            <x-input-label for="paisNasc" class="label"><span class="label-text">País de Nascimento *</span></x-input-label>
                            <x-inputs.select-pais id="paisNasc" wire:model="paisNasc" required />
                            @error('paisNasc')
                                <x-input-error :messages="$errors->get('paisNasc')" />
                            @enderror
                        </div>
                    @break

                    @default
                        <div class="col-span-1 md:col-span-2 lg:col-span-1">
                            <x-input-label for="ufNasc" class="label"><span class="label-text">UF de Nascimento *</span></x-input-label>
                            <x-inputs.select-uf id="ufNasc" wire:model="ufNasc" required />
                            @error('ufNasc')
                                <x-input-error :messages="$errors->get('ufNasc')" />
                            @enderror
                        </div>
                @endswitch

                <div class="col-span-1 md:col-span-3 lg:col-span-2">
                    <x-input-label class="label"><span class="label-text">Município de Nascimento *</span></x-input-label>
                    <x-text-input type="text" wire:model="muniNasc" required />
                    @error('muniNasc')
                        <x-input-error :messages="$errors->get('muniNasc')" />
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Data de Nascimento *</span></x-input-label>
                    <x-text-input type="date" wire:model="dataNasc" required />
                    @error('dataNasc')
                        <x-input-error :messages="$errors->get('dataNasc')" />
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Sexo *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model.live="sexo" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                    @error('sexo')
                        <x-input-error :messages="$errors->get('sexo')" />
                    @enderror
                </div>

                <div class="col-span-1 lg:col-span-2">
                    <x-input-label class="label"><span class="label-text">Escolaridade *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model="escolaridade" required>
                        <option value=0 disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaEscolaridade::cases() as $tipo)
                            <option value={{ $tipo->value }}>{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('escolaridade')
                        <x-input-error :messages="$errors->get('escolaridade')" />
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Estado Cívil *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model="estadoCivil" required>
                        <option value=0 disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaEstadoCivil::cases() as $tipo)
                            <option value={{ $tipo->value }}>{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('estadoCivil')
                        <x-input-error :messages="$errors->get('estadoCivil')" />
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Raça / Cor *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model="racaCor" required>
                        <option value=0 disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaRacaCor::cases() as $tipo)
                            <option value={{ $tipo->value }}>{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('racaCor')
                        <x-input-error :messages="$errors->get('racaCor')" />
                    @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <x-input-label class="label"><span class="label-text">Telefone *</span></x-input-label>
                    <x-inputs.input-telefone id="telefone" wire:model="telefone" required />
                    @error('telefone')
                        <x-input-error :messages="$errors->get('telefone')" />
                    @enderror
                </div>


                <div class="col-span-1 md:col-span-3">
                    <x-input-label class="label"><span class="label-text">E-mail *</span></x-input-label>
                    <x-text-input type="email" wire:model="email" required />
                    @error('email')
                        <x-input-error :messages="$errors->get('email')" />
                    @enderror
                </div>
            </fieldset>

            {{-- ENDEREÇO --}}
            <fieldset class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Endereço de Residência</legend>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">CEP *</span></x-input-label>
                    <x-text-input id="cep" type="text" maxlength="9" required data-cep wire:model.blur="cep"
                        wire:blur="buscarCep" placeholder="Ex.: 00000-000" />
                    <x-input-error :messages="$errors->get('cep')" class="mt-2" />

                    @error('bairro')
                        <x-input-error :messages="$errors->get('bairro')" />
                    @enderror
                </div>
                <div class="col-span-1 md:col-span-2 lg:col-span-2">
                    <x-input-label class="label"><span class="label-text">Logradouro *</span></x-input-label>
                    <x-text-input id="logradouro" type="text" value="{{ $logradouro }}" wire:model="logradouro"
                        required />
                    @error('logradouro')
                        <x-input-error :messages="$errors->get('logradouro')" />
                    @enderror
                </div>
                <div class="col-span-1 md:col-span-3 lg:col-span-2">
                    <x-input-label class="label"><span class="label-text">Bairro *</span></x-input-label>
                    <x-text-input id="bairro" type="text" value="{{ $bairro }}" wire:model="bairro" required />
                    @error('bairro')
                        <x-input-error :messages="$errors->get('bairro')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Número *</span></x-input-label>
                    <x-text-input id="numero" type="text" wire:model="numero" data-digits required />
                    @error('numero')
                        <x-input-error :messages="$errors->get('numero')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Complemento</span></x-input-label>
                    <x-text-input id="complemento" type="text" value="{{ $complemento }}" wire:model="complemento" />
                    @error('complemento')
                        <x-input-error :messages="$errors->get('complemento')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label for="ufResid" class="label"><span class="label-text">UF *</span></x-input-label>
                    <x-inputs.select-uf id="ufResid" value="{{ $ufResid }}" wire:model.live="ufResid" required />
                    @error('ufResid')
                        <x-input-error :messages="$errors->get('ufResid')" />
                    @enderror
                </div>
                <div class="col-span-1 md:col-span-2">
                    <x-input-label for="muniResid" class="label"><span class="label-text">Município *</span></x-input-label>
                    <x-text-input id="muniResid" type="text" value="{{ $muniResid }}" wire:model.live="muniResid" required />
                    @error('muniResid')
                        <x-input-error :messages="$errors->get('muniResid')" />
                    @enderror
                </div>
            </fieldset>

            {{-- DOCUMENTAÇÃO --}}
            <fieldset class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Documentação</legend>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">PIS</span></x-input-label>
                    <x-text-input type="text" wire:model="pis" data-digits placeholder="Ex.: 11122233344" />
                    @error('pis')
                        <x-input-error :messages="$errors->get('pis')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">RG *</span></x-input-label>
                    <x-text-input type="text" wire:model="rg" required data-alnum placeholder="Ex.: MG12345678" />
                    @error('rg')
                        <x-input-error :messages="$errors->get('rg')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgOrgao"><span class="label-text">Órgão Expedidor *</span></x-input-label>
                    <x-text-input type="text" id="rgOrgao" wire:model="rgOrgao" required placeholder="Ex.: SSP" />
                    @error('rgOrgao')
                        <x-input-error :messages="$errors->get('rgOrgao')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgOrgaoUf"><span class="label-text">UF *</span></x-input-label>
                    <x-inputs.select-uf id="rgOrgaoUf" wire:model="rgOrgaoUf" required />
                    @error('rgOrgaoUf')
                        <x-input-error :messages="$errors->get('rgOrgaoUf')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgDataEmissao"><span class="label-text">Data de Expedição *</span></x-input-label>
                    <x-text-input type="date" id="rgDataEmissao" wire:model="rgDataEmissao" required />
                    @error('rgDataEmissao')
                        <x-input-error :messages="$errors->get('rgDataEmissao')" />
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">TÍTULO DE ELEITOR</span></x-input-label>
                    <x-text-input type="text" wire:model="tituloEleitor" data-digits maxlength="12"
                        placeholder="Ex.: 123456789012" />
                    @error('tituloEleitor')
                        <x-input-error :messages="$errors->get('tituloEleitor')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="tituloZona"><span class="label-text">ZONA</span></x-input-label>
                    <x-text-input type="text" id="tituloZona" wire:model="tituloZona" data-digits maxlength="3"
                        placeholder="Ex.: 123" />
                    @error('tituloZona')
                        <x-input-error :messages="$errors->get('tituloZona')" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="tituloSecao"><span class="label-text">SEÇÃO</span></x-input-label>
                    <x-text-input type="text" id="tituloSecao" wire:model="tituloSecao" data-digits maxlength="4"
                        placeholder="Ex.: 0123" />
                    @error('tituloSecao')
                        <x-input-error :messages="$errors->get('tituloSecao')" />
                    @enderror
                </div>
                @if ($sexo == 'M')
                    <div class="col-span-1">
                        <x-input-label class="label"><span class="label-text">CERTIFICADO DE RESERVISTA</span></x-input-label>
                        <x-text-input type="text" wire:model="certificadoReservista" data-digits maxlength="11"
                            placeholder="Ex.: 12345678901" />
                        @error('certificadoReservista')
                            <x-input-error :messages="$errors->get('certificadoReservista')" />
                        @enderror
                    </div>
                @endif
            </fieldset>
        </div>

        <div class="mt-6 flex justify-end">
            <button class="btn btn-accent w-full sm:w-auto sm:btn-wide" type="submit">Cadastrar</button>
        </div>
    </form>

    {{-- OVERLAY DE LOADING GLOBAL (qualquer ação Livewire) --}}
    <div wire:loading.delay.short class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
        aria-live="polite" aria-busy="true">
        <div
            class="bg-base-100/90 border border-base-200 rounded-2xl shadow-xl px-6 py-5 flex flex-col items-center gap-3">
            <span class="loading loading-spinner loading-lg"></span>
            <p class="text-base-content/80 text-sm">Carregando, por favor aguarde…</p>
        </div>
    </div>
</div>
