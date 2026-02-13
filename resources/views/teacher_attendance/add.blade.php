<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav class="flex items-center gap-3 text-slate-400 mb-2">
                    <a href="{{ route('tattendance.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-user-check text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Asistencia Docente') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Toma de Datos') }}</span>
                </nav>
                <h1
                    class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase italic underline decoration-emerald-500/30 decoration-8 underline-offset-8 text-nowrap">
                    {{ __('Control de Personal') }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 mt-8">
                    <div
                        class="px-6 py-3 bg-emerald-600 text-white rounded-2xl flex items-center gap-3 shadow-xl shadow-emerald-600/20">
                        <i class="ti ti-calendar text-lg opacity-70"></i>
                        <span class="text-xs font-black uppercase tracking-[0.2em]">{{ $dateInput }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Real-Time -->
            <div
                class="flex items-center gap-4 bg-white dark:bg-slate-800/50 p-3 rounded-[32px] border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
                <div class="px-6 py-2 flex flex-col items-center">
                    <span id="stat-p" class="text-xl font-black text-emerald-600 leading-tight">0</span>
                    <span
                        class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ __('Presentes') }}</span>
                </div>
                <div class="w-px h-8 bg-slate-100 dark:bg-slate-700"></div>
                <div class="px-6 py-2 flex flex-col items-center">
                    <span id="stat-a" class="text-xl font-black text-rose-600 leading-tight">0</span>
                    <span
                        class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ __('Ausentes') }}</span>
                </div>
                <div class="w-px h-8 bg-slate-100 dark:bg-slate-700"></div>
                <div class="px-6 py-2 flex flex-col items-center">
                    <span id="stat-l" class="text-xl font-black text-amber-600 leading-tight">0</span>
                    <span
                        class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ __('Tardanzas') }}</span>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="mb-6 flex justify-end gap-3">
            <button onclick="markAll('P')"
                class="px-6 py-3 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-emerald-200 dark:border-emerald-500/20 hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                {{ __('Presente Todos') }}
            </button>
            <button onclick="markAll('A')"
                class="px-6 py-3 bg-rose-100 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-rose-200 dark:border-rose-500/20 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
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
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Código') }}</span>
                            </th>
                            <th class="px-6 py-6 text-left">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Personal') }}</span>
                            </th>
                            <th class="px-6 py-6 text-center">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Acción') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse($teachers as $teacher)
                            @php
                                $currentStatus = $attendances[$teacher->teacherID]->$aday ?? 'N';
                            @endphp
                            <tr
                                class="group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all duration-300">
                                <td class="px-10 py-6">
                                    <span
                                        class="text-xs font-black text-slate-400 group-hover:text-emerald-500 transition-colors">T-{{ str_pad($teacher->teacherID, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 bg-slate-100 dark:bg-slate-900 rounded-[20px] flex items-center justify-center border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden group-hover:scale-105 group-hover:rotate-2 transition-transform">
                                            @if ($teacher->photo)
                                                <img src="{{ asset('uploads/images/' . $teacher->photo) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <i class="ti ti-user-star text-2xl text-slate-400"></i>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $teacher->name }}</span>
                                            <span
                                                class="text-[9px] font-bold text-slate-400 uppercase tracking-widest italic">{{ $teacher->designation }}
                                                — {{ $teacher->dni }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div
                                        class="flex items-center justify-center gap-3 bg-slate-50 dark:bg-slate-900/50 w-max mx-auto p-2 rounded-[24px] border border-slate-200/50 dark:border-slate-700/50 shadow-inner">
                                        <!-- Present (P) -->
                                        <button type="button"
                                            onclick="saveTeacherAttendance('{{ $teacher->teacherID }}', 'P')"
                                            id="btn-P-{{ $teacher->teacherID }}"
                                            class="attendance-btn w-12 h-12 rounded-2xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'P' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-emerald-50 dark:hover:bg-emerald-500/10' }}"
                                            data-status="P">
                                            <i class="ti ti-check text-2xl"></i>
                                        </button>

                                        <!-- Late (L) -->
                                        <button type="button"
                                            onclick="saveTeacherAttendance('{{ $teacher->teacherID }}', 'L')"
                                            id="btn-L-{{ $teacher->teacherID }}"
                                            class="attendance-btn w-12 h-12 rounded-2xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'L' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/30 ring-4 ring-amber-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-amber-50 dark:hover:bg-amber-500/10' }}"
                                            data-status="L">
                                            <i class="ti ti-clock text-2xl"></i>
                                        </button>

                                        <!-- Absent (A) -->
                                        <button type="button"
                                            onclick="saveTeacherAttendance('{{ $teacher->teacherID }}', 'A')"
                                            id="btn-A-{{ $teacher->teacherID }}"
                                            class="attendance-btn w-12 h-12 rounded-2xl flex items-center justify-center transition-all hover:scale-110 active:scale-90 {{ $currentStatus == 'A' ? 'bg-rose-600 text-white shadow-lg shadow-rose-500/30 ring-4 ring-rose-500/10' : 'bg-white dark:bg-slate-800 text-slate-400 hover:bg-rose-50 dark:hover:bg-rose-500/10' }}"
                                            data-status="A">
                                            <i class="ti ti-x text-2xl"></i>
                                        </button>

                                        <!-- Clear (N) -->
                                        <button type="button"
                                            onclick="saveTeacherAttendance('{{ $teacher->teacherID }}', 'N')"
                                            class="w-10 h-12 text-slate-300 hover:text-rose-400 transition-colors uppercase text-[8px] font-black tracking-widest border-l border-slate-200 dark:border-slate-700/50 pl-2 ml-1">
                                            {{ __('Borr') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="px-10 py-24 text-center text-slate-400 font-black uppercase tracking-widest italic">
                                    {{ __('No hay registros') }}
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
            const teacherAttendanceConfig = {
                date: "{{ $dateInput }}",
                _token: "{{ csrf_token() }}"
            };

            function saveTeacherAttendance(teacherID, status) {
                const btns = document.querySelectorAll(`#btn-P-${teacherID}, #btn-L-${teacherID}, #btn-A-${teacherID}`);

                // UI Feedback
                btns.forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'bg-amber-500', 'bg-rose-600', 'text-white', 'shadow-lg',
                        'ring-4');
                    btn.classList.add('bg-white', 'dark:bg-slate-800', 'text-slate-400');
                });

                if (status !== 'N') {
                    const activeBtn = document.getElementById(`btn-${status}-${teacherID}`);
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
                fetch("{{ route('tattendance.save') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": teacherAttendanceConfig._token
                        },
                        body: JSON.stringify({
                            teacherID: teacherID,
                            date: teacherAttendanceConfig.date,
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            updateStats();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.error || 'No se pudo registrar la asistencia.',
                                background: document.documentElement.classList.contains('dark') ? '#0f172a' :
                                    '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                            });
                        }
                    })
                    .catch(err => console.error(err));
            }

            async function markAll(status) {
                const teachers = @json($teachers->pluck('teacherID'));
                const statusLabel = status === 'P' ? 'PRESENTES' : 'AUSENTES';

                const result = await Swal.fire({
                    title: '¿Confirmar Acción?',
                    text: `Se marcará a todo el personal como ${statusLabel}.`,
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
                    teachers.forEach(id => saveTeacherAttendance(id, status));

                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Cambio aplicado satisfactoriamente.',
                        timer: 1500,
                        showConfirmButton: false,
                        background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                        borderRadius: '40px',
                    });
                }
            }

            function updateStats() {
                const p = document.querySelectorAll('.attendance-btn.bg-emerald-600').length;
                const a = document.querySelectorAll('.attendance-btn.bg-rose-600').length;
                const l = document.querySelectorAll('.attendance-btn.bg-amber-500').length;

                document.getElementById('stat-p').innerText = p;
                document.getElementById('stat-a').innerText = a;
                document.getElementById('stat-l').innerText = l;
            }

            document.addEventListener('DOMContentLoaded', updateStats);
        </script>
    @endpush
</x-app-layout>
