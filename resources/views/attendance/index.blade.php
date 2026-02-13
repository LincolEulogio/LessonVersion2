<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <nav class="flex items-center gap-3 text-slate-400 mb-6 font-black uppercase tracking-[0.2em] text-[10px]">
                <i class="ti ti-calendar-check text-lg"></i>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span>{{ __('Gestión') }}</span>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500/60">{{ __('Asistencia') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-3">
                    <h1
                        class="text-6xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                        {{ __('Control de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Estudiantes') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/10 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.3em] flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        {{ __('Gestión integral de puntualidad y asistencia') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Selection Card -->
        <div class="max-w-4xl">
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden group">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-6 mb-10">
                        <div
                            class="w-16 h-16 bg-emerald-600 text-white rounded-2xl flex items-center justify-center shadow-xl shadow-emerald-600/20 rotate-3 group-hover:rotate-6 transition-transform">
                            <i class="ti ti-calendar-check text-3xl"></i>
                        </div>
                        <div>
                            <h3
                                class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight italic">
                                {{ __('Panel de Selección') }}</h3>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                                {{ __('Configura el grupo y la fecha para tomar asistencia') }}</p>
                        </div>
                    </div>

                    <form action="{{ route('attendance.add') }}" method="GET" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Class Selection -->
                            <div class="space-y-3">
                                <label for="classesID"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Seleccionar Clase') }}</label>
                                <div class="relative group/select">
                                    <i
                                        class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                                    <select name="classesID" id="classesID"
                                        class="w-full pl-14 pr-12 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('classesID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-bold text-sm">
                                        <option value="" disabled selected>{{ __('Seleccionar...') }}</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->classesID }}">{{ $class->classes }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('classesID')
                                    <p
                                        class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-1 italic animate-pulse">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Section Selection (Dynamic) -->
                            <div class="space-y-3">
                                <label for="sectionID"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Seleccionar Sección') }}</label>
                                <div class="relative group/select">
                                    <i
                                        class="ti ti-layout-grid absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                                    <select name="sectionID" id="sectionID"
                                        class="w-full pl-14 pr-12 py-4 bg-slate-100 dark:bg-slate-900/30 border {{ $errors->has('sectionID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-400 dark:text-slate-500 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-not-allowed font-bold text-sm"
                                        disabled>
                                        <option value="">{{ __('Primero elige clase') }}</option>
                                    </select>
                                </div>
                                @error('sectionID')
                                    <p
                                        class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-1 italic animate-pulse">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Date Picker -->
                            <div class="space-y-3">
                                <label for="date"
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Fecha de Asistencia') }}</label>
                                <div class="relative group/select">
                                    <i
                                        class="ti ti-calendar-event absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                                    <input type="date" name="date" id="date"
                                        value="{{ old('date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                                        class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border {{ $errors->has('date') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold text-sm cursor-pointer">
                                </div>
                                @error('date')
                                    <p
                                        class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-1 italic animate-pulse">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            <!-- Attendance Type Indicator & Optional Subject -->
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Tipo de Control') }}</label>
                                <div
                                    class="flex items-center gap-2 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl">
                                    <i
                                        class="ti {{ $attendance_type == 'subject' ? 'ti-book-2' : 'ti-sun' }} text-emerald-600 text-xl"></i>
                                    <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">
                                        {{ $attendance_type == 'subject' ? __('Por Materia') : __('Diaria') }}
                                    </span>
                                </div>

                                @if ($attendance_type == 'subject')
                                    <div id="subject_wrapper"
                                        class="hidden mt-4 animate-in fade-in slide-in-from-top-2 duration-300">
                                        <div class="relative group/select">
                                            <i
                                                class="ti ti-book-2 absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                                            <select name="subjectID" id="subjectID"
                                                class="w-full pl-14 pr-12 py-4 bg-slate-100 dark:bg-slate-900/30 border {{ $errors->has('subjectID') ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700/50' }} rounded-2xl text-slate-400 dark:text-slate-500 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-not-allowed font-bold text-sm"
                                                disabled>
                                                <option value="">{{ __('Primero elige sección') }}</option>
                                            </select>
                                            <i
                                                class="ti ti-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                        </div>
                                        @error('subjectID')
                                            <p
                                                class="text-[10px] font-black text-rose-500 uppercase tracking-widest ml-4 mt-1 italic animate-pulse">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full bg-slate-900 dark:bg-white dark:text-slate-900 text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:scale-[1.02] active:scale-95 transition-all shadow-2xl flex items-center justify-center gap-4 group">
                                <i class="ti ti-user-check text-2xl transition-transform group-hover:rotate-12"></i>
                                {{ __('Cargar Listado de Estudiantes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .flatpickr-calendar {
                background: #fff;
                border-radius: 24px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
                border: 1px solid #f1f5f9;
            }

            .dark .flatpickr-calendar {
                background: #0f172a;
                border-color: #1e293b;
                color: #fff;
            }

            .flatpickr-day.selected {
                background: #10b981 !important;
                border-color: #10b981 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
        <script>
            const attendanceType = "{{ $attendance_type }}";

            document.getElementById('classesID').addEventListener('change', function() {
                const classID = this.value;
                const sectionSelect = document.getElementById('sectionID');

                sectionSelect.disabled = true;
                sectionSelect.innerHTML = '<option value="">{{ __('Cargando...') }}</option>';
                sectionSelect.classList.add('cursor-not-allowed');

                fetch(`/api/topic/sections/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        sectionSelect.innerHTML =
                            '<option value="" disabled selected>{{ __('Selecciona Sección') }}</option>';
                        data.forEach(section => {
                            sectionSelect.innerHTML +=
                                `<option value="${section.sectionID}">${section.section}</option>`;
                        });
                        sectionSelect.disabled = false;
                        sectionSelect.classList.remove('cursor-not-allowed');
                        sectionSelect.classList.remove('bg-slate-100', 'dark:bg-slate-900/30');
                        sectionSelect.classList.add('bg-slate-50', 'dark:bg-slate-900/50');
                    });
            });

            if (attendanceType === 'subject') {
                document.getElementById('sectionID').addEventListener('change', function() {
                    const classID = document.getElementById('classesID').value;
                    const subjectSelect = document.getElementById('subjectID');
                    const subjectWrapper = document.getElementById('subject_wrapper');

                    subjectWrapper.classList.remove('hidden');
                    subjectSelect.disabled = true;
                    subjectSelect.innerHTML = '<option value="">{{ __('Cargando...') }}</option>';

                    fetch(`/api/topic/subjects/${classID}`)
                        .then(response => response.json())
                        .then(data => {
                            subjectSelect.innerHTML =
                                '<option value="" disabled selected>{{ __('Selecciona Materia') }}</option>';
                            data.forEach(subject => {
                                subjectSelect.innerHTML +=
                                    `<option value="${subject.subjectID}">${subject.subject}</option>`;
                            });
                            subjectSelect.disabled = false;
                            subjectSelect.classList.remove('cursor-not-allowed');
                            subjectSelect.classList.remove('bg-slate-100', 'dark:bg-slate-900/30');
                            subjectSelect.classList.add('bg-slate-50', 'dark:bg-slate-900/50');
                        });
                });
            }
        </script>
    @endpush
</x-app-layout>
