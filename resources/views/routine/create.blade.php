<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('routine.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-calendar-event text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Horarios') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Nuevo') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Registrar Horario') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Define la clase, sección, materia y aula para la nueva sesión académica') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <form action="{{ route('routine.store') }}" method="POST" class="p-8 md:p-12">
                @csrf

                <div class="space-y-12">
                    <!-- Section: Academic Context -->
                    <div class="space-y-8">
                        <h3
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic border-b border-slate-100 dark:border-slate-700/50 pb-4">
                            {{ __('Contexto Académico') }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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

                            <!-- Section Selection (Dynamic) -->
                            <div class="space-y-3">
                                <label for="sectionID"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Sección') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-layout-grid absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                    <select name="sectionID" id="sectionID"
                                        class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-not-allowed font-medium text-sm leading-relaxed"
                                        disabled>
                                        <option value="" selected>{{ __('Primero selecciona una clase') }}
                                        </option>
                                    </select>
                                    <i
                                        class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                </div>
                                <x-input-error :messages="$errors->get('sectionID')" class="mt-1" />
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
                                        <option value="" selected>{{ __('Selecciona sección primero') }}</option>
                                    </select>
                                    <i
                                        class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                </div>
                                <x-input-error :messages="$errors->get('subjectID')" class="mt-1" />
                            </div>

                            <!-- Teacher Selection -->
                            <div class="space-y-3">
                                <label for="teacherID"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Docente') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-user-star absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                    <select name="teacherID" id="teacherID"
                                        class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium text-sm leading-relaxed">
                                        <option value="" disabled {{ old('teacherID') ? '' : 'selected' }}>
                                            {{ __('Busca un docente') }}</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->teacherID }}"
                                                {{ old('teacherID') == $teacher->teacherID ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                </div>
                                <x-input-error :messages="$errors->get('teacherID')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Section: Time & Location -->
                    <div class="space-y-8">
                        <h3
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic border-b border-slate-100 dark:border-slate-700/50 pb-4">
                            {{ __('Programación y Ubicación') }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Day Selection -->
                            <div class="space-y-3">
                                <label for="day"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Día') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-calendar absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                                    <select name="day" id="day"
                                        class="w-full pl-14 pr-10 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-medium text-sm leading-relaxed">
                                        <option value="" disabled {{ old('day') ? '' : 'selected' }}>
                                            {{ __('Selecciona') }}</option>
                                        @foreach ($days as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('day') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                </div>
                                <x-input-error :messages="$errors->get('day')" class="mt-1" />
                            </div>

                            <!-- Start Time -->
                            <div class="space-y-3">
                                <label for="start_time"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Hora Inicio') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-clock-play absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                    <input type="time" name="start_time" id="start_time"
                                        value="{{ old('start_time') }}"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium text-sm leading-relaxed">
                                </div>
                                <x-input-error :messages="$errors->get('start_time')" class="mt-1" />
                            </div>

                            <!-- End Time -->
                            <div class="space-y-3">
                                <label for="end_time"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Hora Fin') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-clock-stop absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                    <input type="time" name="end_time" id="end_time"
                                        value="{{ old('end_time') }}"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium text-sm leading-relaxed">
                                </div>
                                <x-input-error :messages="$errors->get('end_time')" class="mt-1" />
                            </div>

                            <!-- Room -->
                            <div class="space-y-3">
                                <label for="room"
                                    class="text-sm font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest ml-1">
                                    {{ __('Aula / Salón') }} <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative group">
                                    <i
                                        class="ti ti-door-enter absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                    <input type="text" name="room" id="room" value="{{ old('room') }}"
                                        placeholder="{{ __('Ej: Aula 102') }}"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-medium text-sm leading-relaxed">
                                </div>
                                <x-input-error :messages="$errors->get('room')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('routine.index') }}"
                            class="w-full md:w-auto px-8 py-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 font-black text-xs uppercase tracking-widest transition-all text-center">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="w-full px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 shadow-lg shadow-emerald-600/20">
                            <i class="ti ti-calendar-check text-xl"></i>
                            {{ __('Guardar Horario') }}
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
                const sectionSelect = document.getElementById('sectionID');
                const subjectSelect = document.getElementById('subjectID');

                sectionSelect.disabled = true;
                sectionSelect.innerHTML = '<option value="">Cargando...</option>';
                subjectSelect.disabled = true;
                subjectSelect.innerHTML = '<option value="">Selecciona sección primero</option>';

                fetch(`/api/topic/sections/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        sectionSelect.innerHTML =
                            '<option value="" disabled selected>Selecciona una sección</option>';
                        data.forEach(section => {
                            sectionSelect.innerHTML +=
                                `<option value="${section.sectionID}">${section.section}</option>`;
                        });
                        sectionSelect.disabled = false;
                        sectionSelect.classList.remove('cursor-not-allowed');
                    });
            });

            document.getElementById('sectionID').addEventListener('change', function() {
                const classID = document.getElementById('classesID').value;
                const subjectSelect = document.getElementById('subjectID');

                subjectSelect.disabled = true;
                subjectSelect.innerHTML = '<option value="">Cargando...</option>';

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
                    });
            });
        </script>
    @endpush
</x-app-layout>
