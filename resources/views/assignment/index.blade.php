<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Asignaciones</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Gestiona las tareas enviadas a los estudiantes.</p>
            </div>
            <a href="{{ route('assignment.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-500 text-white font-semibold rounded-xl transition-all group shadow-lg shadow-sky-500/20">
                <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform"></i>
                Nueva Asignación
            </a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($assignments as $assignment)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 rounded-3xl p-6 hover:shadow-xl hover:shadow-sky-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="p-3 bg-sky-500/10 text-sky-500 rounded-2xl group-hover:scale-110 transition-transform">
                            <i class="ti ti-copy text-2xl"></i>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('assignment.edit', $assignment->assignmentID) }}"
                                class="p-2 text-slate-400 hover:text-amber-500 transition-colors">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('assignment.destroy', $assignment->assignmentID) }}" method="POST"
                                class="inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2 truncate">
                        {{ $assignment->title }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 mb-4">
                        {{ $assignment->description }}</p>

                    <div class="space-y-3 pt-4 border-t border-slate-100 dark:border-slate-700/30">
                        <div class="flex justify-between text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span>Clase:</span>
                            <span class="text-sky-500">{{ $assignment->class_name }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span>Materia:</span>
                            <span
                                class="text-slate-700 dark:text-slate-300">{{ $assignment->subject->subject ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <span>Fecha Límite:</span>
                            <span
                                class="{{ \Carbon\Carbon::parse($assignment->deadlinedate)->isPast() ? 'text-red-500' : 'text-emerald-500' }}">
                                {{ \Carbon\Carbon::parse($assignment->deadlinedate)->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>

                    @if ($assignment->file)
                        <div class="mt-5">
                            <a href="{{ route('assignment.download', $assignment->assignmentID) }}"
                                class="w-full flex items-center justify-center gap-2 py-2 bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-sky-600 hover:text-white transition-all">
                                <i class="ti ti-paperclip"></i>
                                Ver Adjunto ({{ $assignment->originalfile }})
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <i class="ti ti-copy-off text-6xl text-slate-200 dark:text-slate-700"></i>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">No hay asignaciones creadas
                            hoy.</p>
                        <a href="{{ route('assignment.create') }}" class="text-sky-500 hover:underline">Crear la
                            primera tarea</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
