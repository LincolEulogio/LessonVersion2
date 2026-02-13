<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8">
                <a href="{{ route('examschedule.index') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-calendar-event text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Horarios') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60">{{ __('Editar Programación') }}</span>
            </nav>

            <div class="space-y-4">
                <h1
                    class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                    {{ __('Editar') }} <span class="text-emerald-500 relative inline-block">
                        {{ __('Horario') }}
                        <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                    </span>
                </h1>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                    {{ __('Actualización de los detalles de la evaluación seleccionada') }}
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] shadow-sm overflow-hidden group/form">
            <form action="{{ route('examschedule.update', $schedule->examscheduleID) }}" method="POST"
                class="p-10 space-y-10 font-bold">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Exam Period -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Examen (Periodo)') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-file-certificate absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select name="examID" id="examID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('examID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->examID }}"
                                        {{ old('examID', $schedule->examID) == $exam->examID ? 'selected' : '' }}>
                                        {{ $exam->exam }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('examID')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Class -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Clase Principal') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="classesID" name="classesID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('classesID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ old('classesID', $schedule->classesID) == $class->classesID ? 'selected' : '' }}>
                                        {{ $class->classes }}</option>
                                @endforeach
                            </select>
                            <i
                                class="ti ti-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                        @error('classesID')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-10 border-t border-slate-100 dark:border-slate-700/30">
                    <!-- Section -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Sección / Grupo') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-layout-grid absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="sectionID" name="sectionID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('sectionID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->sectionID }}"
                                        {{ old('sectionID', $schedule->sectionID) == $section->sectionID ? 'selected' : '' }}>
                                        {{ $section->section }}</option>
                                @endforeach
                            </select>
                            <i
                                class="ti ti-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                        @error('sectionID')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Materia / Asignatura') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-book absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="subjectID" name="subjectID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('subjectID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subjectID }}"
                                        {{ old('subjectID', $schedule->subjectID) == $subject->subjectID ? 'selected' : '' }}>
                                        {{ $subject->subject }}</option>
                                @endforeach
                            </select>
                            <i
                                class="ti ti-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                        @error('subjectID')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Date -->
                    <div class="space-y-3 md:col-span-2 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Fecha del Examen') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-calendar-event absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <input type="date" name="edate" value="{{ old('edate', $schedule->edate) }}"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('edate') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                        </div>
                        @error('edate')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Hora Inicio') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-clock-play absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <input type="time" name="examfrom" value="{{ old('examfrom', $schedule->examfrom) }}"
                                class="w-full pl-14 pr-4 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('examfrom') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                        </div>
                        @error('examfrom')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Hora Fin') }} <span class="text-emerald-500">*</span>
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-clock-stop absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <input type="time" name="examto" value="{{ old('examto', $schedule->examto) }}"
                                class="w-full pl-14 pr-4 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('examto') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                        </div>
                        @error('examto')
                            <p
                                class="text-[10px] font-black text-rose-500 capitalize tracking-widest ml-4 mt-2 italic animate-pulse">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Room -->
                <div class="space-y-3 group/item">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                        {{ __('Aula / Ubicación') }}
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-map-pin absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                        <input type="text" name="room" value="{{ old('room', $schedule->room) }}"
                            maxlength="255"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none"
                            placeholder="{{ __('Ej: Pabellón B - Aula 302') }}">
                    </div>
                    @error('room')
                        <p
                            class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-2 italic animate-pulse">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Actions -->
                <div
                    class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-slate-100 dark:border-slate-700/30">
                    <a href="{{ route('examschedule.index') }}"
                        class="px-8 py-4 text-[11px] font-black text-slate-400 hover:text-rose-500 uppercase tracking-widest transition-all flex items-center gap-2 group/back">
                        <i class="ti ti-chevron-left text-lg group-hover/back:-translate-x-1 transition-transform"></i>
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-16 py-5 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-3xl shadow-xl shadow-emerald-500/20 transition-all hover:scale-[1.02] active:scale-[1] uppercase tracking-widest text-[11px] flex items-center gap-3">
                        <i class="ti ti-repeat text-lg"></i>
                        {{ __('Actualizar Horario') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('classesID').addEventListener('change', function() {
            const classID = this.value;
            const sectionSelect = document.getElementById('sectionID');
            const subjectSelect = document.getElementById('subjectID');

            if (classID) {
                // Fetch Sections
                fetch(`/api/sections/${classID}/json`)
                    .then(response => response.json())
                    .then(data => {
                        sectionSelect.innerHTML = '<option value="">{{ __('Seleccionar Sección') }}</option>';
                        data.forEach(section => {
                            sectionSelect.innerHTML +=
                                `<option value="${section.sectionID}">${section.section}</option>`;
                        });
                        sectionSelect.disabled = false;
                        sectionSelect.classList.remove('opacity-50', 'bg-slate-100', 'cursor-not-allowed');
                        sectionSelect.classList.add('bg-slate-50', 'cursor-pointer');
                    });

                // Fetch Subjects
                fetch(`/api/topic/subjects/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">{{ __('Seleccionar Materia') }}</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('opacity-50', 'bg-slate-100', 'cursor-not-allowed');
                        subjectSelect.classList.add('bg-slate-50', 'cursor-pointer');
                    });
            } else {
                [sectionSelect, subjectSelect].forEach(select => {
                    select.innerHTML = '<option value="">{{ __('Esperando clase...') }}</option>';
                    select.disabled = true;
                    select.classList.add('opacity-50', 'bg-slate-100', 'cursor-not-allowed');
                    select.classList.remove('bg-slate-50', 'cursor-pointer');
                });
            }
        });
    </script>
</x-app-layout>
