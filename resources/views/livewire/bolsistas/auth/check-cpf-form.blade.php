<div>
    <div class="flex flex-col gap-2 justify-center items-center">
        <a href="/" class="flex flex-col gap-2 justify-center items-center">
            <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        </a>
        <h3 class="2xl font-bold">CONFIRMAÇÃO DE BOLSA</h3>
        <div class="divider divider-vertical"></div>
    </div>
    <form wire:submit.prevent="checkCpf">
        @csrf
        <div>
            <x-input-label for="cpf" :value="'Informe o CPF'" />
            <x-inputs.input-cpf id="cpf" name="cpf" required wire:model.defer="cpf" required />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-accent">
                Continuar
            </button>
        </div>
    </form>
</div>
