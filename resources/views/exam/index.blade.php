<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Gestión de Exámenes</h1>
                <p class="text-slate-400 mt-1">Administre las evaluaciones y fechas importantes por periodo.</p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 bg-violet-500/10 border border-violet-500/20 rounded-xl text-violet-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 bg-violet-500 rounded-full animate-pulse"></span>
                    Módulo Académico
                </div>
                <a href="{{ route('exam.create') }}"
                    class="px-5 py-2.5 bg-violet-600 hover:bg-violet-500 text-white rounded-xl shadow-lg shadow-violet-600/20 transition-all flex items-center gap-2 font-bold text-xs uppercase tracking-wider">
                    <i class="ti ti-plus"></i>
                    Nuevo Examen
                </a>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
                <i class="ti ti-check-circle text-xl"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Exams Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($exams as $exam)
                <div
                    class="group relative p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl hover:bg-slate-800/50 hover:border-violet-500/30 transition-all duration-300">
                    <!-- Date Badge -->
                    <div class="absolute top-6 right-6 flex flex-col items-center">
                        <span
                            class="text-2xl font-black text-slate-200">{{ \Carbon\Carbon::parse($exam->date)->format('d') }}</span>
                        <span
                            class="text-[10px] font-bold text-violet-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($exam->date)->format('M') }}</span>
                    </div>

                    <div class="mb-6 pr-12">
                        <div
                            class="w-12 h-12 rounded-2xl bg-violet-500/10 flex items-center justify-center text-violet-400 mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="ti ti-file-certificate text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-violet-400 transition-colors">
                            {{ $exam->exam }}</h3>
                        <p class="text-slate-500 text-xs line-clamp-2">
                            {{ $exam->note ?? 'Sin observaciones adicionales.' }}</p>
                    </div>

                    <div class="pt-6 border-t border-slate-700/50 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Acciones</span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('exam.edit', $exam->examID) }}"
                                class="w-8 h-8 rounded-lg bg-slate-900/50 hover:bg-violet-500/20 text-slate-400 hover:text-violet-400 flex items-center justify-center transition-all"
                                title="Editar">
                                <i class="ti ti-pencil"></i>
                            </a>
                            <form action="{{ route('exam.destroy', $exam->examID) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('¿Está seguro de eliminar este examen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-slate-900/50 hover:bg-rose-500/20 text-slate-400 hover:text-rose-400 flex items-center justify-center transition-all"
                                    title="Eliminar">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div
                        class="w-20 h-20 rounded-full bg-slate-800/50 flex items-center justify-center text-slate-600 mx-auto mb-4">
                        <i class="ti ti-calendar-off text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">No hay exámenes programados</h3>
                    <p class="text-slate-500 max-w-sm mx-auto mb-6">Comience creando un nuevo examen para planificar el
                        calendario académico.</p>
                    <a href="{{ route('exam.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors">
                        <i class="ti ti-plus"></i>
                        Crear Primer Examen
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
