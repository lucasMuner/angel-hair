<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($services as $service)
        <x-service.card
            :id="$service->id"
            :name="$service->name"
            :description="$service->description"
            :price="$service->price"
            :duration="$service->duration"
        />
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum serviço cadastrado ainda.</p>
        </div>
    @endforelse
</div>
