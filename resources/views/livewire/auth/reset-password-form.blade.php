<div class="max-w-md mx-auto p-6 bg-base-100 rounded-box shadow">
    @if ($status)
        <div class="alert alert-success mb-4">
            {{ $status }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-4">Redefinir Senha</h2>

    <form wire:submit.prevent="resetPassword" class="space-y-4">
        <input type="hidden" wire:model="token" />

        <div>
            <label for="email" class="label">
                <span class="label-text">E-mail</span>
            </label>
            <input id="email" type="email" wire:model="email" placeholder="seu@email.com"
                   class="input input-bordered w-full" />
            @error('email')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password" class="label">
                <span class="label-text">Nova senha</span>
            </label>
            <input id="password" type="password" wire:model="password" placeholder="********"
                   class="input input-bordered w-full" />
            @error('password')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="label">
                <span class="label-text">Confirme a nova senha</span>
            </label>
            <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="********"
                   class="input input-bordered w-full" />
        </div>

        <button type="submit" class="btn btn-primary w-full">Redefinir senha</button>
    </form>
</div>
