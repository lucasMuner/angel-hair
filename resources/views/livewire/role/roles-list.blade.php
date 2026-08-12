<div class="mx-4 mb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
        @forelse($roles as $role)
            <x-role.card
                :id="$role->id"
                :name="$role->name"
                :description="$role->description"
            />
        @empty
            <div class="col-span-4 text-center py-8">
                <p class="text-champagne">Nenhuma função encontrada.</p>
            </div>
        @endforelse
    </div>

    <div class="flex items-center justify-between px-5 py-4 border-t border-gold-soft mt-6">
        <div class="text-sm text-muted">
            Mostrando {{ $roles->count() }} de {{ $roles->total() }}
        </div>
        <div class="text-champagne">
            {{ $roles->links() }}
        </div>
        <div class="text-champagne"></div>
    </div>
</div>
