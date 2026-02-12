<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <!-- Header & Context -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav
                    class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4">
                    <a href="{{ route('tattendance.index') }}"
                        class="hover:text-indigo-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Asistencia
                        Docente</a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-indigo-400 uppercase tracking-widest font-bold text-[10px]">Toma de Lista</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-4">
                    Registro de Docentes
                    <span class="text-slate-200 dark:text-slate-700 font-light text-2xl">/</span>
                    <span class="text-indigo-600 dark:text-indigo-400">{{ $monthyear }}</span>
                </h1>

                <form action="{{ route('tattendance.add') }}" method="GET" class="inline-block mt-4">
                    <div class="flex items-center gap-3">
                        <div class="relative group">
                            <i
                                class="ti ti-calendar-event absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500/50 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input type="text" name="date" value="{{ $date }}"
                                onchange="this.form.submit()"
                                class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl pl-12 pr-6 py-3 text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                                placeholder="dd-mm-yyyy">
                        </div>
                        <p class="text-xs text-slate-400 font-medium">Seleccione la fecha de registro</p>
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <div
                    class="px-5 py-3 rounded-2xl bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 flex items-center gap-5 shadow-sm dark:shadow-inner backdrop-blur-3xl">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Presentes</span>
                        <span id="stat-p"
                            class="text-emerald-600 dark:text-emerald-400 font-mono font-bold leading-none mt-1 text-lg">0</span>
                    </div>
                    <div class="w-px h-8 bg-slate-100 dark:bg-slate-700/50"></div>
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Ausentes</span>
                        <span id="stat-a"
                            class="text-rose-600 dark:text-rose-400 font-mono font-bold leading-none mt-1 text-lg">0</span>
                    </div>
                    <div class="w-px h-8 bg-slate-100 dark:bg-slate-700/50"></div>
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Tardanza</span>
                        <span id="stat-l"
                            class="text-amber-600 dark:text-amber-400 font-mono font-bold leading-none mt-1 text-lg">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($teachers as $teacher)
                @php
                    $current_status = $attendances->get($teacher->teacherID)->$aday ?? null;
                @endphp
                <div class="teacher-row group p-6 rounded-[2.5rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-slate-800/50"
                    data-teacher-id="{{ $teacher->teacherID }}">
                    <div class="flex items-center gap-5 mb-6">
                        <div
                            class="w-16 h-16 rounded-[1.25rem] bg-slate-100 dark:bg-slate-900/40 overflow-hidden ring-4 ring-slate-100 dark:ring-slate-800/50 shadow-inner group-hover:scale-105 transition-transform">
                            <img src="{{ asset($teacher->photo ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h4
                                class="text-slate-800 dark:text-slate-100 font-black truncate tracking-tight uppercase leading-tight">
                                {{ $teacher->name }}</h4>
                            <div class="flex flex-col gap-0.5 mt-1">
                                <span
                                    class="text-[9px] text-slate-400 font-black uppercase tracking-widest">{{ $teacher->designation }}</span>
                                <span
                                    class="text-[8px] text-indigo-500 font-bold uppercase tracking-[0.2em]">{{ $teacher->dni }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <button onclick="saveTeacherAttendance({{ $teacher->teacherID }}, 'P', this)"
                            class="status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all {{ $current_status == 'P' ? 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 ring-2 ring-emerald-500/20' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-transparent' }}"
                            data-status="P">
                            <i class="ti ti-checkbox text-2xl"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest leading-none">Presente</span>
                        </button>

                        <button onclick="saveTeacherAttendance({{ $teacher->teacherID }}, 'A', this)"
                            class="status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all {{ $current_status == 'A' ? 'bg-rose-500 text-white shadow-xl shadow-rose-500/30 ring-2 ring-rose-500/20' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 border border-transparent' }}"
                            data-status="A">
                            <i class="ti ti-square-x text-2xl"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest leading-none">Falta</span>
                        </button>

                        <button onclick="saveTeacherAttendance({{ $teacher->teacherID }}, 'L', this)"
                            class="status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all {{ $current_status == 'L' ? 'bg-amber-500 text-white shadow-xl shadow-amber-500/30 ring-2 ring-amber-500/20' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 border border-transparent' }}"
                            data-status="L">
                            <i class="ti ti-square-rounded-clock text-2xl"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest leading-none">Tarde</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Actions -->
        <div
            class="mt-12 p-8 rounded-[3rem] bg-white dark:bg-slate-800/20 border border-indigo-500/10 flex flex-col sm:flex-row items-center justify-between gap-6 backdrop-blur-xl">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500">
                    <i class="ti ti-device-floppy text-3xl"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 dark:text-slate-100 uppercase tracking-tight">Sincronización en
                        Tiempo Real</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Cada acción actualiza el servidor
                        de forma inmediata y segura.</p>
                </div>
            </div>
            <a href="{{ route('tattendance.index') }}"
                class="w-full sm:w-auto px-10 py-4 bg-slate-900 dark:bg-indigo-600 hover:scale-105 text-white font-black uppercase tracking-[0.2em] text-[11px] rounded-[1.5rem] transition-all shadow-xl shadow-indigo-500/10">
                Cerrar Registro
            </a>
        </div>
    </div>

    <script>
        function saveTeacherAttendance(teacherID, status, btn) {
            const card = btn.closest('.teacher-row');
            const btns = card.querySelectorAll('.status-btn');

            const activeStyles = {
                P: 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 ring-2 ring-emerald-500/20',
                A: 'bg-rose-500 text-white shadow-xl shadow-rose-500/30 ring-2 ring-rose-500/20',
                L: 'bg-amber-500 text-white shadow-xl shadow-amber-500/30 ring-2 ring-amber-500/20'
            };

            const idleStyles = {
                P: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-transparent',
                A: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 border border-transparent',
                L: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 border border-transparent'
            };

            btn.classList.add('scale-95', 'opacity-70');

            fetch("{{ route('tattendance.save') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        teacherID: teacherID,
                        date: '{{ $date }}',
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.classList.remove('scale-95', 'opacity-70');
                    if (data.success) {
                        btns.forEach(b => {
                            const s = b.getAttribute('data-status');
                            b.className =
                                `status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all ${idleStyles[s]}`;
                        });
                        btn.className =
                            `status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all ${activeStyles[status]}`;
                        updateStats();
                    }
                })
                .catch(error => {
                    btn.classList.remove('scale-95', 'opacity-70');
                    console.error('Error:', error);
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
