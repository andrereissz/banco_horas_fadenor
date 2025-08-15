{{-- resources/views/livewire/bolsistas/cadastro-form.blade.php --}}
<div class="md:fit lg:w-4xl">
    <div class="flex flex-col gap-2 justify-center items-center">
            <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        <h3 class="2xl font-bold">FORMULÁRIO DE CADASTRO</h3>
        <div class="divider divider-vertical"></div>
    </div>
    {{-- Cabeçalho --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Prezado(a) Bolsista</h1>
        <p class="text-base-content/70">Preencha os campos obrigatórios (*) e revise seus dados antes de salvar.</p>
    </div>

    <form wire:submit.prevent="submit" class="space-y-8" aria-live="polite">
        <div class="flex flex-col gap-4">
            {{-- DADOS DE LOGIN --}}
            <fieldset class="grid grid-cols-3 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Dados de Login</legend>
                <div class="col-span-1">
                    <x-input-label for="cpf" class="label"><span class="label-text">CPF *</span></x-input-label>
                    <x-inputs.input-cpf id="cpf" name="cpf" required wire:model.defer="cpf" />
                    @error('cpf')
                        <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label for="password" class="label"><span class="label-text">Senha *</span></x-input-label>
                    <x-text-input type="password" id="password" name="password" required wire:model.defer="password" />
                    @error('password')
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label for="password_confirmation" class="label"><span class="label-text">Confirmar Senha *</span></x-input-label>
                    <x-text-input type="password" id="password_confirmation" name="password_confirmation" required wire:model.defer="password_confirmation" />
                    @error('password_confirmation')
                        <x-input-error :messages="$errors->get('password_confirmation')"/>
                    @enderror
                </div>
            </fieldset>
            {{-- DADOS BÁSICOS --}}
            <fieldset class="grid grid-cols-5 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Dados Básicos</legend>
                <div class="col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome Completo *</span></x-input-label>
                    <x-text-input type="text" name="nome" required wire:model.defer="nome" />
                    @error('nome')
                        <x-input-error :messages="$errors->get('nome')"/>
                    @enderror
                </div>

                <div class="col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome da Mãe *</span></x-input-label>
                    <input type="text" class="input input-bordered w-full" wire:model.defer="nomeMae" required>
                    @error('nomeMae')
                        <x-input-error :messages="$errors->get('nomeMae')"/>
                    @enderror
                </div>

                <div class="col-span-5">
                    <x-input-label class="label"><span class="label-text">Nome do Pai</span></x-input-label>
                    <input type="text" class="input input-bordered w-full" wire:model.defer="nomePai" required>
                    @error('nomePai')
                        <x-input-error :messages="$errors->get('nomePai')"/>
                    @enderror
                </div>

                <div class="col-span-1 flex justify-start items-center">
                    <input type="checkbox"
                        class="checkbox"
                        name="remember" wire:model.live="flag_estrangeiro">
                    <span class="ms-2 text-sm text-gray-600">Estrangeiro</span>
                </div>

                @switch($flag_estrangeiro)
                    @case(1)
                        <div class="col-span-1">
                            <x-input-label for="paisNasc" class="label"><span class="label-text">País de Nascimento *</span></x-input-label>
                            <x-inputs.select-pais id="paisNasc" wire:model.defer="paisNasc" required />
                            @error('paisNasc')
                                <x-input-error :messages="$errors->get('paisNasc')"/>
                            @enderror
                        </div>
                    @break

                    @default
                        <div class="col-span-1">
                            <x-input-label for="ufNasc" class="label"><span class="label-text">UF de Nascimento *</span></x-input-label>
                            <x-inputs.select-uf id="ufNasc" wire:model.defer="ufNasc" required />
                            @error('ufNasc')
                                <x-input-error :messages="$errors->get('ufNasc')"/>
                            @enderror
                        </div>
                @endswitch

                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">Município de Nascimento *</span></x-input-label>
                    <input type="text" class="input input-bordered w-full" wire:model.defer="muniNasc" required>
                    @error('muniNasc')
                        <x-input-error :messages="$errors->get('muniNasc')"/>
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Data de Nascimento *</span></x-input-label>
                    <x-text-input type="date" class="input input-bordered w-full" wire:model.defer="dataNasc" required />
                    @error('dataNasc')
                        <x-input-error :messages="$errors->get('dataNasc')"/>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Sexo *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model.defer="sexo" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                    @error('sexo')
                        <x-input-error :messages="$errors->get('sexo')"/>
                    @enderror
                </div>

                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">Escolaridade *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model.defer="escolaridade" required>
                        <option value="" disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaEscolaridade::cases() as $tipo)
                            <option value="{{ $tipo->value }}">{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('escolaridade')
                        <x-input-error :messages="$errors->get('escolaridade')"/>
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Estado Cívil *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model.defer="escolaridade" required>
                        <option value="" disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaEstadoCivil::cases() as $tipo)
                            <option value="{{ $tipo->value }}">{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('estadoCivil')
                        <x-input-error :messages="$errors->get('estadoCivil')"/>
                    @enderror
                </div>

                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Raça / Cor *</span></x-input-label>
                    <select class="select select-bordered w-full" wire:model.defer="escolaridade" required>
                        <option value="" disabled selected>Selecione</option>
                        @foreach (App\Enums\BolsaRacaCor::cases() as $tipo)
                            <option value="{{ $tipo->value }}">{{ $tipo->label() }}</option>
                        @endforeach
                    </select>
                    @error('racaCor')
                        <x-input-error :messages="$errors->get('racaCor')"/>
                    @enderror
                </div>

                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">Telefone *</span></x-input-label>
                    <x-inputs.input-telefone id="telefone" wire:model.defer="telefone" required />
                    @error('telefone')
                        <x-input-error :messages="$errors->get('telefone')"/>
                    @enderror
                </div>


                <div class="col-span-3">
                    <x-input-label class="label"><span class="label-text">E-mail *</span></x-input-label>
                    <input type="email" class="input input-bordered w-full" wire:model.defer="email" required>
                    @error('email')
                        <x-input-error :messages="$errors->get('email')"/>
                    @enderror
                </div>
            </fieldset>

            {{-- ENDEREÇO --}}
            <fieldset class="grid grid-cols-5 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Endereço de Residência</legend>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">CEP *</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" maxlength="9" required data-cep wire:model.defer="cep" />
                    @error('bairro')
                        <x-input-error :messages="$errors->get('bairro')"/>
                    @enderror
                </div>
                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">Logradouro *</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" wire:model.defer="logradouro" required />
                    @error('logradouro')
                        <x-input-error :messages="$errors->get('logradouro')"/>
                    @enderror
                </div>
                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">Bairro *</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" wire:model.defer="bairro" required />
                    @error('bairro')
                        <x-input-error :messages="$errors->get('bairro')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Número *</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" wire:model.defer="numero" data-digits required />
                    @error('numero')
                        <x-input-error :messages="$errors->get('numero')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label"><span class="label-text">Complemento</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" wire:model.defer="complemento" />
                    @error('complemento')
                        <x-input-error :messages="$errors->get('complemento')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                            <x-input-label for="ufResid" class="label"><span class="label-text">UF de Residência *</span></x-input-label>
                            <x-inputs.select-uf id="ufResid" wire:model.defer="ufResid" required />
                            @error('ufResid')
                                <x-input-error :messages="$errors->get('ufResid')"/>
                            @enderror
                        </div>
                <div class="col-span-2">
                    <x-input-label for="muniResid" class="label"><span class="label-text">Município de Residência *</span></x-input-label>
                    <x-text-input id="muniResid" type="text" class="input input-bordered w-full" wire:model.defer="muniResid" required />
                    @error('muniResid')
                        <x-input-error :messages="$errors->get('muniResid')"/>
                    @enderror
                </div>
            </fieldset>

            <fieldset class="grid grid-cols-5 gap-4 fieldset border border-gray-400 p-4 rounded-md">
                <legend class="fieldset-legend font-semibold px-2">Documentação</legend>
                <div class="col-span-2">
                    <x-input-label class="label"><span class="label-text">RG (SOMENTE LETRAS E NÚMEROS) *</span></x-input-label>
                    <x-text-input type="text" class="input input-bordered w-full" wire:model.defer="rg" required data-alnum />
                    @error('rg')
                        <x-input-error :messages="$errors->get('rg')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgOrgao"><span class="label-text">Órgão Expedidor *</span></x-input-label>
                    <x-text-input type="text" id="rgOrgao" class="input input-bordered w-full" wire:model.defer="rgOrgao" required />
                    @error('rgOrgao')
                        <x-input-error :messages="$errors->get('rgOrgao')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgOrgaoUf"><span class="label-text">UF *</span></x-input-label>
                    <x-inputs.select-uf  id="rgOrgaoUf" wire:model.defer="rgOrgaoUf" required />
                    @error('rgOrgaoUf')
                        <x-input-error :messages="$errors->get('rgOrgaoUf')"/>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-input-label class="label" for="rgDataExpedicao"><span class="label-text">Data de Expedição *</span></x-input-label>
                    <x-text-input type="date" id="rgDataExpedicao" class="input input-bordered w-full" wire:model.defer="rgDataExpedicao" required />
                    @error('rgDataExpedicao')
                        <x-input-error :messages="$errors->get('rgDataExpedicao')"/>
                    @enderror
                </div>
            </fieldset>
        </div>
    </form>

    {{-- OVERLAY DE LOADING GLOBAL (qualquer ação Livewire) --}}
    <div wire:loading class="fixed inset-0 z-50 bg-base-100/80 backdrop-blur-sm flex items-center justify-center">
        <div class="bg-base-100 border border-base-200 shadow-xl rounded-2xl p-8 flex flex-col items-center">
            <span class="loading loading-spinner loading-lg"></span>
            <p class="mt-4 text-base-content/80">Carregando, por favor aguarde…</p>
        </div>
    </div>
</div>
