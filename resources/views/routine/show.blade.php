<x-app-layout>
    @php
        $dayNames = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $dayColors = [
            'Monday' =>
                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20',
            'Tuesday' =>
                'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:border-indigo-500/20',
            'Wednesday' =>
                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
            'Thursday' =>
                'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
            'Friday' =>
                'bg-sky-50 text-sky-600 border-sky-100 dark:bg-sky-500/10 dark:text-sky-400 dark:border-sky-500/20',
            'Saturday' =>
                'bg-violet-50 text-violet-600 border-violet-100 dark:bg-violet-500/10 dark:text-violet-400 dark:border-violet-500/20',
            'Sunday' =>
                'bg-slate-50 text-slate-600 border-slate-100 dark:bg-slate-500/10 dark:text-slate-400 dark:border-slate-500/20',
        ];
    @endphp

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
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Detalles') }}</span>
                </nav>
                <h1
                    class="text-4xl font-black text-slate-900 dark:text-white tracking-tight italic uppercase underline decoration-emerald-500/30 decoration-4 underline-offset-8">
                    {{ __('Detalles de Sesión') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Información detallada sobre el horario de clase') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                @if ($user && $user->hasPermission('horario_edit'))
                    <a href="{{ route('routine.edit', $routine->routineID) }}"
                        class="bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center gap-2 shadow-sm">
                        <i class="ti ti-edit text-xl"></i>
                        {{ __('Editar') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-white uppercase italic font-black">
            <!-- Left Column: Main Schedule Card -->
            <div class="lg:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-12 shadow-sm dark:shadow-none relative overflow-hidden group">
                    <div
                        class="absolute -right-32 -top-32 w-96 h-96 bg-emerald-500/5 rounded-full blur-[80px] group-hover:bg-emerald-500/10 transition-colors">
                    </div>

                    <div class="relative space-y-12">
                        <!-- Top Info -->
                        <div class="flex flex-col md:flex-row md:items-center gap-8">
                            <div
                                class="w-32 h-32 bg-emerald-600 text-white rounded-[40px] flex flex-col items-center justify-center shadow-2xl shadow-emerald-600/30 shrink-0 rotate-3 group-hover:rotate-6 transition-transform">
                                <span
                                    class="text-[10px] uppercase tracking-widest opacity-80">{{ __('Día') }}</span>
                                <span class="text-2xl pt-1">{{ __($dayNames[$routine->day] ?? $routine->day) }}</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg text-[10px] font-black tracking-widest border border-indigo-100 dark:border-indigo-500/20 shadow-sm">
                                        {{ $routine->class->classes }}
                                    </span>
                                    <span
                                        class="px-3 py-1 bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 rounded-lg text-[10px] font-black tracking-widest border border-sky-100 dark:border-sky-500/20 shadow-sm">
                                        {{ __('SECCIÓN:') }} {{ $routine->section->section }}
                                    </span>
                                </div>
                                <h2
                                    class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter leading-none italic">
                                    {{ $routine->subject->subject }}
                                </h2>
                            </div>
                        </div>

                        <!-- Time and Place -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-px bg-slate-100 dark:bg-slate-700/50 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-700/50 shadow-inner italic uppercase">
                            <div class="bg-white dark:bg-slate-800/50 p-8 flex items-center gap-6">
                                <div
                                    class="w-16 h-16 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-3xl">
                                    <i class="ti ti-clock-hour-10"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] text-slate-400 tracking-widest">{{ __('Franja Horaria') }}</span>
                                    <span
                                        class="text-2xl text-slate-800 dark:text-slate-100">{{ $routine->start_time }}
                                        - {{ $routine->end_time }}</span>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-slate-800/50 p-8 flex items-center gap-6">
                                <div
                                    class="w-16 h-16 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center text-3xl">
                                    <i class="ti ti-door-enter"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] text-slate-400 tracking-widest">{{ __('Aula Asignada') }}</span>
                                    <span
                                        class="text-2xl text-slate-800 dark:text-slate-100">{{ $routine->room }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Teacher Info -->
                        <div class="space-y-6 pt-4 italic uppercase">
                            <h3
                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50 dark:border-slate-700/50 pb-4">
                                {{ __('Responsable de Materia') }}
                            </h3>
                            <div
                                class="flex items-center gap-6 p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                                <div
                                    class="w-20 h-20 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-300 text-4xl shadow-sm border border-slate-200 dark:border-slate-700">
                                    <i class="ti ti-user-star"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-lg text-slate-900 dark:text-white tracking-tight">{{ $routine->teacher->name }}</span>
                                    <span
                                        class="text-[11px] text-emerald-500 tracking-widest font-black">{{ __('DOCENTE TITULAR') }}</span>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span
                                            class="text-xs text-slate-400 lowercase">{{ $routine->teacher->email ?? 'no-email@edu.com' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Metadata & Actions -->
            <div class="space-y-8 font-black uppercase italic tracking-widest text-[10px]">
                <!-- Audit Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm dark:shadow-none space-y-6">
                    <h3
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100 dark:border-slate-700/50 pb-4">
                        {{ __('Auditoría y Estado') }}
                    </h3>

                    <div class="space-y-6">
                        <div
                            class="flex items-center gap-4 p-4 rounded-3xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20">
                            <div
                                class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-2xl shadow-lg">
                                <i class="ti ti-check"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-emerald-600 dark:text-emerald-400">{{ __('Sesión Activa') }}</span>
                                <span
                                    class="text-sm text-slate-700 dark:text-slate-200">{{ __('VIGENTE ' . date('Y')) }}</span>
                            </div>
                        </div>

                        <div class="space-y-4 pt-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-slate-400">{{ __('Creado Por') }}</span>
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-history text-slate-400"></i>
                                    <span
                                        class="text-xs text-slate-700 dark:text-slate-200">{{ $routine->create_username ?? 'System' }}
                                        ({{ $routine->create_usertype ?? 'Admin' }})</span>
                                </div>
                                <span class="text-[9px] text-slate-400">{{ $routine->create_date }}</span>
                            </div>

                            <div class="flex flex-col gap-1 pt-4 border-t border-slate-50 dark:border-slate-700/30">
                                <span class="text-slate-400">{{ __('Año Académico') }}</span>
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-school-bell text-amber-500"></i>
                                    <span
                                        class="text-sm text-slate-700 dark:text-slate-200">{{ $routine->schoolyearID }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                @if ($user && $user->hasPermission('horario_delete'))
                    <div
                        class="bg-rose-50/30 dark:bg-rose-500/5 border border-rose-100 dark:border-rose-500/10 rounded-[40px] p-8 space-y-4">
                        <button
                            onclick="confirmDelete('{{ $routine->routineID }}', '{{ $routine->subject->subject }}')"
                            class="w-full bg-white dark:bg-slate-900 text-rose-600 dark:text-rose-400 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all border border-rose-200 dark:border-rose-900/50 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-600 flex items-center justify-center gap-3 group">
                            <i class="ti ti-trash text-xl group-hover:animate-bounce"></i>
                            {{ __('Eliminar Horario') }}
                        </button>
                        <form id="delete-form-{{ $routine->routineID }}"
                            action="{{ route('routine.destroy', $routine->routineID) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id, title) {
                Swal.fire({
                    title: '¿ELIMINAR HORARIO?',
                    text: `Estás a punto de borrar el horario de "${title}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    iconColor: '#f43f5e',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'SÍ, BORRAR DEFINITIVAMENTE',
                    cancelButtonText: 'CANCELAR',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                    borderRadius: '40px',
                    customClass: {
                        popup: 'border border-slate-200 dark:border-slate-700 shadow-2xl backdrop-blur-xl',
                        title: 'text-2xl font-black tracking-tight mt-4',
                        htmlContainer: 'text-sm font-medium leading-relaxed opacity-70',
                        confirmButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] transition-all hover:scale-105 active:scale-95 m-2',
                        cancelButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] m-2 transition-all hover:scale-105 active:scale-95'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
