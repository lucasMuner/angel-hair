<button
    @click="sidebarOpen = !sidebarOpen"
    class="lg:hidden fixed top-4 left-4 z-50 w-10 h-10 flex items-center justify-center rounded-full text-goldenrod text-lg bg-noir-surface border-2 border-goldenrod text-goldenrod"
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
