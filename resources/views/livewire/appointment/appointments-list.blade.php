<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($appointments as $appointment)
        <x-appointment.card
            :id="$appointment->id"
            :employee="$appointment->employee->user->name"
            :client="$appointment->client->user->name"
            :email="$appointment->client->user->email"
            :phone="$appointment->client->phone"
        />
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum cliente agendado realizado.</p>
        </div>
    @endforelse
</div>
