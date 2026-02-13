<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('classes.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-school text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Clases') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Editar') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Editar Clase') }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Modifica los detalles académicos de') }} <span
                        class="text-emerald-500 font-bold">{{ $class->classes }}</span></p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('classes.update', $class->classesID) }}" method="POST" class="p-8 md:p-12">
                @csrf
                @method('PUT')

                <div class="space-y-12">
                    <!-- Section: Class Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Class Name -->
                        <div class="space-y-3">
                            <label for="classes"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Nombre de la Clase') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="classes" id="classes"
                                    value="{{ old('classes', $class->classes) }}" placeholder="Ej: Primero A - Primaria"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                            </div>
                            <x-input-error :messages="$errors->get('classes')" class="mt-1" />
                        </div>

                        <!-- Numeric Value -->
                        <div class="space-y-3">
                            <label for="classes_numeric"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Valor Numérico') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-numbers absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="number" name="classes_numeric" id="classes_numeric"
                                    value="{{ old('classes_numeric', $class->classes_numeric) }}" placeholder="Ej: 1"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                            </div>
                            <x-input-error :messages="$errors->get('classes_numeric')" class="mt-1" />
                        </div>

                        <!-- Teacher Selection -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="teacherID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Maestro Responsable') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-user-star absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="teacherID" id="teacherID"
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="">{{ __('Selecciona un docente') }}</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->teacherID }}"
                                            {{ old('teacherID', $class->teacherID) == $teacher->teacherID ? 'selected' : '' }}>
                                            {{ $teacher->name }} — {{ $teacher->designation }}
                                        </option>
                                    @endforeach
                                </select>
                                <i
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                            <x-input-error :messages="$errors->get('teacherID')" class="mt-1" />
                        </div>

                        <!-- Note -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="note"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Notas / Descripción') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-notes absolute left-5 top-6 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <textarea name="note" id="note" rows="4"
                                    placeholder="{{ __('Cualquier detalle adicional sobre esta clase...') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('note', $class->note) }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('note')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('classes.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                            <i class="ti ti-refresh text-xl"></i>
                            {{ __('Actualizar Clase') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
