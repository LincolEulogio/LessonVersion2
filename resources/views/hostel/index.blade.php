<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-building-community text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Gestión de Hospedaje
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Administración de hostales y
                        residencias escolares</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('hostel.create') }}"
                    class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Añadir Hostal
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

        <!-- Hostel Cards/Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Hostal / Residencia</th>
                            <th class="px-6 py-4">Dirección</th>
                            <th class="px-6 py-4">Notas</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($hostels as $hostel)
                            <tr class="group hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-all">
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-xs text-slate-400 dark:text-slate-500">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20 shadow-sm">
                                            <i class="ti ti-bed text-xl"></i>
                                        </div>
                                        <div
                                            class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-sm group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $hostel->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $hostel->address }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 max-w-xs truncate"
                                        title="{{ $hostel->note }}">
                                        {{ $hostel->note ?: 'N/A' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('hostel.edit', $hostel->hostelID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                            title="Editar Hostal">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('hostel.destroy', $hostel->hostelID) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('¿Eliminar este hostal y sus datos asociados?')">
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
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                                        <i class="ti ti-building-community text-4xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay hostales
                                        registrados</h3>
                                    <p class="text-slate-400 dark:text-slate-500 mt-2">Comienza agregando tu primera
                                        infraestructura de hospedaje.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
