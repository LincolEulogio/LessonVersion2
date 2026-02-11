<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <i class="ti ti-bus text-emerald-400 text-2xl"></i>
            <span class="bg-linear-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">
                {{ __('Gestión de Transporte') }}
            </span>
        </div>
    </x-slot>

    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl overflow-hidden backdrop-blur-sm">
        <div class="p-6 border-b border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-100">{{ __('Rutas de Transporte') }}</h3>
                <p class="text-sm text-slate-400">{{ __('Lista de todas las rutas y vehículos disponibles.') }}</p>
            </div>
            <a href="{{ route('transport.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/20 transition-all font-bold">
                <i class="ti ti-plus"></i>
                {{ __('Agregar Nueva Ruta') }}
            </a>
        </div>

        @if (session('success'))
            <div
                class="p-4 bg-emerald-500/10 border-b border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-3">
                <i class="ti ti-circle-check text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-900/50 text-slate-400 text-xs font-bold uppercase tracking-widest">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">{{ __('Ruta') }}</th>
                        <th class="px-6 py-4">{{ __('Vehículo') }}</th>
                        <th class="px-6 py-4 text-center">{{ __('Costo') }}</th>
                        <th class="px-6 py-4">{{ __('Notas') }}</th>
                        <th class="px-6 py-4 text-right">{{ __('Acciones') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/30">
                    @forelse($transports as $transport)
                        <tr class="group hover:bg-slate-700/20 transition-all duration-200">
                            <td class="px-6 py-4 text-slate-500 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-200 group-hover:text-emerald-400 transition-colors">
                                    {{ $transport->route }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-slate-400 text-sm">
                                    <i class="ti ti-truck text-lg text-emerald-500/50"></i>
                                    {{ $transport->vehicle }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-center font-mono text-emerald-400 bg-emerald-500/10 rounded-lg py-1">
                                    ${{ number_format($transport->cost, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-sm truncate max-w-xs">
                                {{ $transport->note ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end gap-2 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('transport.edit', $transport->transportID) }}"
                                        class="p-2 text-amber-400 hover:bg-amber-400/10 rounded-lg transition-colors"
                                        title="Editar">
                                        <i class="ti ti-edit text-xl"></i>
                                    </a>
                                    <form action="{{ route('transport.destroy', $transport->transportID) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-colors"
                                            title="Eliminar"
                                            onclick="return confirm('¿Estás seguro de eliminar esta ruta?')">
                                            <i class="ti ti-trash text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-slate-500">
                                    <i class="ti ti-bus-stop text-5xl opacity-20"></i>
                                    <p>{{ __('No hay rutas registradas.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
