<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('section.index') }}"
                    class="hover:text-cyan-400 text-slate-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Secciones</a>
                <i class="ti ti-chevron-right text-xs"></i>
                <span class="text-cyan-400 uppercase tracking-widest font-bold text-[10px]">Nueva Sección</span>
            </nav>
            <h1 class="text-3xl font-bold text-white tracking-tight">Registar Nueva Sección</h1>
            <p class="text-slate-400 mt-1">Crea una nueva división para un nivel académico específico.</p>
        </div>

        <!-- Form Card -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <form action="{{ route('section.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Section Name -->
                    <div class="space-y-2">
                        <label for="section"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nombre de la
                            Sección</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-layers-linked"></i>
                            </div>
                            <input type="text" name="section" id="section" value="{{ old('section') }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none"
                                placeholder="Ej: Sección A">
                        </div>
                        @error('section')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Categoría</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-tag"></i>
                            </div>
                            <input type="text" name="category" id="category" value="{{ old('category') }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none"
                                placeholder="Ej: Matutino, Vespertino">
                        </div>
                        @error('category')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Class Selection -->
                    <div class="space-y-2">
                        <label for="classesID"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Clase
                            Vinculada</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-school"></i>
                            </div>
                            <select name="classesID" id="classesID" required
                                class="w-full pl-11 pr-10 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none appearance-none">
                                <option value="" disabled selected>Selecciona una clase</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ old('classesID') == $class->classesID ? 'selected' : '' }}>
                                        {{ $class->classes }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                                <i class="ti ti-selector"></i>
                            </div>
                        </div>
                        @error('classesID')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacity -->
                    <div class="space-y-2">
                        <label for="capacity"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Capacidad
                            Máxima</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-users"></i>
                            </div>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" required
                                min="1"
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none"
                                placeholder="Ej: 30">
                        </div>
                        @error('capacity')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mentor Selection -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="teacherID"
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Docente
                            Mentor</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-user-star"></i>
                            </div>
                            <select name="teacherID" id="teacherID" required
                                class="w-full pl-11 pr-10 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none appearance-none">
                                <option value="" disabled selected>Selecciona un mentor</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->teacherID }}"
                                        {{ old('teacherID') == $teacher->teacherID ? 'selected' : '' }}>
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
                                class="absolute top-4 left-4 pointer-events-none text-slate-500 group-focus-within:text-cyan-400 transition-colors">
                                <i class="ti ti-notes"></i>
                            </div>
                            <textarea name="note" id="note" rows="3"
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10 transition-all outline-none"
                                placeholder="Cualquier información adicional...">{{ old('note') }}</textarea>
                        </div>
                        @error('note')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-8 border-t border-slate-700/50 flex items-center justify-end gap-4">
                    <a href="{{ route('section.index') }}"
                        class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-300 rounded-2xl transition-all font-bold text-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-2xl transition-all shadow-lg shadow-cyan-600/20 active:scale-95 text-sm">
                        Guardar Sección
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
