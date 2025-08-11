<form wire:submit.prevent="authenticate">
    @csrf
    <div href="/" class="flex flex-col gap-2 justify-center items-center">
        <a href="/" class="flex flex-col gap-2 justify-center items-center">
            <img src="{{ asset('storage/images/logo-oficial-fadenor.png') }}" alt="Logo Fadenor" class="h-24">
        </a>
        <h3 class="2xl font-bold">ACESSO COLABORADORES</h3>
        <div class="divider divider-vertical"></div>
    </div>
    <!-- Username -->
    <div>
        <x-input-label for="username" :value="'Usuário'" />
        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
            autofocus autocomplete="username" wire:model.defer="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="'Senha'" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" wire:model.defer="password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember"
                wire:model="remember">
            <span class="ms-2 text-sm text-gray-600">Manter-me conectado</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4 gap-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('fundacao.password.request') }}">
            Esqueceu a senha?
        </a>

        <button class="btn btn-primary w-1/4" type="submit">Login</button>
    </div>
</form>
