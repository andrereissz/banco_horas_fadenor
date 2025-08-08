<div class="max-w-md mx-auto p-6 bg-base-100 rounded-box shadow">
    @if ($status)
        <div class="alert alert-success mb-4">
            {{ $status }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-4">Recuperar Senha</h2>

    <form wire:submit.prevent="sendResetLink" class="space-y-4">
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

        <button type="submit" class="btn btn-primary w-full">Enviar link de redefinição</button>
    </form>
</div>
