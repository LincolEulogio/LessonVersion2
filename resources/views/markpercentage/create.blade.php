<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter">Nuevo Porcentaje</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Define una nueva categoría de evaluación y su
                peso porcentual.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-2xl rounded-[3rem] border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('markpercentage.store') }}" method="POST" class="p-12 space-y-10">
                @csrf

                <div class="space-y-3">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Nombre
                        de la Categoría</label>
                    <input type="text" name="markpercentage" required maxlength="60"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 py-4 px-5 font-bold transition-all"
                        placeholder="Ej: Examen Parcial, Trabajo Práctico...">
                </div>

                <div class="space-y-3">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Valor
                        Porcentual (%)</label>
                    <div class="relative">
                        <input type="number" step="0.01" name="markpercentage_numeric" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 py-4 px-5 font-bold transition-all"
                            placeholder="0.00">
                        <span
                            class="absolute right-6 top-1/2 -translate-y-1/2 text-2xl font-black text-slate-300">%</span>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-10 border-t border-slate-100 dark:border-slate-700/30">
                    <a href="{{ route('markpercentage.index') }}"
                        class="px-8 py-4 text-xs font-black text-slate-400 hover:text-slate-900 dark:hover:text-white uppercase tracking-[0.2em] transition-all flex items-center gap-2">
                        <i class="ti ti-chevron-left text-lg"></i> Regresar
                    </a>
                    <button type="submit"
                        class="px-16 py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-3xl shadow-xl transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
