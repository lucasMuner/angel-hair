<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($clients as $client)
        <x-client.card :id="$client->id" :client="$client->user->name" :email="$client->user->email" :phone="$client->phone"/>
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum cliente cadastrado ainda.</p>
        </div>
    @endforelse
</div>
