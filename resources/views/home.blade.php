    <!DOCTYPE html>
    <html lang="pt-BR" data-theme="light">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Escolher Tipo de Login</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover"
        style="background-image: url('{{ asset('storage/images/background-fadenor.png') }}')">
        <div class="min-h-screen min-w-screen flex justify-start items-center pt-20 pl-30">
            <div class="max-w-xl w-full">
                <div class="hero rounded-box bg-base-100 shadow-xl">
                    <div class="hero-content flex-col gap-10 p-8">

                        <div class="text-center lg:text-left">
                            <h1 class="text-2xl font-bold">Sistema de Monitoramento de Bolsas</h1>
                            <h2>Escolha o tipo de acesso</h2>
                        </div>

                        <div class="card gap-4 bg-base-100 w-full max-w-sm">
                            {{-- Fundação --}}
                            <a href="{{ route('fundacao.login') }}" class="btn btn-primary btn-lg w-full" wire:navigate
                                data-turbo="false">
                                Fundação
                            </a>

                            {{-- Bolsista --}}
                            <a href="{{ route('bolsistas.login') }}" class="btn btn-success btn-lg w-full" wire:navigate
                                data-turbo="false">
                                Bolsista
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @livewireScripts
        </body>

    </html>
