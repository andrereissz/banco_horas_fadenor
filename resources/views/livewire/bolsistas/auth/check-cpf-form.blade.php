<div>
    <form wire:submit.prevent="checkCpf">
        @csrf
        <div>
            <x-input-label for="cpf" :value="'Digite o seu CPF'" />
            <div class="form-control w-full">

                <input type="text" id="cpf" name="cpf" wire:model.defer="cpf"
                    class="input input-bordered w-full @error('cpf') input-error @enderror" placeholder="000.000.000-00"
                    maxlength="14" required>
            </div>
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-accent">
                Continuar
            </button>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', {
                reverse: false
            });

            // Mantém apenas números no Livewire
            $('#cpf').on('blur', function() {
                let onlyNumbers = $(this).val().replace(/\D/g, '');
                @this.set('cpf', onlyNumbers);
            });
        });
    </script>
</div>
