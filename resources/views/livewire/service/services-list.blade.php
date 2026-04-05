<div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($services as $service)
        <x-service.card :id="$service->id" :name="$service->name" :description="$service->description" :price="$service->price"/>
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum serviço cadastrado ainda.</p>
        </div>
    @endforelse
</div>
