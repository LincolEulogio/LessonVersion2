<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-2xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8">
                <a href="{{ route('exam.index') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-file-certificate text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Exámenes') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60">{{ __('Nuevo Examen') }}</span>
            </nav>

            <div class="space-y-4">
                <h1
                    class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                    {{ __('Nuevo') }} <span class="text-emerald-500 relative inline-block">
                        {{ __('Examen') }}
                        <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                    </span>
                </h1>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                    {{ __('Configuración de nueva evaluación para el periodo') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] shadow-sm overflow-hidden">
            <form action="{{ route('exam.store') }}" method="POST" class="p-10 space-y-8">
                @csrf

                <!-- Exam Name -->
                <div class="space-y-3 group">
                    <label for="exam"
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within:text-emerald-500 transition-colors">
                        {{ __('Nombre del Examen') }} <span class="text-emerald-500">*</span>
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-file-text absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10 text-lg"></i>
                        <input type="text" name="exam" id="exam" value="{{ old('exam') }}"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('exam') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold text-sm"
                            placeholder="{{ __('Ej. Primer Parcial Matemáticas') }}">
                    </div>
                    @error('exam')
                        <p
                            class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Date -->
                <div class="space-y-3 group">
                    <label for="date"
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within:text-emerald-500 transition-colors">
                        {{ __('Fecha Programada') }} <span class="text-emerald-500">*</span>
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-calendar absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10 text-lg"></i>
                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('date') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold text-sm">
                    </div>
                    @error('date')
                        <p
                            class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Note -->
                <div class="space-y-3 group">
                    <label for="note"
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within:text-emerald-500 transition-colors">
                        {{ __('Notas / Observaciones') }}
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-notes absolute left-5 top-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10 text-lg"></i>
                        <textarea name="note" id="note" rows="4"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('note') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold text-sm resize-none"
                            placeholder="{{ __('Detalles adicionales sobre el examen...') }}">{{ old('note') }}</textarea>
                    </div>
                    @error('note')
                        <p
                            class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Footer Actions -->
                <div
                    class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('exam.index') }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-all text-[11px] font-black uppercase tracking-widest text-center">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-10 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl shadow-xl shadow-emerald-500/20 transition-all flex items-center justify-center gap-3 font-black text-[11px] uppercase tracking-widest group">
                        <i class="ti ti-device-floppy text-lg"></i>
                        {{ __('Guardar Examen') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
