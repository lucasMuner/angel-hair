<div class="mx-4 mb-8">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-4 mb-8">
        @forelse($appointments as $appointment)
            <x-appointment.card
                :id="$appointment->id"
                :employee="$appointment->employee->user->name"
                :client="$appointment->client->user->name"
                :date="$appointment->date"
                :start_time="$appointment->start_time"
                :end_time="$appointment->end_time"
            />
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-champagne">Nenhum agendamento encontrado.</p>
            </div>
        @endforelse
    </div>

    <div class="flex items-center justify-between px-5 py-4 border-t border-gold-soft mt-6">
        <div class="text-sm text-muted">
            Mostrando {{ $appointments->count() }} de {{ $appointments->total() }}
        </div>
        <div class="text-champagne">
            {{ $appointments->links() }}
        </div>
        <div class="text-champagne"></div>
    </div>

</div>
