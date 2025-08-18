<div class="card bg-base-100 w-full shadow-md p-4">
    <form wire:submit="updatePassword">
        @csrf
        <fieldset class="fieldset border border-gray-400 p-4 rounded-md md:col-span-2">
            <legend class="fieldset-legend font-semibold px-2">Alterar Senha</legend>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="password" class="block mb-1">Senha</label>
                    <input id="password" type="password" class="input" wire:model="password" />
                    @error('password')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-1">Confirmar Senha</label>
                    <input id="password_confirmation" type="password" class="input"
                        wire:model="password_confirmation" />
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <div class="md:col-span-2 mt-4">
            <button class="btn btn-accent w-1/4" type="submit">Alterar Senha</button>
        </div>
    </form>
</div>
