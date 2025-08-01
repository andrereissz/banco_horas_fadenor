<div>
    <form wire:submit.prevent="solicitarBolsa" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
        @csrf
        <fieldset class="fieldset border border-gray-400 p-4 rounded-md md:col-span-2">
            <legend class="fieldset-legend font-semibold px-2">Tipo de Bolsa</legend>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <input id="tipo_fadenor" type="radio" value="0" wire:model.live="tipo"
                        name="tipo_bolsa_group" class="radio">
                    <label for="tipo_fadenor" class="cursor-pointer">FADENOR</label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="tipo_fapemig" type="radio" value="1" wire:model.live="tipo"
                        name="tipo_bolsa_group" class="radio">
                    <label for="tipo_fapemig" class="cursor-pointer">FAPEMIG</label>
                </div>
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
                    <x-text-input id="projetoCod" type="text" class="input w-full" wire:model.live="projetoCod" />
                    @error('projetoCod')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="projetoNome" class="block mb-1">Nome do Projeto</label>
                    <x-text-input id="projetoNome" type="text" class="input w-full" wire:model.live="projetoNome" />
                    @error('projetoNome')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                @if ($this->tipo === 1)
                    <div>
                        <label for="projetoNum" class="block mb-1">Número do Processo FAPEMIG</label>
                        <x-text-input id="projetoNum" type="text" class="input w-full"
                            wire:model.live="projetoNum" />
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
                        {{ $this->tipo === 0 ? 'Bolsista' : 'Coordenador' }}</label>
                    <x-text-input id="emailDestinatario" type="email" class="input w-full"
                        wire:model.live="emailDestinatario" />
                    @error('emailDestinatario')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="nome" class="block mb-1">Nome do Bolsista</label>
                    <x-text-input id="nome" type="text" class="input w-full" wire:model.live="nome" />
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
                        <input type="text" name="valor" id="valor" wire:model.live="valor">
                        @error('valor')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div>
                    <label for="dataInicio" class="block mb-1">Data de Início</label>
                    <input id="dataInicio" type="date" class="input w-full" wire:model.live="dataInicio" />
                    @error('dataInicio')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="dataTermino" class="block mb-1">Data de Término</label>
                    <input id="dataTermino" type="date" class="input w-full" wire:model.live="dataFim" />
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
