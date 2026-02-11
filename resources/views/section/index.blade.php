<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Gestión de Secciones</h1>
                <p class="text-slate-400 mt-1">Administra las divisiones de cada clase y sus mentores.</p>
            </div>
            <a href="{{ route('section.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-cyan-600/20 group text-sm">
                <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform"></i>
                Nueva Sección
            </a>
        </div>

        <!-- Filter Section -->
        <div class="mb-8 p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
            <form action="{{ route('section.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                <div class="flex-1 space-y-2">
                    <label for="classesID"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] ml-1">Filtrar por
                        Clase</label>
                    <div class="relative group">
                        <select name="classesID" id="classesID"
                            class="w-full pl-6 pr-10 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none appearance-none text-sm"
                            onchange="this.form.submit()">
                            <option value="">Todas las Clases</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                            <i class="ti ti-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if ($classesID)
                        <a href="{{ route('section.index') }}"
                            class="px-5 py-3 text-slate-400 hover:text-white text-sm font-bold transition-colors">
                            Limpiar
                        </a>
                    @endif
                    <button type="submit"
                        class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-200 font-bold rounded-2xl transition-all border border-slate-600/30 text-sm">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-700/50 bg-slate-800/50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Sección
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Categoría
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Capacidad
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Clase</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Mentor</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($sections as $section)
                            <tr class="group hover:bg-cyan-500/5 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-200 group-hover:text-cyan-400 transition-colors">
                                        {{ $section->section }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-slate-400 text-sm italic">{{ $section->category }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-12 h-1.5 bg-slate-700/50 rounded-full overflow-hidden">
                                            <div class="h-full bg-cyan-500 rounded-full" style="width: 100%"></div>
                                        </div>
                                        <span class="text-slate-300 font-mono">{{ $section->capacity }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="px-2.5 py-1 bg-cyan-600/10 text-cyan-400 border border-cyan-500/20 rounded-lg font-bold">
                                        {{ $section->class_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-2 text-slate-300">
                                        <i class="ti ti-user-star text-cyan-400/50"></i>
                                        {{ $section->teacher_name ?? 'Sin asignar' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                        <a href="{{ route('section.show', $section->sectionID) }}"
                                            class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all"
                                            title="Ver Detalles">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('section.edit', $section->sectionID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('section.destroy', $section->sectionID) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta sección?')">
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
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-layers-subtract text-5xl text-slate-700"></i>
                                        <p class="text-slate-500 font-medium">No se encontraron secciones para este
                                            criterio.</p>
                                        <a href="{{ route('section.create') }}"
                                            class="text-cyan-400 hover:underline text-sm font-bold">Registrar nueva
                                            sección</a>
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
