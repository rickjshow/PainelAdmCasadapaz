<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main>
            <div class="flex min-h-screen bg-gray-100">
                <!-- Menu Lateral -->
                <x-menu-lateral class="w-64 bg-gray-800 text-white" />

                <!-- Conteúdo da Página -->
                <div class="flex-1 p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
