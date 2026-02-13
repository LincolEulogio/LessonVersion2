<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-yellow-500/10 flex items-center justify-center text-yellow-600 dark:text-yellow-400 border border-slate-200 dark:border-yellow-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-bus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Rutas de Transporte
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de rutas, vehículos y
                        costos operativos</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('transport.create') }}"
                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-yellow-600 text-white font-black text-xs uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-600/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    Nueva Ruta
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                    Total Rutas</p>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">{{ $transports->count() }}</h4>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                    Costo Promedio</p>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">
                    ${{ number_format($transports->avg('cost'), 2) }}</h4>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Ruta
                    Más Costosa</p>
                <h4 class="text-3xl font-black text-yellow-600 dark:text-yellow-400">
                    ${{ number_format($transports->max('cost'), 2) }}</h4>
            </div>
        </div>

        <!-- Transports Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700/50">
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Ruta / Destino</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Vehículo / Placa</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Costo Mensual</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Notas</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($transports as $transport)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 flex items-center justify-center border border-yellow-100 dark:border-yellow-500/20">
                                            <i class="ti ti-map-pin text-xl"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white group-hover:text-yellow-600 transition-colors capitalize">
                                                {{ $transport->route }}</p>
                                            <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500">ID:
                                                #{{ $transport->transportID }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <i class="ti ti-tir text-slate-400"></i>
                                        <span
                                            class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ $transport->vehicle }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-black text-slate-900 dark:text-white">
                                        ${{ number_format($transport->cost, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-[200px]"
                                        title="{{ $transport->note }}">
                                        {{ $transport->note ?? 'Sin observaciones' }}
                                    </p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('transport.show', $transport->transportID) }}"
                                            class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('transport.edit', $transport->transportID) }}"
                                            class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button
                                            onclick="confirmDeletion('{{ route('transport.destroy', $transport->transportID) }}', '{{ $transport->route }}')"
                                            class="w-9 h-9 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <p
                                        class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                                        No hay rutas registradas actualmente</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDeletion(url, route) {
                Swal.fire({
                    title: '¿Eliminar Ruta?',
                    text: `Estás a punto de eliminar la ruta "${route}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML =
                            `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
