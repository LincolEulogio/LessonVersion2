<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-6">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-smart-home text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Dashboard') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60">{{ __('Académico') }}</span>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Asistencia de Examen') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                        {{ __('Control de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Asistencia') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                        {{ __('Registro de puntualidad estudiantil en evaluaciones') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] shadow-sm overflow-hidden mb-12">
            <form action="{{ route('exam_attendance.index') }}" method="GET" class="p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 items-end">
                    <!-- Exam Selection -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Examen') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-file-certificate absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select name="examID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-100 dark:bg-slate-900/50 border-transparent rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-bold text-sm">
                                <option value="">{{ __('Seleccionar...') }}</option>
                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->examID }}"
                                        {{ $examID == $exam->examID ? 'selected' : '' }}>{{ $exam->exam }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Class Selection -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Clase Principal') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="classesID" name="classesID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-100 dark:bg-slate-900/50 border-transparent rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-bold text-sm">
                                <option value="">{{ __('Seleccionar...') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ $classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Section Selection -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Sección') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-layout-grid absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="sectionID" name="sectionID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-100 dark:bg-slate-900/50 border-transparent rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none font-bold text-sm {{ !$classesID ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
                                @if (!$classesID) disabled @endif>
                                <option value="">{{ __('Seleccionar...') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->sectionID }}"
                                        {{ $sectionID == $section->sectionID ? 'selected' : '' }}>
                                        {{ $section->section }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Subject Selection -->
                    <div class="space-y-3 group/item">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 group-focus-within/item:text-emerald-500 transition-colors">
                            {{ __('Materia') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-book absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/item:text-emerald-500 transition-colors z-10 text-lg"></i>
                            <select id="subjectID" name="subjectID"
                                class="w-full pl-14 pr-6 py-4 bg-slate-100 dark:bg-slate-900/50 border-transparent rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none font-bold text-sm {{ !$classesID ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
                                @if (!$classesID) disabled @endif>
                                <option value="">{{ __('Seleccionar...') }}</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subjectID }}"
                                        {{ $subjectID == $subject->subjectID ? 'selected' : '' }}>
                                        {{ $subject->subject }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="lg:col-span-4 mt-6 flex justify-center">
                        <button type="submit"
                            class="px-16 py-5 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-3xl shadow-xl shadow-emerald-500/20 transition-all hover:scale-[1.02] active:scale-[1] uppercase tracking-widest text-[11px] flex items-center gap-3">
                            <i class="ti ti-search text-lg"></i>
                            {{ __('Cargar Estudiantes') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (!empty($students))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($students as $student)
                    @php
                        $current_status = $attendances->get($student->studentID)->eattendance ?? null;
                    @endphp
                    <div class="student-row group p-8 rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-emerald-500/5 {{ $current_status ? ($current_status == 'P' ? 'ring-2 ring-emerald-500/20' : 'ring-2 ring-rose-500/20') : '' }}"
                        data-student-id="{{ $student->studentID }}">

                        <div class="flex flex-col items-center text-center mb-8">
                            <div class="relative mb-4">
                                <div
                                    class="w-24 h-24 rounded-[2rem] bg-slate-100 dark:bg-slate-900/40 overflow-hidden ring-8 ring-slate-100 dark:ring-slate-800/50 shadow-inner group-hover:scale-105 transition-transform duration-500">
                                    <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                        class="w-full h-full object-cover">
                                </div>
                                @if ($current_status)
                                    <div
                                        class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full border-4 border-white dark:border-slate-800 flex items-center justify-center {{ $current_status == 'P' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                        <i
                                            class="ti {{ $current_status == 'P' ? 'ti-check' : 'ti-x' }} text-white text-xs"></i>
                                    </div>
                                @endif
                            </div>

                            <h4
                                class="text-slate-800 dark:text-slate-100 font-black truncate tracking-tight uppercase leading-tight text-sm w-full">
                                {{ $student->name }}
                            </h4>
                            <span
                                class="text-[9px] text-slate-400 font-black uppercase tracking-widest mt-2 px-3 py-1 bg-slate-100 dark:bg-slate-900/50 rounded-full">
                                {{ __('Roll') }}: {{ $student->roll }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <button onclick="saveExamAttendance({{ $student->studentID }}, 'P', this)"
                                class="status-btn p-5 rounded-3xl flex flex-col items-center gap-2 transition-all group/btn {{ $current_status == 'P' ? 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-emerald-50 hover:text-emerald-500' }}"
                                data-status="P">
                                <i class="ti ti-check text-2xl group-hover/btn:scale-110 transition-transform"></i>
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest leading-none">{{ __('Vino') }}</span>
                            </button>

                            <button onclick="saveExamAttendance({{ $student->studentID }}, 'A', this)"
                                class="status-btn p-5 rounded-3xl flex flex-col items-center gap-2 transition-all group/btn {{ $current_status == 'A' ? 'bg-rose-500 text-white shadow-xl shadow-rose-500/30' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-rose-50 hover:text-rose-500' }}"
                                data-status="A">
                                <i class="ti ti-x text-2xl group-hover/btn:scale-110 transition-transform"></i>
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest leading-none">{{ __('Faltó') }}</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Finalize Actions -->
            <div class="mt-16 flex flex-col items-center gap-6">
                <div
                    class="h-px w-full max-w-md bg-linear-to-r from-transparent via-slate-200 dark:via-slate-700 to-transparent">
                </div>
                <button onclick="finalizeAttendance()"
                    class="group relative px-12 py-5 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-[2rem] shadow-2xl shadow-emerald-500/30 transition-all hover:scale-[1.05] active:scale-[0.98] uppercase tracking-[0.2em] text-xs flex items-center gap-4 overflow-hidden">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                    <i class="ti ti-checklist text-xl"></i>
                    <span>{{ __('Guardar Lista Completa') }}</span>
                </button>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    {{ __('Asegúrate de haber llamado a todos los estudiantes antes de finalizar') }}</p>
            </div>
        @else
            <div
                class="py-24 text-center rounded-[4rem] border-4 border-dashed border-slate-100 dark:border-slate-800/30 bg-slate-50/10 backdrop-blur-sm">
                <div
                    class="w-32 h-32 bg-slate-100 dark:bg-slate-800/50 rounded-[3rem] flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <i class="ti ti-users text-6xl text-slate-300"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                    {{ __('Registro de Asistencia') }}</h3>
                <p
                    class="text-slate-400 max-w-sm mx-auto mt-4 text-[11px] font-black uppercase tracking-[0.2em] leading-relaxed">
                    {{ __('Selecciona los filtros para cargar la lista de alumnos') }}
                </p>
            </div>
        @endif
    </div>

    <script>
        function finalizeAttendance() {
            const students = document.querySelectorAll('.student-row');
            const unmarked = [];

            students.forEach(card => {
                const hasStatus = card.querySelector('.absolute.-bottom-2.-right-2');
                if (!hasStatus) {
                    const name = card.querySelector('h4').textContent.trim();
                    unmarked.push(name);
                    card.classList.add('ring-4', 'ring-rose-500/50', 'bg-rose-500/5');
                } else {
                    card.classList.remove('ring-4', 'ring-rose-500/50', 'bg-rose-500/5');
                }
            });

            if (unmarked.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lista Incompleta',
                    html: `<p class="mb-4">Faltan <b>${unmarked.length}</b> estudiantes por llamar:</p>
                           <div class="text-left bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl text-xs max-h-40 overflow-y-auto">
                               ${unmarked.map(name => `• ${name}`).join('<br>')}
                           </div>`,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#10b981',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡Todo listo!',
                    text: 'Se ha registrado la asistencia de todos los estudiantes.',
                    confirmButtonText: 'Finalizar',
                    confirmButtonColor: '#10b981',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                }).then(() => {
                    window.location.href = "{{ route('exam_attendance.index') }}";
                });
            }
        }

        function saveExamAttendance(studentID, status, btn) {
            const card = btn.closest('.student-row');
            const btns = card.querySelectorAll('.status-btn');
            const studentName = card.querySelector('h4').textContent.trim();
            const avatarContainer = card.querySelector('.relative.mb-4');

            const activeStyles = {
                P: 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 ring-4 ring-emerald-500/20 scale-[1.05]',
                A: 'bg-rose-500 text-white shadow-xl shadow-rose-500/30 ring-4 ring-rose-500/20 scale-[1.05]'
            };

            const idleStyles = {
                P: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-emerald-50 hover:text-emerald-500',
                A: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-rose-50 hover:text-rose-500'
            };

            const cardClasses = {
                P: 'ring-2 ring-emerald-500/20 bg-emerald-500/[0.02]',
                A: 'ring-2 ring-rose-500/20 bg-rose-500/[0.02]'
            };

            btn.classList.add('animate-pulse');

            fetch("{{ route('exam_attendance.save') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        examID: '{{ $examID }}',
                        classesID: '{{ $classesID }}',
                        sectionID: '{{ $sectionID }}',
                        subjectID: '{{ $subjectID }}',
                        studentID: studentID,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.classList.remove('animate-pulse');
                    if (data.success) {
                        // Update buttons
                        btns.forEach(b => {
                            const bStatus = b.getAttribute('data-status');
                            b.className =
                                `status-btn p-5 rounded-3xl flex flex-col items-center gap-2 transition-all duration-300 group/btn ${idleStyles[bStatus]}`;
                        });
                        btn.className =
                            `status-btn p-5 rounded-3xl flex flex-col items-center gap-2 transition-all duration-300 group/btn ${activeStyles[status]}`;

                        // Update card appearance
                        card.classList.remove('ring-2', 'ring-4', 'ring-emerald-500/20', 'ring-rose-500/20',
                            'ring-rose-500/50', 'bg-emerald-500/[0.02]', 'bg-rose-500/[0.02]', 'bg-rose-500/5');
                        card.className += ' ' + cardClasses[status];

                        // Update small status badge on photo
                        let badge = avatarContainer.querySelector('.absolute.-bottom-2.-right-2');
                        if (!badge) {
                            badge = document.createElement('div');
                            badge.className =
                                'absolute -bottom-2 -right-2 w-8 h-8 rounded-full border-4 border-white dark:border-slate-800 flex items-center justify-center transition-all duration-300 animate-in zoom-in';
                            badge.innerHTML = '<i class="ti text-white text-xs"></i>';
                            avatarContainer.appendChild(badge);
                        }

                        badge.classList.remove('bg-emerald-50', 'bg-rose-50', 'bg-emerald-500', 'bg-rose-500');
                        badge.classList.add(status === 'P' ? 'bg-emerald-500' : 'bg-rose-500');
                        badge.querySelector('i').className =
                            `ti ${status === 'P' ? 'ti-check' : 'ti-x'} text-white text-xs`;

                        // Show detailed toast
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            background: document.documentElement.classList.contains('dark') ? '#1e293b' :
                                '#fff',
                            color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                        });

                        Toast.fire({
                            icon: 'success',
                            title: status === 'P' ? '¡Presente!' : '¡Ausente!',
                            text: `${studentName} ${status === 'P' ? 'asistió al examen' : 'no asistió al examen'}`
                        });
                    }
                })
                .catch(error => {
                    btn.classList.remove('animate-pulse');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo registrar la asistencia.',
                        background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                    });
                });
        }

        document.getElementById('classesID').addEventListener('change', function() {
            const classID = this.value;
            const sectionSelect = document.getElementById('sectionID');
            const subjectSelect = document.getElementById('subjectID');

            if (classID) {
                // Fetch Sections
                fetch(`/api/sections/${classID}/json`)
                    .then(response => response.json())
                    .then(data => {
                        sectionSelect.innerHTML = '<option value="">{{ __('Seleccionar...') }}</option>';
                        data.forEach(section => {
                            sectionSelect.innerHTML +=
                                `<option value="${section.sectionID}">${section.section}</option>`;
                        });
                        sectionSelect.disabled = false;
                        sectionSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                    });

                // Fetch Subjects
                fetch(`/api/topic/subjects/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">{{ __('Seleccionar...') }}</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                    });
            } else {
                [sectionSelect, subjectSelect].forEach(select => {
                    select.innerHTML = '<option value="">{{ __('Seleccionar...') }}</option>';
                    select.disabled = true;
                    select.classList.add('opacity-50', 'cursor-not-allowed');
                });
            }
        });
    </script>
</x-app-layout>
