<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Plan de Estudios</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Sube y gestiona los archivos de planificación
                    académica.</p>
            </div>
            <a href="{{ route('syllabus.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-rose-600 hover:bg-rose-500 text-white font-semibold rounded-xl transition-all group">
                <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform"></i>
                Nuevo Plan
            </a>
        </div>

        <!-- Table Container -->
        <div
            class="rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-800/50">
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                #</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                Título</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                Clase</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                Archivo</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($syllabuses as $syllabus)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-rose-500/5 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <span class="text-slate-500 font-mono text-sm">{{ $loop->iteration }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                                        {{ $syllabus->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $syllabus->class_name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($syllabus->file)
                                        <a href="{{ route('syllabus.download', $syllabus->syllabusID) }}"
                                            class="inline-flex items-center gap-2 px-3 py-1 bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 rounded-lg text-xs font-bold hover:bg-rose-600 hover:text-white transition-all">
                                            <i class="ti ti-download"></i>
                                            Descargar
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 italic font-medium tracking-tight">Sin
                                            archivo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                        <a href="{{ route('syllabus.edit', $syllabus->syllabusID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('syllabus.destroy', $syllabus->syllabusID) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Estás seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">No hay planes
                                    registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
