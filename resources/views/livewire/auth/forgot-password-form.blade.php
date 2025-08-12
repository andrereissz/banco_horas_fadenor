<div>
    <div href="/" class="flex flex-col gap-2 justify-center items-center">
        <a href="/" class="flex flex-col gap-2 justify-center items-center">
            <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        </a>
        <h3 class="2xl font-bold">RECUPERAÇÃO DE SENHA</h3>
        <div class="divider divider-vertical"></div>
    </div>
    <form wire:submit.prevent="sendResetLink">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" wire:model.defer="email" required autofocus
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 gap-3">
            <button class="btn btn-accent" wire:loading.attr="disabled" wire:target="sendResetLink">
                Recuperar Senha
            </button>

            <div wire:loading wire:target="sendResetLink" class="flex items-center gap-2 text-primary">
                <span class="loading loading-spinner loading-sm"></span>
                <span class="text-sm">Enviando...</span>
            </div>
        </div>
    </form>
</div>
