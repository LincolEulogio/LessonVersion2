<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('section.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-layers-subtract text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Secciones') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Nueva') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Registrar Sección') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Crea una nueva división para organizar a los estudiantes') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('section.store') }}" method="POST" class="p-8 md:p-12">
                @csrf

                <div class="space-y-12">
                    <!-- Section: General Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Section Name -->
                        <div class="space-y-3">
                            <label for="section"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Nombre de la Sección') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-layers-linked absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="section" id="section" value="{{ old('section') }}"
                                    placeholder="{{ __('Ej: Sección A') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('section')" class="mt-1" />
                        </div>

                        <!-- Category -->
                        <div class="space-y-3">
                            <label for="category"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Categoría / Turno') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-tag absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="category" id="category" value="{{ old('category') }}"
                                    placeholder="{{ __('Ej: Matutino') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('category')" class="mt-1" />
                        </div>

                        <!-- Class Selection -->
                        <div class="space-y-3">
                            <label for="classesID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Clase Vinculada') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="classesID" id="classesID"
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium">
                                    <option value="" disabled {{ old('classesID') ? '' : 'selected' }}>
                                        {{ __('Selecciona una clase') }}</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->classesID }}"
                                            {{ old('classesID') == $class->classesID ? 'selected' : '' }}>
                                            {{ $class->classes }}
                                        </option>
                                    @endforeach
                                </select>
                                <i
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                            <x-input-error :messages="$errors->get('classesID')" class="mt-1" />
                        </div>

                        <!-- Capacity -->
                        <div class="space-y-3">
                            <label for="capacity"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Capacidad Máxima') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-users absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}"
                                    min="1" placeholder="{{ __('Ej: 30') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('capacity')" class="mt-1" />
                        </div>

                        <!-- Mentor Selection -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="teacherID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Maestro Mentor / Tutor') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div
                                class="relative group border border-slate-200 dark:border-slate-700/50 rounded-2xl overflow-hidden hover:border-emerald-500/30 transition-all p-2 bg-slate-50/50 dark:bg-slate-900/30">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach ($teachers as $teacher)
                                        <label
                                            class="relative flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-white dark:hover:bg-slate-800 transition-all group/item shadow-sm border border-transparent has-[:checked]:border-emerald-500/30 has-[:checked]:bg-white dark:has-[:checked]:bg-slate-800">
                                            <input type="radio" name="teacherID" value="{{ $teacher->teacherID }}"
                                                class="sr-only peer"
                                                {{ old('teacherID') == $teacher->teacherID ? 'checked' : '' }}>

                                            <div
                                                class="w-10 h-10 rounded-lg overflow-hidden shrink-0 border border-slate-200 dark:border-slate-700 group-hover/item:border-emerald-500/50 transition-all">
                                                @if ($teacher->photo)
                                                    <img src="{{ asset('uploads/images/' . $teacher->photo) }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400">
                                                        <i class="ti ti-user text-lg"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col min-w-0">
                                                <span
                                                    class="text-xs font-black text-slate-700 dark:text-slate-200 truncate group-hover/item:text-emerald-500 transition-colors">{{ $teacher->name }}</span>
                                                <span
                                                    class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">{{ $teacher->designation }}</span>
                                            </div>

                                            <div
                                                class="absolute right-3 top-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100 transition-all">
                                                <div
                                                    class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/20">
                                                    <i class="ti ti-check text-white text-xs"></i>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('teacherID')" class="mt-1" />
                        </div>

                        <!-- Note -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="note"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Descripción o Notas Adicionales') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-align-left absolute left-5 top-6 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <textarea name="note" id="note" rows="5"
                                    placeholder="{{ __('Describe los objetivos de esta sección, ubicación o cualquier detalle relevante...') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none font-medium text-sm leading-relaxed">{{ old('note') }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('note')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('section.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                            <i class="ti ti-device-floppy text-xl"></i>
                            {{ __('Guardar Sección') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
