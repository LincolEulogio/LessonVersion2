<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header & Action Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                    {{ __('Gestión de Docentes') }}
                </h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">Administre el personal docente y sus perfiles
                    profesionales.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('teacher.create') }}"
                    class="group flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold transition-all active:scale-95">
                    <i class="ti ti-user-plus text-lg"></i>
                    <span>Añadir Docente</span>
                </a>
            </div>
        </div>

        <!-- Teachers Table Card -->
        <div
            class="rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-900/20">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Docente</th>
                            <th class="px-6 py-4">Cargo / Email</th>
                            <th class="px-6 py-4">Teléfono</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-6 py-4 text-right pr-10">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($teachers as $teacher)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all duration-200">
                                <td class="px-6 py-4 text-slate-400 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset($teacher->photo && $teacher->photo != 'default.png' ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                                            class="w-10 h-10 rounded-xl object-cover border-2 border-slate-200 dark:border-slate-700 group-hover:border-emerald-500 transition-colors"
                                            alt="{{ $teacher->name }}">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $teacher->name }}</span>
                                            <span class="text-xs text-slate-500">DNI: {{ $teacher->dni }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $teacher->designation }}</span>
                                        <span class="text-xs text-slate-500">{{ $teacher->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-sm">
                                    {{ $teacher->phone ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($teacher->active)
                                        <span
                                            class="px-3 py-1 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-full text-xs font-bold shadow-sm">Activo</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-red-500/10 text-red-500 border border-red-500/20 rounded-full text-xs font-bold shadow-sm">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right pr-6">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('teacher.show', $teacher->teacherID) }}"
                                            class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all"
                                            title="Ver Perfil">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('teacher.edit', $teacher->teacherID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="Editar">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('teacher.destroy', $teacher->teacherID) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Está seguro de eliminar a este docente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Eliminar">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-user-x text-4xl"></i>
                                        <p>No se encontraron docentes registrados.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($teachers->hasPages())
                <div
                    class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-900/20">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
