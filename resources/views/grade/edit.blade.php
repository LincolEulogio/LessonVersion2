<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8">
                <a href="{{ route('grade.index') }}"
                    class="hover:text-amber-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-chart-bar text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Grados') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500/60">{{ __('Editar Grado') }}</span>
            </nav>

            <div class="space-y-4">
                <h1
                    class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                    {{ __('Editar') }} <span class="text-amber-500 relative inline-block">
                        {{ __('Grado') }}
                        <span class="absolute -bottom-2 left-0 w-full h-3 bg-amber-500/20 rounded-full"></span>
                    </span>
                </h1>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                    <span class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-ping"></span>
                    {{ __('Actualización de los detalles del nivel de evaluación') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] shadow-sm overflow-hidden group/form">
            <form action="{{ route('grade.update', $grade->gradeID) }}" method="POST"
                class="p-10 space-y-10 font-bold">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Grade Name -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-amber-500 transition-colors">
                            {{ __('Nombre del Grado (Letra)') }} <span class="text-amber-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-letter-case absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-amber-500 transition-colors z-10 text-lg"></i>
                            <input type="text" name="grade" value="{{ old('grade', $grade->grade) }}"
                                maxlength="60"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('grade') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all outline-none"
                                placeholder="{{ __('Ej: A+, A, B, C...') }}">
                        </div>
                        @error('grade')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grade Point -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-amber-500 transition-colors">
                            {{ __('Punto de Calificación') }} <span class="text-amber-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-point absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-amber-500 transition-colors z-10 text-lg"></i>
                            <input type="text" name="point" value="{{ old('point', $grade->point) }}"
                                maxlength="11"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('point') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all outline-none"
                                placeholder="{{ __('Ej: 5.0, 4.0...') }}">
                        </div>
                        @error('point')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-10 border-t border-slate-100 dark:border-slate-700/30">
                    <!-- Mark From -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Nota Desde (%)') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-arrow-bar-right absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <input type="number" name="markfrom" value="{{ old('markfrom', $grade->markfrom) }}"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('markfrom') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none"
                                placeholder="0">
                        </div>
                        @error('markfrom')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mark To -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-rose-500 transition-colors">
                            {{ __('Nota Hasta (%)') }} <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-arrow-bar-left absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-rose-500 transition-colors z-10 text-lg"></i>
                            <input type="number" name="markto" value="{{ old('markto', $grade->markto) }}"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('markto') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 transition-all outline-none"
                                placeholder="100">
                        </div>
                        @error('markto')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Note -->
                <div class="space-y-3 group/item">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-amber-500 transition-colors">
                        {{ __('Notas / Observaciones') }}
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-notes absolute left-5 top-5 text-slate-400 group-focus-within/item:text-amber-500 transition-colors z-10 text-lg"></i>
                        <textarea name="note" id="note" rows="4"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('note') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-3xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all outline-none min-h-[120px]"
                            placeholder="{{ __('Descripción opcional del grado...') }}">{{ old('note', $grade->note) }}</textarea>
                    </div>
                    @error('note')
                        <p
                            class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-2 italic animate-pulse">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Actions -->
                <div
                    class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-slate-100 dark:border-slate-700/30">
                    <a href="{{ route('grade.index') }}"
                        class="px-8 py-4 text-[11px] font-black text-slate-400 hover:text-rose-500 uppercase tracking-widest transition-all flex items-center gap-2 group/back">
                        <i class="ti ti-chevron-left text-lg group-hover/back:-translate-x-1 transition-transform"></i>
                        {{ __('Regresar') }}
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-16 py-5 bg-amber-600 hover:bg-amber-500 text-white font-black rounded-3xl shadow-xl shadow-amber-500/20 transition-all hover:scale-[1.02] active:scale-[1] uppercase tracking-widest text-[11px] flex items-center gap-3">
                        <i class="ti ti-repeat text-lg"></i>
                        {{ __('Actualizar Grado') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
