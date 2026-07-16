<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($roles as $role)
        <x-role.card
            :id="$role->id"
            :name="$role->name"
            :description="$role->description"
        />
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhuma função cadastrada ainda.</p>
        </div>
    @endforelse
</div>
