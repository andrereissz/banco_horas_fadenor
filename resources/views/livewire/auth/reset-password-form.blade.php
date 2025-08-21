<div>
    <div href="/" class="flex flex-col gap-2 justify-center items-center">
        <a href="/" class="flex flex-col gap-2 justify-center items-center">
            <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        </a>
        <h3 class="2xl font-bold">REDEFINIÇÃO DE SENHA</h3>
        <div class="divider divider-vertical"></div>
    </div>
    <form wire:submit="resetPassword">
        <div>
            <x-input-label for="password" :value="'Nova Senha'" />
            <div class="w-full">
                <label class="input input-bordered flex items-center gap-2 w-full">
                    <input id="password" name="password" type="{{ $type }}" class="grow"
                        wire:model.live="password" autocomplete="new-password" />
                    <div class="btn btn-ghost btn-square btn-sm" wire:click="togglePasswordVisibility">
                        @switch($type)
                            @case('password')
                                <x-icons.eye-slash-icon />
                            @break

                            @default
                                <x-icons.eye-icon />
                        @endswitch
                    </div>
                </label>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />
            <x-text-input type="password" id="password_confirmation" name="password_confirmation"
                wire:model.live="password_confirmation" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-accent">
                Alterar Senha
            </button>
        </div>
    </form>
</div>
