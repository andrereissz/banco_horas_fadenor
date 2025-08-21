<div>
    @foreach ($documentosNecessarios as $tipo)
        {{ $tipo }}
    @endforeach
    <div class="mb-4">
        <h3 class="text-2xl font-semibold mb-4">Confirmação de Vínculo à Bolsa</h3>
        <h2>Prezado(a) {{ auth('bolsistas')->user()->nome }}</h2>
        <h2>Confirme o seu vínculo a bolsa do projeto - <strong>{{ $bolsa['projeto_nome'] }}</strong> - anexando os
            documentos abaixo:</h2>
    </div>

    <form wire:submit="confirmar" class="space-y-6">
        {{-- Agora o loop é sobre os casos do Enum --}}
        @foreach ($documentosNecessarios as $tipo)
            <div class="border p-4 rounded-lg">
                {{-- O label vem do método que criamos no Enum --}}
                <label for="{{ $tipo->name }}"
                    class="block text-sm font-medium text-gray-700">{{ $tipo->label() }}</label>

                {{-- O wire:model usa o NOME do caso do Enum (TERMO_BOLSA, etc.) --}}
                <input id="{{ $tipo->name }}" type="file" wire:model="documentos.{{ $tipo->name }}"
                    class="file-input file-input-bordered w-full mt-2" required>

                {{-- Barra de progresso --}}
                <div wire:loading wire:target="documentos.{{ $tipo->name }}" class="mt-2">
                    <progress class="progress progress-info w-full"></progress>
                </div>

                {{-- Preview e botão de remover --}}
                @if (isset($documentos[$tipo->name]))
                    <div class="mt-2 text-sm text-gray-600 flex items-center justify-between">
                        <span>{{ $documentos[$tipo->name]->getClientOriginalName() }}</span>
                        <button type="button" wire:click="$removeUpload('documentos.{{ $tipo->name }}')"
                            class="btn btn-xs btn-ghost text-red-500">Remover</button>
                    </div>
                @endif

                {{-- Erro de validação --}}
                @error("documentos.{$tipo->name}")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">
                Enviar Documentos
            </button>
        </div>
    </form>
</div>
