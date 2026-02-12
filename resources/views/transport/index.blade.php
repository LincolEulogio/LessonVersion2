<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-bus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Gestión de Transporte
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Administración de rutas y
                        logística escolar</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('transport.create') }}"
                    class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Añadir Ruta
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 animate-in fade-in slide-in-from-top-4 duration-500">
                <div
                    class="w-8 h-8 rounded-lg bg-white dark:bg-emerald-500/20 flex items-center justify-center shadow-sm">
                    <i class="ti ti-circle-check text-xl"></i>
                </div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Transport Cards/Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Ruta / Trayecto</th>
                            <th class="px-6 py-4">Vehículo Asignado</th>
                            <th class="px-6 py-4 text-center">Costo Mensual</th>
                            <th class="px-6 py-4">Notas</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($transports as $transport)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all">
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-xs text-slate-400 dark:text-slate-500">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-sm group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                        {{ $transport->route }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                                            <i class="ti ti-truck text-base"></i>
                                        </div>
                                        <span
                                            class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $transport->vehicle }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-black text-xs border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                                            ${{ number_format($transport->cost, 2) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 max-w-xs truncate"
                                        title="{{ $transport->note }}">
                                        {{ $transport->note ?: 'N/A' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('transport.edit', $transport->transportID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                            title="Editar Ruta">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('transport.destroy', $transport->transportID) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Eliminar esta ruta de transporte?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                                title="Eliminar">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                                        <i class="ti ti-bus-stop text-4xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay rutas
                                        registradas</h3>
                                    <p class="text-slate-400 dark:text-slate-500 mt-2">Comienza agregando tu primera
                                        ruta de transporte escolar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
