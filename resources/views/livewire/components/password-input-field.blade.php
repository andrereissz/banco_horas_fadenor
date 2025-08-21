<div class="w-full">
    <label class="input input-bordered flex items-center gap-2 w-full">
        <input id="password" name="password" type="{{ $type }}" class="grow" wire:model.live="value"
            autocomplete="new-password" />
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
