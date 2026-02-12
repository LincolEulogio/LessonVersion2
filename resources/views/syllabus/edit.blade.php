<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Editar Plan de Estudios</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Actualiza la información del plan académico.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-xl rounded-3xl border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('syllabus.update', $syllabus->syllabusID) }}" method="POST"
                enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Título</label>
                    <input type="text" name="title" value="{{ old('title', $syllabus->title) }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-rose-500 transition-all"
                        placeholder="Ej: Plan Anual Matemáticas">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Clase</label>
                    <select name="classesID" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-rose-500 transition-all">
                        <option value="">Selecciona una clase</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $syllabus->classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                    @error('classesID')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Archivo
                        de Planificación</label>
                    @if ($syllabus->file)
                        <div
                            class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-700 mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="ti ti-file-text text-2xl text-rose-500"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                        {{ $syllabus->file }}</p>
                                    <p class="text-xs text-slate-500">Archivo actual</p>
                                </div>
                            </div>
                            <a href="{{ route('syllabus.download', $syllabus->syllabusID) }}"
                                class="text-rose-500 hover:text-rose-600 font-bold text-xs uppercase tracking-widest">Descargar</a>
                        </div>
                    @endif
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-2xl hover:border-rose-500 transition-colors">
                        <div class="space-y-1 text-center">
                            <i class="ti ti-upload text-4xl text-slate-400 dark:text-slate-500"></i>
                            <div class="flex text-sm text-slate-600 dark:text-slate-400">
                                <label for="file"
                                    class="relative cursor-pointer bg-transparent rounded-md font-medium text-rose-600 hover:text-rose-500 focus-within:outline-none">
                                    <span>Subir nuevo archivo</span>
                                    <input id="file" name="file" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs text-slate-500">PDF, DOC, PPT o ZIP hasta 10MB</p>
                        </div>
                    </div>
                    @error('file')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Notas
                        Adicionales</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-rose-500 transition-all"
                        placeholder="Cualquier nota adicional...">{{ old('description', $syllabus->description) }}</textarea>
                </div>

                <div
                    class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('syllabus.index') }}"
                        class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 bg-rose-600 hover:bg-rose-500 text-white font-semibold rounded-xl shadow-lg shadow-rose-500/20 transition-all">
                        Actualizar Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
