<div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($clients as $client)
        <x-clients-card :id="$client->id" :client="$client->user->name" :email="$client->user->email" :phone="$client->phone"/>
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum cliente cadastrado ainda.</p>
        </div>
    @endforelse
</div>
