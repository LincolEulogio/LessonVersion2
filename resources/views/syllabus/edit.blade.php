<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('syllabus.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-folder-open text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Plan De Estudios') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em] text-amber-500">{{ __('Editar') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight text-balance">
                    {{ __('Editar Plan: :title', ['title' => $syllabus->title]) }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Modifica la información o actualiza el archivo del plan de estudios') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('syllabus.update', $syllabus->syllabusID) }}" method="POST"
                enctype="multipart/form-data" class="p-8 md:p-12">
                @csrf
                @method('PUT')

                <div class="space-y-12">
                    <!-- Section: General Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Title -->
                        <div class="space-y-3">
                            <label for="title"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Título del Plan') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-file-text absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $syllabus->title) }}"
                                    placeholder="{{ __('Ej: Plan Matemáticas 2026') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium text-sm leading-relaxed">
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
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
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium text-sm leading-relaxed">
                                    <option value="" disabled>{{ __('Selecciona una clase') }}</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->classesID }}"
                                            {{ old('classesID', $syllabus->classesID) == $class->classesID ? 'selected' : '' }}>
                                            {{ $class->classes }}
                                        </option>
                                    @endforeach
                                </select>
                                <i
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                            </div>
                            <x-input-error :messages="$errors->get('classesID')" class="mt-1" />
                        </div>

                        <!-- Current File & File Upload -->
                        <div class="space-y-3 md:col-span-2">
                            <label
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Archivo del Plan') }}
                            </label>

                            @if ($syllabus->file)
                                <div
                                    class="mb-4 flex items-center justify-between p-6 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-3xl">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 rotate-3">
                                            <i class="ti ti-file-check text-3xl"></i>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('Archivo Actual') }}</span>
                                            <span
                                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $syllabus->file }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('syllabus.download', $syllabus->syllabusID) }}"
                                        class="flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all hover:scale-105">
                                        <i class="ti ti-download text-base"></i>
                                        {{ __('Descargar') }}
                                    </a>
                                </div>
                            @endif

                            <div id="dropzone"
                                class="relative group border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-[30px] p-10 flex flex-col items-center justify-center gap-4 hover:border-amber-500/50 hover:bg-amber-50/10 transition-all cursor-pointer">
                                <input type="file" name="file" id="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="w-20 h-20 bg-amber-100 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-[25px] flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                                    <i class="ti ti-pencil-up text-4xl"></i>
                                </div>
                                <div class="text-center">
                                    <p
                                        class="text-base font-black text-slate-700 dark:text-slate-200 uppercase tracking-tight">
                                        {{ __('Haz clic para cambiar archivo') }}</p>
                                    <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-widest">SI NO
                                        SELECCIONAS NADA, SE MANTENDRÁ EL ACTUAL</p>
                                </div>
                                <div id="file-preview"
                                    class="hidden mt-4 px-4 py-2 bg-amber-500 text-white rounded-xl text-xs font-black uppercase tracking-widest">
                                    <i class="ti ti-file-check text-lg"></i>
                                    <span id="file-name"></span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('file')" class="mt-1" />
                        </div>

                        <!-- Description -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="description"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Descripción / Notas') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-align-left absolute left-5 top-6 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <textarea name="description" id="description" rows="5"
                                    placeholder="{{ __('Escribe una breve descripción del contenido de este plan de estudios...') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none font-medium text-sm leading-relaxed">{{ old('description', $syllabus->description) }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('syllabus.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full px-12 py-4 bg-amber-500 hover:bg-amber-400 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 shadow-lg shadow-amber-500/20">
                            <i class="ti ti-refresh text-xl"></i>
                            {{ __('Actualizar Plan') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('file').addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const preview = document.getElementById('file-preview');
                const nameSpan = document.getElementById('file-name');

                if (fileName) {
                    nameSpan.textContent = fileName;
                    preview.classList.remove('hidden');
                    preview.classList.add('flex');
                } else {
                    preview.classList.add('hidden');
                    preview.classList.remove('flex');
                }
            });
        </script>
    @endpush
</x-app-layout>
