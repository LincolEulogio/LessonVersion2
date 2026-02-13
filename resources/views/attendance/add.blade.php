<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav class="flex items-center gap-3 text-slate-400 mb-2">
                    <a href="{{ route('attendance.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-calendar-check text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Asistencia') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Toma de Datos') }}</span>
                </nav>
                <h1
                    class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase italic underline decoration-emerald-500/30 decoration-8 underline-offset-8">
                    {{ __('Control de Asistencia') }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <span
                        class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20">
                        {{ $dateInput }}
                    </span>
                    <span
                        class="px-4 py-2 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl">
                        {{ $class->classes }} — {{ $section->section }}
                    </span>
                    @if ($attendance_type == 'subject')
                        <span
                            class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-600/20">
                            {{ __('MATERIA:') }} {{ $subjects->where('subjectID', $subjectID)->first()->subject ?? '' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="mb-6 flex justify-end gap-3">
            <button onclick="markAll('P')"
                class="px-6 py-3 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-emerald-200 dark:border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all">
                {{ __('Presente Todos') }}
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
    </div>

    @push('scripts')
        <script>
            const attendanceData = {
                classesID: "{{ $class->classesID }}",
                sectionID: "{{ $section->sectionID }}",
                subjectID: "{{ $subjectID }}",
                date: "{{ $dateInput }}",
                _token: "{{ csrf_token() }}"
            };

            function saveAttendance(studentID, status) {
                const btns = document.querySelectorAll(`#btn-P-${studentID}, #btn-L-${studentID}, #btn-A-${studentID}`);

                // Temporary UI update
                btns.forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'bg-amber-500', 'bg-rose-600', 'text-white', 'shadow-lg',
                        'ring-4');
                    btn.classList.add('bg-white', 'dark:bg-slate-800', 'text-slate-400');
                });

                if (status !== 'N') {
                    const activeBtn = document.getElementById(`btn-${status}-${studentID}`);
                    let colorClass = 'bg-emerald-600';
                    let shadowClass = 'shadow-emerald-500/30';
                    let ringClass = 'ring-emerald-500/10';

                    if (status === 'L') {
                        colorClass = 'bg-amber-500';
                        shadowClass = 'shadow-amber-500/30';
                        ringClass = 'ring-amber-500/10';
                    }
                    if (status === 'A') {
                        colorClass = 'bg-rose-600';
                        shadowClass = 'shadow-rose-500/30';
                        ringClass = 'ring-rose-500/10';
                    }

                    activeBtn.classList.remove('bg-white', 'dark:bg-slate-800', 'text-slate-400');
                    activeBtn.classList.add(colorClass, 'text-white', 'shadow-lg', shadowClass, 'ring-4', ringClass);
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
                            status: status
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

            async function markAll(status) {
                const students = @json($students->pluck('studentID'));
                const colorName = status === 'P' ? 'ESMERALDA (Presente)' : 'ROSA (Ausente)';

                const result = await Swal.fire({
                    title: '¿MARCAR TODOS?',
                    text: `Se marcará a todo el salón en color ${colorName}.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'SÍ, MARCAR TODOS',
                    cancelButtonText: 'CANCELAR',
                    confirmButtonColor: status === 'P' ? '#10b981' : '#e11d48',
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
