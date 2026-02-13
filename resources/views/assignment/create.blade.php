<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('assignment.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-clipboard-list text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Asignaciones') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Nueva Tarea') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Crear Asignación') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Define los detalles de la tarea, materia vinculada y fecha límite') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('assignment.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 md:p-12">
                @csrf

                <div class="space-y-12">
                    <!-- Section: General Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Title -->
                        <div class="space-y-3">
                            <label for="title"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Título de la Tarea') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-bookmark absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    placeholder="{{ __('Ej: Ensayo sobre la Revolución') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        <!-- Deadline -->
                        <div class="space-y-3">
                            <label for="deadlinedate"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Fecha Límite') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-calendar-time absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="date" name="deadlinedate" id="deadlinedate"
                                    value="{{ old('deadlinedate') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium">
                            </div>
                            <x-input-error :messages="$errors->get('deadlinedate')" class="mt-1" />
                        </div>

                        <!-- Class Selection -->
                        <div class="space-y-3">
                            <label for="classesID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Clase') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="classesID" id="classesID"
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium text-sm leading-relaxed">
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
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                            </div>
                            <x-input-error :messages="$errors->get('classesID')" class="mt-1" />
                        </div>

                        <!-- Subject Selection (Dynamic) -->
                        <div class="space-y-3">
                            <label for="subjectID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Materia') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-book-2 absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="subjectID" id="subjectID"
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-not-allowed font-medium text-sm leading-relaxed"
                                    disabled>
                                    <option value="" selected>{{ __('Primero selecciona una clase') }}</option>
                                </select>
                                <i
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                            </div>
                            <x-input-error :messages="$errors->get('subjectID')" class="mt-1" />
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-3 md:col-span-2">
                            <label
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Archivo Adjunto (Opcional)') }}
                            </label>
                            <div id="dropzone"
                                class="relative group border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-[30px] p-10 flex flex-col items-center justify-center gap-4 hover:border-emerald-500/50 hover:bg-emerald-50/10 transition-all cursor-pointer">
                                <input type="file" name="file" id="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="w-20 h-20 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-[25px] flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                                    <i class="ti ti-paperclip text-4xl"></i>
                                </div>
                                <div class="text-center">
                                    <p
                                        class="text-base font-black text-slate-700 dark:text-slate-200 uppercase tracking-tight">
                                        {{ __('Sube una guía o material de apoyo') }}</p>
                                    <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-widest">PDF, DOC,
                                        JPG (MAX 10MB)</p>
                                </div>
                                <div id="file-preview"
                                    class="hidden mt-4 px-4 py-2 bg-emerald-500 text-white rounded-xl text-xs font-black uppercase tracking-widest">
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
                                {{ __('Instrucciones Detalladas') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-align-left absolute left-5 top-6 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <textarea name="description" id="description" rows="5"
                                    placeholder="{{ __('Describe paso a paso lo que el estudiante debe realizar...') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none font-medium text-sm leading-relaxed">{{ old('description') }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('assignment.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 shadow-lg shadow-emerald-600/20">
                            <i class="ti ti-rocket text-xl"></i>
                            {{ __('Publicar Asignación') }}
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

            document.getElementById('classesID').addEventListener('change', function() {
                const classID = this.value;
                const subjectSelect = document.getElementById('subjectID');

                subjectSelect.disabled = true;
                subjectSelect.classList.add('cursor-not-allowed');
                subjectSelect.innerHTML = '<option value="">Cargando materias...</option>';

                fetch(`/api/topic/subjects/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML =
                            '<option value="" disabled selected>Selecciona una materia</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('cursor-not-allowed');
                    })
                    .catch(error => {
                        subjectSelect.innerHTML = '<option value="">Error al cargar materias</option>';
                        console.error('Error:', error);
                    });
            });
        </script>
    @endpush
</x-app-layout>
