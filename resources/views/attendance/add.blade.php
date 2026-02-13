<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400">
                <a href="{{ route('attendance.index') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-calendar-check text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Asistencia') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60">{{ __('Toma de Datos') }}</span>
            </nav>

            <!-- Title & Control Panel -->
            <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-12">
                <div class="space-y-4">
                    <h1
                        class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                        {{ __('Control de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Estudiantes') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                        {{ __('Registro de asistencia escolar en tiempo real') }}
                    </p>
                </div>

                <div class="relative">
                    <!-- Glass Container for Controls -->
                    <div
                        class="bg-white/70 dark:bg-slate-900/40 backdrop-blur-2xl p-6 rounded-[3rem] border border-white dark:border-slate-800 shadow-2xl shadow-emerald-500/10 flex flex-col gap-4 min-w-[340px]">

                        <!-- Date Selector -->
                        <form action="{{ route('attendance.add') }}" method="GET" id="dateForm">
                            <input type="hidden" name="classesID" value="{{ $class->classesID }}">
                            <input type="hidden" name="sectionID" value="{{ $section->sectionID }}">
                            @if ($subjectID)
                                <input type="hidden" name="subjectID" value="{{ $subjectID }}">
                            @endif

                            <div class="relative group">
                                <i
                                    class="ti ti-calendar-event absolute left-5 top-1/2 -translate-y-1/2 text-emerald-500 pointer-events-none transition-transform group-hover:scale-110 z-10 text-xl"></i>
                                <input type="date" name="date" id="datePicker"
                                    value="{{ \Illuminate\Support\Carbon::parse($dateInput)->format('Y-m-d') }}"
                                    max="{{ date('Y-m-d') }}" onchange="this.form.submit()"
                                    class="w-full pl-14 pr-8 py-4 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white rounded-[2rem] text-[11px] font-black uppercase tracking-widest shadow-inner border border-slate-100 dark:border-slate-700/50 focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all cursor-pointer">
                            </div>
                        </form>

                        <!-- Context Badges -->
                        <div class="flex flex-col gap-2">
                            <div
                                class="px-6 py-4 bg-slate-950 dark:bg-white dark:text-slate-950 text-white rounded-[2rem] text-[10px] font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 flex items-center justify-between group overflow-hidden relative">
                                <div class="flex items-center gap-3 relative z-10">
                                    <i class="ti ti-school text-lg text-emerald-500"></i>
                                    <span>{{ $class->classes }} — {{ $section->section }}</span>
                                </div>
                                <i
                                    class="ti ti-chevron-right text-slate-500 dark:text-slate-300 relative z-10 group-hover:translate-x-1 transition-transform"></i>
                            </div>

                            @if ($attendance_type == 'subject')
                                <div
                                    class="px-6 py-4 bg-emerald-600 text-white rounded-[2rem] text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/20 flex items-center gap-3">
                                    <i class="ti ti-book text-lg"></i>
                                    <span>{{ $subjects->where('subjectID', $subjectID)->first()->subject ?? '' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Decorative element -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-500/10 blur-3xl rounded-full -z-10"></div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="mb-6 flex justify-end gap-3">
            <button onclick="markAll('P')"
                class="px-6 py-3 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-emerald-200 dark:border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all">
                {{ __('Presente Todos') }}
            </button>
            <button onclick="markAll('T')"
                class="px-6 py-3 bg-orange-100 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-orange-200 dark:border-orange-500/20 hover:bg-orange-600 hover:text-white transition-all">
                {{ __('Tarde Todos') }}
            </button>
            <button onclick="markAll('A')"
                class="px-6 py-3 bg-rose-100 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-rose-200 dark:border-rose-500/20 hover:bg-rose-600 hover:text-white transition-all">
                {{ __('Ausente Todos') }}
            </button>

        </div>

        <!-- Attendance List -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700/50">
                            <th class="px-10 py-6 text-left">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Orden') }}</span>
                            </th>
                            <th class="px-6 py-6 text-left">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Estudiante') }}</span>
                            </th>
                            <th class="px-6 py-6 text-center">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Acción de Asistencia') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse($students as $student)
                            @php
                                $currentStatus = $attendances[$student->studentID]->$aday ?? 'N';
                            @endphp
                            <tr
                                class="group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all duration-300">
                                <td class="px-10 py-6">
                                    <span
                                        class="text-xs font-black text-slate-400 group-hover:text-emerald-500 transition-colors">#{{ str_pad($student->roll, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-slate-100 dark:bg-slate-900 rounded-2xl flex items-center justify-center border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden group-hover:scale-110 group-hover:rotate-3 transition-transform">
                                            @if ($student->photo)
                                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <i class="ti ti-user text-2xl text-slate-400"></i>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-black text-slate-700 dark:text-slate-200 uppercase tracking-tight">{{ $student->name }}</span>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">{{ __('DNI:') }}
                                                {{ $student->dni }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div
                                        class="flex items-center justify-center gap-3 bg-slate-50 dark:bg-slate-900/50 w-max mx-auto p-2 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-inner">
                                        <!-- Present (P) -->
                                        <button type="button"
                                            onclick="saveAttendance('{{ $student->studentID }}', 'P')"
                                            id="btn-P-{{ $student->studentID }}"
                                            class="attendance-btn w-12 h-12 rounded-xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'P' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-emerald-50 dark:hover:bg-emerald-500/10' }}"
                                            title="{{ __('Presente') }}">
                                            <i class="ti ti-check text-2xl"></i>
                                        </button>

                                        <!-- Late (L) -->
                                        <button type="button"
                                            onclick="saveAttendance('{{ $student->studentID }}', 'L')"
                                            id="btn-L-{{ $student->studentID }}"
                                            class="attendance-btn w-12 h-12 rounded-xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'L' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/30 ring-4 ring-amber-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-amber-50 dark:hover:bg-amber-500/10' }}"
                                            title="{{ __('Tarde') }}">
                                            <i class="ti ti-clock text-2xl"></i>
                                        </button>

                                        <!-- Absent (A) -->
                                        <button type="button"
                                            onclick="saveAttendance('{{ $student->studentID }}', 'A')"
                                            id="btn-A-{{ $student->studentID }}"
                                            class="attendance-btn w-12 h-12 rounded-xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'A' ? 'bg-rose-600 text-white shadow-lg shadow-rose-500/30 ring-4 ring-rose-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-rose-50 dark:hover:bg-rose-500/10' }}"
                                            title="{{ __('Ausente') }}">
                                            <i class="ti ti-x text-2xl"></i>
                                        </button>

                                        <!-- Clear (N) -->
                                        <button type="button"
                                            onclick="saveAttendance('{{ $student->studentID }}', 'N')"
                                            class="w-8 h-12 text-slate-300 hover:text-rose-400 transition-colors uppercase text-[8px] font-black tracking-tighter"
                                            title="{{ __('Limpiar') }}">
                                            {{ __('BORRAR') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-10 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-4">
                                        <div
                                            class="w-24 h-24 bg-slate-50 dark:bg-slate-900/50 rounded-full flex items-center justify-center text-slate-200">
                                            <i class="ti ti-users-off text-6xl"></i>
                                        </div>
                                        <p class="text-slate-400 font-black uppercase tracking-widest">
                                            {{ __('No hay estudiantes en este grupo') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Actions Footer -->
        <div
            class="mt-12 p-8 md:p-10 rounded-[3rem] md:rounded-[4rem] bg-slate-900 dark:bg-slate-800/40 border border-slate-800 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl relative overflow-hidden group">
            <div
                class="absolute inset-0 bg-linear-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 bg-emerald-500/10 rounded-[24px] flex items-center justify-center text-emerald-500 shadow-inner">
                    <i class="ti ti-device-floppy text-4xl animate-pulse"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="text-xl font-black text-white uppercase tracking-tight italic">
                        {{ __('Sincronización Activa') }}</h3>
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                        {{ __('Los cambios se guardan automáticamente') }}</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto relative z-10 text-nowrap">
                <button onclick="window.location.href='{{ route('attendance.index') }}'"
                    class="w-full sm:w-auto px-10 py-5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] transition-all border border-slate-700 active:scale-95 text-nowrap">
                    {{ __('Finalizar y Salir') }}
                </button>
                <button onclick="submitAttendance()" id="mainSaveBtn"
                    class="w-full sm:w-auto px-12 py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-emerald-500/20 text-nowrap">
                    {{ __('Guardar Asistencia') }}
                </button>
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
            const attendanceData = {
                classesID: "{{ $class->classesID }}",
                sectionID: "{{ $section->sectionID }}",
                subjectID: "{{ $subjectID }}",
                date: "{{ $dateInput }}",
                _token: "{{ csrf_token() }}"
            };

            // Tracking state
            const currentStatuses = {};
            const originalStatuses = {};
            @foreach ($students as $student)
                @php $stat = $attendances[$student->studentID]->$aday ?? 'N'; @endphp
                currentStatuses[{{ $student->studentID }}] = "{{ $stat }}";
                originalStatuses[{{ $student->studentID }}] = "{{ $stat }}";
            @endforeach

            function saveAttendance(studentID, status) {
                // Map T (Tarde) to L (Late) if applicable for UI IDs
                const uiStatus = status === 'T' ? 'L' : status;
                const btns = document.querySelectorAll(`#btn-P-${studentID}, #btn-L-${studentID}, #btn-A-${studentID}`);

                // Track change
                currentStatuses[studentID] = uiStatus;
                updateButtonText();

                // Temporary UI update
                btns.forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'bg-amber-500', 'bg-rose-600', 'text-white', 'shadow-lg',
                        'ring-4');
                    btn.classList.add('bg-white', 'dark:bg-slate-800', 'text-slate-400');
                });

                if (uiStatus !== 'N') {
                    const activeBtn = document.getElementById(`btn-${uiStatus}-${studentID}`);
                    let colorClass = 'bg-emerald-600';
                    let shadowClass = 'shadow-emerald-500/30';
                    let ringClass = 'ring-emerald-500/10';

                    if (uiStatus === 'L') {
                        colorClass = 'bg-amber-500';
                        shadowClass = 'shadow-amber-500/30';
                        ringClass = 'ring-amber-500/10';
                    }
                    if (uiStatus === 'A') {
                        colorClass = 'bg-rose-600';
                        shadowClass = 'shadow-rose-500/30';
                        ringClass = 'ring-rose-500/10';
                    }

                    if (activeBtn) {
                        activeBtn.classList.remove('bg-white', 'dark:bg-slate-800', 'text-slate-400');
                        activeBtn.classList.add(colorClass, 'text-white', 'shadow-lg', shadowClass, 'ring-4', ringClass);
                    }
                }

                // Persistence
                fetch("{{ route('attendance.save') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": attendanceData._token
                        },
                        body: JSON.stringify({
                            studentID: studentID,
                            classesID: attendanceData.classesID,
                            sectionID: attendanceData.sectionID,
                            subjectID: attendanceData.subjectID,
                            date: attendanceData.date,
                            status: uiStatus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No se pudo guardar la asistencia.',
                                background: document.documentElement.classList.contains('dark') ? '#0f172a' :
                                    '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                            });
                        }
                    })
                    .catch(err => console.error(err));
            }

            function updateButtonText() {
                const btn = document.getElementById('mainSaveBtn');
                let changed = false;
                for (let id in currentStatuses) {
                    if (currentStatuses[id] !== originalStatuses[id]) {
                        changed = true;
                        break;
                    }
                }
                btn.innerText = changed ? "{{ __('Actualizar Asistencia') }}" : "{{ __('Guardar Asistencia') }}";
            }

            function submitAttendance() {
                const totalStudents = Object.keys(currentStatuses).length;
                let markedCount = 0;
                for (let id in currentStatuses) {
                    if (currentStatuses[id] !== 'N') markedCount++;
                }

                if (markedCount < totalStudents) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incompleto',
                        text: `Faltan marcar ${totalStudents - markedCount} estudiantes. Por favor, completa todo el registro.`,
                        background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                        confirmButtonColor: '#10b981',
                        borderRadius: '40px',
                    });
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Todo el registro ha sido validado y guardado correctamente.',
                    timer: 2000,
                    showConfirmButton: false,
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                    borderRadius: '40px',
                });

                // Update original status after "save"
                for (let id in currentStatuses) {
                    originalStatuses[id] = currentStatuses[id];
                }
                updateButtonText();
            }

            async function markAll(status) {
                const students = @json($students->pluck('studentID'));
                let colorName, confirmColor;

                if (status === 'P') {
                    colorName = '{{ __('ESMERALDA (Presente)') }}';
                    confirmColor = '#10b981';
                } else if (status === 'T') {
                    colorName = '{{ __('NARANJA (Tarde)') }}';
                    confirmColor = '#f59e0b';
                } else {
                    colorName = '{{ __('ROSA (Ausente)') }}';
                    confirmColor = '#e11d48';
                }

                const result = await Swal.fire({
                    title: '{{ __('¿MARCAR TODOS?') }}',
                    text: `{{ __('Se marcará a todo el salón como') }} ${colorName}.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('SÍ, MARCAR TODOS') }}',
                    cancelButtonText: '{{ __('CANCELAR') }}',
                    confirmButtonColor: confirmColor,
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                    borderRadius: '40px',
                });

                if (result.isConfirmed) {
                    // Sequential or Promise.all - for better UX, let's do Promise.all but show UI immediately
                    students.forEach(id => saveAttendance(id, status));

                    Swal.fire({
                        icon: 'success',
                        title: 'LISTO',
                        text: 'Asistencia actualizada para todo el grupo.',
                        timer: 1500,
                        showConfirmButton: false,
                        background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                        borderRadius: '40px',
                    });
                }
            }
        </script>
    @endpush
</x-app-layout>
