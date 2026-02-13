<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('topic.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-books text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Temas') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Nuevo') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Registrar Tema') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Define el contenido académico para el plan de estudios') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('topic.store') }}" method="POST" class="p-8 md:p-12">
                @csrf

                <div class="space-y-12">
                    <!-- Section: Academic Context -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Class Selection -->
                        <div class="space-y-3">
                            <label for="classesID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Clase / Grado') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="classesID" id="classesID"
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium">
                                    <option value="">{{ __('Selecciona una clase') }}</option>
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

                        <!-- Subject Selection -->
                        <div class="space-y-3">
                            <label for="subjectID"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Materia') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-book absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                <select name="subjectID" id="subjectID" disabled
                                    class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none font-medium opacity-50 cursor-not-allowed">
                                    <option value="">{{ __('Primero selecciona una clase') }}</option>
                                </select>
                                <i
                                    class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                            <x-input-error :messages="$errors->get('subjectID')" class="mt-1" />
                        </div>

                        <!-- Topic Title -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="title"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Título del Tema') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-heading absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    placeholder="{{ __('Ej: Introducción a la Geometría Euclidiana') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        <!-- Description -->
                        <div class="space-y-3 md:col-span-2">
                            <label for="description"
                                class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                {{ __('Descripción del Contenido') }} <span class="text-emerald-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-align-left absolute left-5 top-6 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <textarea name="description" id="description" rows="5"
                                    placeholder="{{ __('Describe los puntos principales, objetivos o metas de este tema...') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none resize-none">{{ old('description') }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('topic.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                            <i class="ti ti-device-floppy text-xl"></i>
                            {{ __('Guardar Tema') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('classesID').addEventListener('change', function() {
                const classID = this.value;
                const subjectSelect = document.getElementById('subjectID');

                if (classID) {
                    subjectSelect.disabled = true;
                    subjectSelect.innerHTML = '<option value="">Cargando materias...</option>';

                    fetch(`/api/topic/subjects/${classID}`)
                        .then(response => response.json())
                        .then(data => {
                            subjectSelect.innerHTML = '<option value="">Selecciona una materia</option>';
                            data.forEach(subject => {
                                subjectSelect.innerHTML +=
                                    `<option value="${subject.subjectID}">${subject.subject}</option>`;
                            });
                            subjectSelect.disabled = false;
                            subjectSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                        });
                } else {
                    subjectSelect.innerHTML = '<option value="">Primero selecciona una clase</option>';
                    subjectSelect.disabled = true;
                    subjectSelect.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });
        </script>
    @endpush
</x-app-layout>
