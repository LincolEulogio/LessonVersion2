<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Gestión de Clases</h1>
                <p class="text-slate-400 mt-1">Administra los niveles académicos y sus responsables.</p>
            </div>
            <a href="{{ route('classes.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl transition-all group">
                <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform"></i>
                Nueva Clase
            </a>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-500/10 text-emerald-400 rounded-2xl">
                        <i class="ti ti-school text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Clases</p>
                        <h3 class="text-2xl font-bold text-white">{{ $classes->count() }}</h3>
                    </div>
                </div>
            </div>
            <!-- Add more stats if needed -->
        </div>

        <!-- Table Container -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-700/50 bg-slate-800/50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">#</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Clase</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Numérico
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Maestro
                                Responsable</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($classes as $class)
                            <tr class="group hover:bg-emerald-500/5 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <span class="text-slate-500 font-mono text-sm">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-bold text-slate-200 group-hover:text-emerald-400 transition-colors">
                                        {{ $class->classes }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2.5 py-1 bg-slate-700/50 text-slate-300 rounded-lg text-xs font-bold">
                                        {{ $class->classes_numeric }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-slate-300">
                                        <i class="ti ti-user-star text-emerald-400/50"></i>
                                        {{ $class->teacher_name ?? 'Sin asignar' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                        <a href="{{ route('classes.show', $class->classesID) }}"
                                            class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all"
                                            title="Ver Detalles">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('classes.edit', $class->classesID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('classes.destroy', $class->classesID) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta clase? Esto podría afectar a los estudiantes asociados.')">
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
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-school-off text-5xl text-slate-700"></i>
                                        <p class="text-slate-500 font-medium">No hay clases registradas aún.</p>
                                        <a href="{{ route('classes.create') }}"
                                            class="text-emerald-400 hover:underline text-sm">Crea la primera clase</a>
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
