<div class="mb-10">
    <h3 class="text-xl font-semibold text-champagne mb-4">Nossos Serviços</h3>

    <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-goldenrod scrollbar-track-noir-card">

    @forelse($services as $service)
            <div class="snap-start flex-shrink-0 w-96 rounded-xl overflow-hidden bg-noir-card border border-gold-soft hover:border-goldenrod hover:-translate-y-1 transition-all cursor-pointer">
                <div class="w-full h-64 bg-noir-deep flex items-center justify-center overflow-hidden">
                    @if($service->image)
                        <img
                            src="{{ Storage::url($service->image) }}"
                            alt="{{ $service->name }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <i class="fa-solid fa-scissors text-6xl text-goldenrod/40"></i>
                    @endif
                </div>
                <div class="p-6 text-center">
                    <p class="text-champagne font-medium text-2xl truncate">{{ $service->name }}</p>
                </div>
            </div>
        @empty
            <p class="text-muted text-sm">Nenhum serviço cadastrado.</p>
        @endforelse
    </div>
</div>
