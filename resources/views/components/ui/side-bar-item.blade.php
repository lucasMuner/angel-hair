@props([
    'href' => '',
    'active' => '',
    'module' => '',
    'name' => '',
    'icon' => '',
])

<a href="{{ $href }}"
    @class([
        'flex items-center gap-3 px-4 py-2 rounded-lg text-lg font-medium transition hover:bg-goldenrod-10',
        'text-goldenrod bg-goldenrod-10' => $active === $module,
        'text-champagne' => $active !== $module,
    ])>
    <i class="{{ $icon }}"></i> {{ $name }}
</a>
