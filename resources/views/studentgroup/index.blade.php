<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Grupos de Estudiantes</h1>
                <p class="text-slate-400 mt-1">Crea etiquetas personalizadas para organizar a tus estudiantes.</p>
            </div>
            <a href="{{ route('studentgroup.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-sky-600/20 group text-sm">
                <i class="ti ti-users-group text-lg group-hover:scale-110 transition-transform"></i>
                Nuevo Grupo
            </a>
        </div>

        <!-- Table Container -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="border-b border-slate-700/50 bg-slate-800/50 font-bold uppercase tracking-[0.2em] text-[10px] text-slate-500">
                            <th class="px-8 py-4">#</th>
                            <th class="px-8 py-4">Nombre del Grupo</th>
                            <th class="px-8 py-4 text-right">Mantenimiento</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($groups as $group)
                            <tr class="group hover:bg-sky-500/5 transition-all duration-300">
                                <td class="px-8 py-5">
                                    <span class="text-slate-500 font-mono text-xs">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center text-sky-400">
                                            <i class="ti ti-tag text-sm"></i>
                                        </div>
                                        <span
                                            class="font-bold text-slate-200 group-hover:text-sky-400 transition-colors uppercase tracking-wider text-sm">
                                            {{ $group->group }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all">
                                        <a href="{{ route('studentgroup.edit', $group->studentgroupID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('studentgroup.destroy', $group->studentgroupID) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Eliminar este grupo definitivamente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Eliminar">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-database-off text-5xl text-slate-700"></i>
                                        <p class="text-slate-500 font-medium">No existen grupos definidos actualmente.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
