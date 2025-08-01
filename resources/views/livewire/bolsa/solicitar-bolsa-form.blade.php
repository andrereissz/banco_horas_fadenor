<div>
    <form wire:submit.prevent="solicitarBolsa" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        @csrf
        <fieldset class="fieldset border border-gray-400 p-4 rounded-md md:col-span-2">
            <legend class="fieldset-legend font-semibold px-2">Tipo de Bolsa</legend>
            <div class="flex items-center gap-6">
                @foreach (app\Enums\BolsaTipo::cases() as $tipo)
                <div class="flex items-center gap-2">
                    <input id="tipo_{{ $tipo->label() }}" type="radio" value="{{ $tipo->value }}" wire:model.live="tipo"
                        name="tipo_bolsa_group" class="radio">
                    <label for="tipo_{{ $tipo->label() }} class="cursor-pointer">{{ $tipo->label() }}</label>
                </div>
                @endforeach
            </div>
            @error('tipo')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </fieldset>

        <fieldset class="fieldset border border-gray-400 p-4 rounded-md">
            <legend class="fieldset-legend font-semibold px-2">Dados do Projeto</legend>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="projetoCod" class="block mb-1">Código do Projeto</label>
                    <x-text-input id="projetoCod" type="text" class="input w-full" wire:model="projetoCod" />
                    @error('projetoCod')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="projetoNome" class="block mb-1">Nome do Projeto</label>
                    <x-text-input id="projetoNome" type="text" class="input w-full" wire:model="projetoNome" />
                    @error('projetoNome')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                @if ($this->tipo == app\Enums\BolsaTipo::FAPEMIG->value)
                    <div>
                        <label for="projetoNum" class="block mb-1">Número do Processo FAPEMIG</label>
                        <x-text-input id="projetoNum" type="text" class="input w-full"
                            wire:model="projetoNum" />
                        @error('projetoNum')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
            </div>
        </fieldset>

        <fieldset class="fieldset border border-gray-400 p-4 rounded-md">
            <legend class="fieldset-legend font-semibold px-2">Dados do Bolsista</legend>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="emailDestinatario" class="block mb-1">E-mail do
                        {{ $this->tipo != app\Enums\BolsaTipo::FAPEMIG->value ? 'Bolsista' : 'Coordenador' }}</label>
                    <x-text-input id="emailDestinatario" type="email" class="input w-full"
                        wire:model="emailDestinatario" />
                    @error('emailDestinatario')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="nome" class="block mb-1">Nome do Bolsista</label>
                    <x-text-input id="nome" type="text" class="input w-full" wire:model="nome" />
                    @error('nome')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="fieldset border border-gray-400 p-4 rounded-md md:col-span-2">
            <legend class="fieldset-legend font-semibold px-2">Dados da Bolsa</legend>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="valor" class="block mb-1">Valor da Bolsa</label>
                    <label class="input w-full">
                        <label for="valor">R$</label>
                        <input type="text" name="valor" id="valor" wire:model="valor">
                        @error('valor')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div>
                    <label for="dataInicio" class="block mb-1">Data de Início</label>
                    <input id="dataInicio" type="date" class="input w-full" wire:model="dataInicio" />
                    @error('dataInicio')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="dataTermino" class="block mb-1">Data de Término</label>
                    <input id="dataTermino" type="date" class="input w-full" wire:model="dataFim" />
                    @error('dataFim')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <div class="md:col-span-2">
            <button class="btn btn-accent w-1/4" type="submit">Solicitar</button>
        </div>
    </form>
</div>
