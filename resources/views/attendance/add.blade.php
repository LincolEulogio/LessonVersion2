<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <!-- Header & Context -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav
                    class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4">
                    <a href="{{ route('attendance.index') }}"
                        class="hover:text-rose-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Asistencia</a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-rose-400 uppercase tracking-widest font-bold text-[10px]">Toma de Lista</span>
                </nav>
                <h1 class="text-4xl font-black text-white tracking-tight flex items-center gap-4">
                    {{ $classes->classes }}
                    <span class="text-slate-700 font-light text-2xl">/</span>
                    <span class="text-rose-400">{{ $section->section }}</span>
                </h1>
                <p class="text-slate-400 font-medium flex items-center gap-2 mt-2">
                    <i class="ti ti-calendar-event text-rose-500/50"></i>
                    Registro del día: <span
                        class="text-slate-200 font-bold underline decoration-rose-500/30 underline-offset-4">{{ $date }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <div
                    class="px-5 py-3 rounded-2xl bg-slate-900/50 border border-slate-700/50 flex items-center gap-5 shadow-inner">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Presentes</span>
                        <span id="stat-p" class="text-emerald-400 font-mono font-bold leading-none mt-1">0</span>
                    </div>
                    <div class="w-px h-8 bg-slate-700/50"></div>
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Ausentes</span>
                        <span id="stat-a" class="text-rose-400 font-mono font-bold leading-none mt-1">0</span>
                    </div>
                    <div class="w-px h-8 bg-slate-700/50"></div>
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Tardanza</span>
                        <span id="stat-l" class="text-amber-400 font-mono font-bold leading-none mt-1">0</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($attendance_type == 'subject')
            <div class="mb-8 p-6 rounded-3xl bg-indigo-500/5 border border-indigo-500/10 backdrop-blur-xl">
                <form action="{{ route('attendance.add') }}" method="GET" class="flex flex-wrap items-center gap-6">
                    <input type="hidden" name="classesID" value="{{ $classes->classesID }}">
                    <input type="hidden" name="sectionID" value="{{ $section->sectionID }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="flex-1 min-w-[250px]">
                        <label
                            class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2 block ml-1">Materia
                            Académica</label>
                        <select name="subjectID" onchange="this.form.submit()"
                            class="w-full bg-slate-900/50 border border-indigo-500/20 rounded-2xl px-5 py-3 text-white focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                            <option value="">Seleccione Materia...</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subjectID }}"
                                    {{ $subjectID == $subject->subjectID ? 'selected' : '' }}>
                                    {{ $subject->subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-3 mt-6">
                        <i class="ti ti-info-circle text-indigo-400 text-xl"></i>
                        <p class="text-xs text-slate-400 max-w-[200px]">El sistema está configurado para asistencia por
                            materia.</p>
                    </div>
                </form>
            </div>
        @endif

        @if ($attendance_type == 'subject' && !$subjectID)
            <div class="py-20 text-center rounded-3xl border-4 border-dashed border-slate-800/50 bg-slate-900/20">
                <div
                    class="w-20 h-20 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400 mx-auto mb-6">
                    <i class="ti ti-books text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Materia No Seleccionada</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Por favor, seleccione una materia académica para habilitar el
                    registro de asistencia.</p>
            </div>
        @else
            <!-- Student List Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($students as $student)
                    @php
                        $current_status = $attendances->get($student->studentID)->$aday ?? null;
                    @endphp
                    <div class="student-row group p-5 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm transition-all hover:bg-slate-800/50 shadow-lg"
                        data-student-id="{{ $student->studentID }}">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-slate-700 overflow-hidden ring-4 ring-slate-800/50">
                                <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <h4 class="text-slate-200 font-bold truncate tracking-wide text-sm">
                                    {{ $student->name }}</h4>
                                <span class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Nº Orden:
                                    {{ $loop->iteration }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <button onclick="saveAttendance({{ $student->studentID }}, 'P', this)"
                                class="status-btn p-3 rounded-2xl flex flex-col items-center gap-1 transition-all {{ $current_status == 'P' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20' : 'bg-slate-900/50 text-slate-600 hover:text-emerald-400' }}"
                                data-status="P">
                                <i class="ti ti-check text-xl"></i>
                                <span class="text-[8px] font-black uppercase tracking-widest">Asiste</span>
                            </button>

                            <button onclick="saveAttendance({{ $student->studentID }}, 'A', this)"
                                class="status-btn p-3 rounded-2xl flex flex-col items-center gap-1 transition-all {{ $current_status == 'A' ? 'bg-rose-500 text-white shadow-lg shadow-rose-500/20' : 'bg-slate-900/50 text-slate-600 hover:text-rose-400' }}"
                                data-status="A">
                                <i class="ti ti-x text-xl"></i>
                                <span class="text-[8px] font-black uppercase tracking-widest">Falta</span>
                            </button>

                            <button onclick="saveAttendance({{ $student->studentID }}, 'L', this)"
                                class="status-btn p-3 rounded-2xl flex flex-col items-center gap-1 transition-all {{ $current_status == 'L' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/20' : 'bg-slate-900/50 text-slate-600 hover:text-amber-400' }}"
                                data-status="L">
                                <i class="ti ti-clock-pause text-xl"></i>
                                <span class="text-[8px] font-black uppercase tracking-widest">Tarde</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Global Save Info -->
        <div
            class="mt-12 p-6 rounded-3xl bg-emerald-500/5 border border-emerald-500/10 flex items-center justify-between">
            <div class="flex items-center gap-4 text-emerald-400">
                <i class="ti ti-shield-check text-3xl"></i>
                <p class="text-sm font-medium">Los cambios se guardan automáticamente mediante sincronización segura.
                </p>
            </div>
            <a href="{{ route('attendance.index') }}"
                class="px-8 py-3 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all">
                Finalizar Sesión
            </a>
        </div>
    </div>

    <script>
        function saveAttendance(studentID, status, btn) {
            const card = btn.closest('.student-row');
            const btns = card.querySelectorAll('.status-btn');

            // Visual feedback
            const originalColors = {
                P: 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20',
                A: 'bg-rose-500 text-white shadow-lg shadow-rose-500/20',
                L: 'bg-amber-500 text-white shadow-lg shadow-amber-500/20'
            };

            const idleColors = {
                P: 'bg-slate-900/50 text-slate-600 hover:text-emerald-400',
                A: 'bg-slate-900/50 text-slate-600 hover:text-rose-400',
                L: 'bg-slate-900/50 text-slate-600 hover:text-amber-400'
            };

            // Loading state
            btn.classList.add('animate-pulse');

            fetch("{{ route('attendance.save') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        studentID: studentID,
                        classesID: '{{ $classes->classesID }}',
                        sectionID: '{{ $section->sectionID }}',
                        date: '{{ $date }}',
                        subjectID: '{{ $subjectID }}',
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.classList.remove('animate-pulse');
                    if (data.success) {
                        // Update buttons
                        btns.forEach(b => {
                            const s = b.getAttribute('data-status');
                            b.className =
                                `status-btn p-3 rounded-2xl flex flex-col items-center gap-1 transition-all ${idleColors[s]}`;
                        });
                        btn.className =
                            `status-btn p-3 rounded-2xl flex flex-col items-center gap-1 transition-all ${originalColors[status]}`;
                        updateStats();
                    } else {
                        alert('Error al guardar asistencia.');
                    }
                })
                .catch(error => {
                    btn.classList.remove('animate-pulse');
                    console.error('Error:', error);
                    alert('Fallo de conexión.');
                });
        }

        function updateStats() {
            const p = document.querySelectorAll('.status-btn.bg-emerald-500').length;
            const a = document.querySelectorAll('.status-btn.bg-rose-500').length;
            const l = document.querySelectorAll('.status-btn.bg-amber-500').length;

            document.getElementById('stat-p').innerText = p;
            document.getElementById('stat-a').innerText = a;
            document.getElementById('stat-l').innerText = l;
        }

        document.addEventListener('DOMContentLoaded', updateStats);
    </script>
</x-app-layout>
