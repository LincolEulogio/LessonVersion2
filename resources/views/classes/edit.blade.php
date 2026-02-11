<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-8 text-center md:text-left">
            <nav class="flex items-center justify-center md:justify-start gap-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('classes.index') }}"
                    class="hover:text-amber-400 text-slate-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Clases</a>
                <i class="ti ti-chevron-right text-xs"></i>
                <span class="text-amber-400 uppercase tracking-widest font-bold text-[10px]">Editar Clase</span>
            </nav>
            <h1 class="text-3xl font-bold text-white tracking-tight">Editar Clase: {{ $class->classes }}</h1>
            <p class="text-slate-400 mt-1">Modifica los detalles del nivel académico o reasigna al docente responsable.
            </p>
        </div>

        <!-- Form Card -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <form action="{{ route('classes.update', $class->classesID) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Class Name -->
                    <div class="space-y-2">
                        <label for="classes"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nombre de la
                            Clase</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                                <i class="ti ti-school"></i>
                            </div>
                            <input type="text" name="classes" id="classes"
                                value="{{ old('classes', $class->classes) }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-amber-500/50 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none"
                                placeholder="Ej: Primero A">
                        </div>
                        @error('classes')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Numeric Value -->
                    <div class="space-y-2">
                        <label for="classes_numeric"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Valor
                            Numérico</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                                <i class="ti ti-numbers"></i>
                            </div>
                            <input type="number" name="classes_numeric" id="classes_numeric"
                                value="{{ old('classes_numeric', $class->classes_numeric) }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-amber-500/50 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none"
                                placeholder="Ej: 1">
                        </div>
                        @error('classes_numeric')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Selection -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="teacherID"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Docente
                            Responsable</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                                <i class="ti ti-user-star"></i>
                            </div>
                            <select name="teacherID" id="teacherID" required
                                class="w-full pl-11 pr-10 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 focus:border-amber-500/50 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none appearance-none">
                                <option value="" disabled>Selecciona un docente</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->teacherID }}"
                                        {{ old('teacherID', $class->teacherID) == $teacher->teacherID ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ $teacher->designation }})
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                                <i class="ti ti-selector"></i>
                            </div>
                        </div>
                        @error('teacherID')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="note"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Notas
                            (Opcional)</label>
                        <div class="relative group">
                            <div
                                class="absolute top-4 left-4 pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                                <i class="ti ti-notes"></i>
                            </div>
                            <textarea name="note" id="note" rows="3"
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-amber-500/50 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none"
                                placeholder="Cualquier información adicional...">{{ old('note', $class->note) }}</textarea>
                        </div>
                        @error('note')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-8 border-t border-slate-700/50 flex items-center justify-end gap-4">
                    <a href="{{ route('classes.index') }}"
                        class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-300 font-bold rounded-2xl transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-amber-600/20 active:scale-95">
                        Actualizar Clase
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
