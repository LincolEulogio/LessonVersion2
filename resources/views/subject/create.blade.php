<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div
            class="mb-8 items-center justify-between gap-6 bg-white dark:bg-indigo-600/5 p-8 rounded-3xl border border-slate-200 dark:border-indigo-500/10 shadow-sm dark:shadow-none backdrop-blur-md">
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('subject.index') }}"
                    class="hover:text-indigo-600 dark:hover:text-indigo-400 text-slate-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Materias</a>
                <i class="ti ti-chevron-right text-xs"></i>
                <span class="text-indigo-600 dark:text-indigo-400 uppercase tracking-widest font-bold text-[10px]">Nueva
                    Materia</span>
            </nav>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Agregar Materia al Pensum</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Define una nueva asignatura académica y establece sus
                requisitos de
                aprobación.</p>
        </div>

        <!-- Form Card -->
        <div
            class="rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden">
            <form action="{{ route('subject.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                    <!-- Subject Name -->
                    <div class="space-y-2 md:col-span-1">
                        <label for="subject"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nombre de la
                            Materia</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                                <i class="ti ti-notebook"></i>
                            </div>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                                placeholder="Ej: Álgebra Avanzada">
                        </div>
                        @error('subject')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Code -->
                    <div class="space-y-2 md:col-span-1">
                        <label for="subject_code"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Código
                            Académico</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors">
                                <i class="ti ti-code-asterisk"></i>
                            </div>
                            <input type="text" name="subject_code" id="subject_code"
                                value="{{ old('subject_code') }}" required
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-600 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none uppercase font-mono tracking-widest"
                                placeholder="Ej: MAT-101">
                        </div>
                        @error('subject_code')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Class Selection -->
                    <div class="space-y-2">
                        <label for="classesID"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nivel
                            Académico</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors">
                                <i class="ti ti-school"></i>
                            </div>
                            <select name="classesID" id="classesID" required
                                class="w-full pl-11 pr-10 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none appearance-none cursor-pointer">
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

                    <!-- Teacher Selection -->
                    <div class="space-y-2">
                        <label for="teacherID"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Docente
                            Responsable</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors">
                                <i class="ti ti-user-star"></i>
                            </div>
                            <select name="teacherID" id="teacherID" required
                                class="w-full pl-11 pr-10 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none appearance-none cursor-pointer">
                                <option value="" disabled selected>Selecciona un docente</option>
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

                    <!-- Type Selection -->
                    <div class="space-y-2">
                        <label for="type"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Tipo de
                            Materia</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="type" value="1" class="peer hidden" checked>
                                <div
                                    class="p-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-center peer-checked:border-indigo-500 peer-checked:bg-indigo-600/10 dark:peer-checked:bg-indigo-500/10 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/30 transition-all shadow-sm peer-checked:shadow-none">
                                    <span
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400">Obligatoria</span>
                                </div>
                            </label>
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="type" value="2" class="peer hidden">
                                <div
                                    class="p-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-center peer-checked:border-slate-400 dark:peer-checked:border-slate-500 peer-checked:bg-slate-200/50 dark:peer-checked:bg-slate-500/10 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/30 transition-all shadow-sm peer-checked:shadow-none">
                                    <span
                                        class="text-xs font-bold text-slate-500 dark:text-slate-400 peer-checked:text-slate-700 dark:peer-checked:text-slate-300">Opcional</span>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Score Parameters -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="passmark"
                                class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 text-center block">Min
                                (Aprobación)</label>
                            <input type="number" name="passmark" id="passmark" value="{{ old('passmark', 11) }}"
                                required min="0"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 text-center font-mono text-lg focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                            @error('passmark')
                                <p class="text-red-400 text-[10px] mt-1 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="finalmark"
                                class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 text-center block">Max
                                (Materia)</label>
                            <input type="number" name="finalmark" id="finalmark"
                                value="{{ old('finalmark', 20) }}" required min="0"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 text-center font-mono text-lg focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                            @error('finalmark')
                                <p class="text-red-400 text-[10px] mt-1 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject Author -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="subject_author"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Autor /
                            Referencia Bibliográfica</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 transition-colors">
                                <i class="ti ti-book-2"></i>
                            </div>
                            <input type="text" name="subject_author" id="subject_author"
                                value="{{ old('subject_author') }}"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-600 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                                placeholder="Ej: Editorial Santillana / Dr. Pedro Pérez">
                        </div>
                        @error('subject_author')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div
                    class="pt-8 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-4 uppercase font-bold tracking-widest text-[10px]">
                    <a href="{{ route('subject.index') }}"
                        class="px-7 py-3 bg-white dark:bg-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 rounded-2xl border border-slate-200 dark:border-transparent transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-9 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl transition-all shadow-lg shadow-indigo-600/20 active:scale-95">
                        Registrar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
