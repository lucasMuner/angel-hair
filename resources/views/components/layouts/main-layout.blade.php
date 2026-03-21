<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="/assets/img/favicon.png">

        <title>{{ "Angel Hair" . ($title ? " | $title" : "") }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="bg-[#2F4F4F] flex overflow-hidden">

        @if(!Request::is('/'))
            <x-side-bar :active="$active ?? ''" />
        @endif

        <main class="flex-1 h-screen overflow-y-auto">
            {{ $slot }}
        </main>

        @livewireScripts

    </body>
</html>
