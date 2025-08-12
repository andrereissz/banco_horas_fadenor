<div class="w-full">
    <label class="input input-bordered flex items-center gap-2 w-full hover:cursor-pointer">
        <input type="{{ $type }}" required class="grow" />
        <div class="btn btn-ghost btn-square btn-sm" wire:click="togglePasswordVisibility">
            @switch($type)
                @case('password')
                    <x-icons.eye-slash-icon />
                @break

                @default
                    <x-icons.eye-icon />
                @break
            @endswitch
        </div>
    </label>
</div>
