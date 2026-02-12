<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter">Editar Grado</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Actualiza los rangos de evaluación del grado
                {{ $grade->grade }}.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-2xl rounded-[3rem] border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('grade.update', $grade->gradeID) }}" method="POST" class="p-12 space-y-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Nombre
                            del Grado (Letra)</label>
                        <input type="text" name="grade" value="{{ old('grade', $grade->grade) }}" required
                            maxlength="60"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/20 py-4 px-5 font-bold transition-all">
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Punto
                            de Calificación</label>
                        <input type="text" name="point" value="{{ old('point', $grade->point) }}" required
                            maxlength="11"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/20 py-4 px-5 font-bold transition-all">
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-slate-100 dark:border-slate-700/30">
                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Nota
                            Desde (%)</label>
                        <input type="number" name="markfrom" value="{{ old('markfrom', $grade->markfrom) }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/20 py-4 px-5 font-bold transition-all">
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Nota
                            Hasta (%)</label>
                        <input type="number" name="markto" value="{{ old('markto', $grade->markto) }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/20 py-4 px-5 font-bold transition-all">
                    </div>
                </div>

                <div class="space-y-3">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Notas
                        / Observaciones</label>
                    <textarea name="note" rows="4"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-3xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/20 py-4 px-5 font-bold transition-all">{{ old('note', $grade->note) }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-10 border-t border-slate-100 dark:border-slate-700/30">
                    <a href="{{ route('grade.index') }}"
                        class="px-8 py-4 text-xs font-black text-slate-400 hover:text-slate-900 dark:hover:text-white uppercase tracking-[0.2em] transition-all flex items-center gap-2">
                        <i class="ti ti-chevron-left text-lg"></i> Regresar
                    </a>
                    <button type="submit"
                        class="px-16 py-5 bg-amber-600 hover:bg-amber-500 text-white font-black rounded-3xl shadow-xl transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Actualizar Grado
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
