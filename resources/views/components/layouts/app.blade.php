<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Sistema') }}</title>

    {{-- CSS e JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="min-h-screen text-base-content flex flex-col">
    {{ $slot }}
    @livewireScripts
</body>
</html>
