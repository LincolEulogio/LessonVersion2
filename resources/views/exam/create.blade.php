<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-3xl overflow-hidden">
            <!-- Header -->
            <div
                class="relative bg-slate-50 dark:bg-slate-900/50 p-8 border-b border-slate-100 dark:border-slate-700/50">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <i class="ti ti-file-plus text-9xl text-violet-500 transform rotate-12"></i>
                </div>
                <div class="relative z-10">
                    <h2 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight mb-2">Nuevo Examen</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Programe una nueva evaluación para el periodo
                        académico.</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('exam.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Exam Name -->
                <div class="space-y-2 group">
                    <label for="exam"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 group-focus-within:text-violet-400 transition-colors">
                        Nombre del Examen <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="exam" id="exam" value="{{ old('exam') }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-5 py-3 text-slate-700 dark:text-slate-200 focus:border-violet-500/50 focus:ring-4 focus:ring-violet-500/10 transition-all outline-none peer pl-12"
                            placeholder="Ej. Primer Parcial Matemáticas">
                        <div
                            class="absolute left-4 top-3.5 text-slate-500 peer-focus:text-violet-400 transition-colors">
                            <i class="ti ti-file-text text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Date -->
                <div class="space-y-2 group">
                    <label for="date"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 group-focus-within:text-violet-400 transition-colors">
                        Fecha Programada <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="date" name="date" id="date" value="{{ old('date') }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-5 py-3 text-slate-700 dark:text-slate-200 focus:border-violet-500/50 focus:ring-4 focus:ring-violet-500/10 transition-all outline-none peer pl-12 [color-scheme:light] dark:[color-scheme:dark]">
                        <div
                            class="absolute left-4 top-3.5 text-slate-500 peer-focus:text-violet-400 transition-colors">
                            <i class="ti ti-calendar-event text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Note -->
                <div class="space-y-2 group">
                    <label for="note"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 group-focus-within:text-violet-400 transition-colors">
                        Notas / Observaciones
                    </label>
                    <div class="relative">
                        <textarea name="note" id="note" rows="3"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-5 py-3 text-slate-700 dark:text-slate-200 focus:border-violet-500/50 focus:ring-4 focus:ring-violet-500/10 transition-all outline-none peer pl-12 resize-none"
                            placeholder="Detalles adicionales sobre el examen...">{{ old('note') }}</textarea>
                        <div
                            class="absolute left-4 top-3.5 text-slate-500 peer-focus:text-violet-400 transition-colors">
                            <i class="ti ti-notes text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div
                    class="pt-6 flex items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('exam.index') }}"
                        class="px-5 py-2.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700/50 font-bold text-xs uppercase tracking-wider transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 bg-violet-600 hover:bg-violet-500 text-white rounded-xl shadow-lg shadow-violet-600/20 font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                        <i class="ti ti-device-floppy"></i>
                        Guardar Examen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
