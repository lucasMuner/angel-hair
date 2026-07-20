<div class="bg-noir-surface border border-gold-soft rounded-lg overflow-hidden">
	{{-- Header --}}
	<div class="flex items-center justify-between px-5 py-4 border-b border-gold-soft">
		<div class="flex-1 max-w-md">
			<input
				wire:model.live.debounce.300ms="search"
				type="text"
				placeholder="Buscar..."
				class="w-full bg-noir-card border border-gold-soft text-champagne placeholder:text-muted text-sm rounded-md px-3 py-2 outline-none transition-colors focus:border-goldenrod"
			/>
		</div>
	</div>

	{{-- Table --}}
	<div class="overflow-x-auto">
		<table class="w-full text-sm">
			<thead class="bg-noir-card">
				<tr>
					<th class="text-center text-muted font-normal px-5 py-3">Nome</th>
					<th class="text-center text-muted font-normal px-5 py-3">Email</th>
					<th class="text-center text-muted font-normal px-5 py-3">Funções</th>
					<th class="text-center text-muted font-normal px-5 py-3">Criado em</th>
					<th class="text-center text-muted font-normal px-5 py-3">Acessar</th>
				</tr>
			</thead>
			<tbody>
				@forelse($users as $user)
					<tr class="border-t border-gold-soft hover:bg-goldenrod-10 transition-colors" style="text-align: center;">
						<td class="px-5 py-3 text-champagne">{{ $user->name }}</td>
						<td class="px-5 py-3 text-muted">{{ $user->email }}</td>
						<td class="px-5 py-3">
							@if(method_exists($user, 'getRoleNames'))
								<span class="text-goldenrod">{{ $user->getRoleNames()->join(', ') }}</span>
							@else
								<span class="text-muted">-</span>
							@endif
						</td>
						<td class="px-5 py-3 text-muted">
							{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
						</td>
						<td class="px-5 py-3 text-center">
							<div class="inline-flex gap-2">
								<button
									@click="$dispatch('edit-user', { id: {{ $user->id }} })"
									class="cursor-pointer text-xs font-medium px-3 py-1.5 rounded-md bg-goldenrod-10 text-goldenrod border border-goldenrod hover:bg-goldenrod hover:text-tidewater transition-colors"
								>
									...
								</button>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="6" class="text-center text-muted py-6">
							Nenhum usuário encontrado.
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	{{-- Footer --}}
	<div class="flex items-center justify-between px-5 py-4 border-t border-gold-soft">
		<div class="text-sm text-muted">
			Mostrando {{ $users->count() }} de {{ $users->total() }}
		</div>
		<div class="text-champagne">
			{{ $users->links() }}
		</div>
        <div class="text-champagne"></div>
	</div>
</div>
