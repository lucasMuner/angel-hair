<div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6 mx-4 mb-8">
    @forelse($employees as $employee)
        <x-employee.card :id="$employee->id" :employee="$employee->user->name" :email="$employee->user->email" :phone="$employee->phone"/>
    @empty
        <div class="col-span-4 text-center py-8">
            <p class="text-champagne">Nenhum funcionário cadastrado ainda.</p>
        </div>
    @endforelse
</div>
