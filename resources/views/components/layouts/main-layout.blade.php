<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-layouts.partials.head :title="$title ?? ''" />

    <body class="bg-noir-deep flex overflow-hidden"
        x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
        @resize.window="if (window.innerWidth >= 1024) sidebarOpen = true"
    >

        @unless(Request::is('/')  || Request::is('register') || Request::is('email/verify'))
            <x-layouts.partials.sidebar-toggle />
            <x-ui.side-bar :active="$active ?? ''" />
        @endunless

        <main class="flex-1 h-screen overflow-y-auto">
            {{ $slot }}
        </main>

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>
</html>
