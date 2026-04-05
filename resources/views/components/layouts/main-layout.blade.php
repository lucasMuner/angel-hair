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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="bg-[#2F4F4F] flex overflow-hidden"
        x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
        @resize.window="if (window.innerWidth >= 1024) sidebarOpen = true"
    >

        @if(!Request::is('/'))
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden fixed top-4 left-4 z-50 w-10 h-10 flex items-center justify-center rounded-full text-goldenrod text-lg"
                style="background-color: #1a3333; border: 2px solid #DAA520;"
            >
                <i class="fa-solid" :class="sidebarOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
            <div
                x-cloak
                x-show="sidebarOpen"
                @click="sidebarOpen = false"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="lg:hidden fixed inset-0 bg-black/50 z-30"
                style="display: none;"
            ></div>

            <x-ui.side-bar :active="$active ?? ''" />
        @endif

        <main class="flex-1 h-screen overflow-y-auto">
            {{ $slot }}
        </main>

        @livewireScripts

    </body>
</html>
