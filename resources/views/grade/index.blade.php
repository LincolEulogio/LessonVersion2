<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-chart-bar text-amber-500"></i>
                    Grados de Calificación
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Define las escalas y rangos de evaluación
                    para el sistema.</p>
            </div>
            <a href="{{ route('grade.create') }}"
                class="inline-flex items-center gap-3 px-8 py-4 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-[2rem] transition-all transform hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-amber-500/30">
                <i class="ti ti-plus text-xl"></i>
                Nuevo Grado
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($grades as $grade)
                <div
                    class="group relative p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-amber-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-16 h-16 rounded-3xl bg-amber-500/10 flex items-center justify-center text-amber-500 group-hover:scale-110 transition-transform">
                            <span class="text-3xl font-black">{{ $grade->grade }}</span>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('grade.edit', $grade->gradeID) }}"
                                class="p-2 bg-white dark:bg-slate-800 rounded-xl text-slate-400 hover:text-amber-500 shadow-sm border border-slate-100 dark:border-slate-700">
                                <i class="ti ti-edit text-lg"></i>
                            </a>
                            <form action="{{ route('grade.destroy', $grade->gradeID) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Seguro de eliminar este grado?')">
                                @csrf @method('DELETE')
                                <button
                                    class="p-2 bg-white dark:bg-slate-800 rounded-xl text-slate-400 hover:text-rose-500 shadow-sm border border-slate-100 dark:border-slate-700">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-end gap-2">
                            <span
                                class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Punto:</span>
                            <span
                                class="text-xl font-bold text-slate-800 dark:text-slate-100">{{ $grade->point }}</span>
                        </div>

                        <div
                            class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                            <div class="flex-1 text-center">
                                <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Desde
                                </div>
                                <div class="text-lg font-black text-emerald-500">{{ $grade->markfrom }}%</div>
                            </div>
                            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
                            <div class="flex-1 text-center">
                                <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Hasta
                                </div>
                                <div class="text-lg font-black text-rose-500">{{ $grade->markto }}%</div>
                            </div>
                        </div>

                        @if ($grade->note)
                            <p class="text-sm text-slate-500 dark:text-slate-400 italic line-clamp-2">
                                "{{ $grade->note }}"
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if ($grades->isEmpty())
            <div
                class="py-20 text-center rounded-[3rem] border-4 border-dashed border-slate-200 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-900/10">
                <i class="ti ti-chart-dots text-6xl text-slate-300 mb-4 block"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Sin Grados Definidos</h3>
                <p class="text-slate-500 max-w-xs mx-auto mt-2">Empieza creando las escalas de calificación para tus
                    evaluaciones.</p>
            </div>
        @endif
    </div>
</x-app-layout>
