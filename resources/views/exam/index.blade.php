<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
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
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Exámenes') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                        {{ __('Control de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Exámenes') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                        {{ __('Planificación y gestión de evaluaciones académicas') }}
                    </p>
                </div>

                @if (Auth::user()->hasPermission('examen_add'))
                    <div class="flex items-center gap-4">
                        <a href="{{ route('exam.create') }}"
                            class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] shadow-xl shadow-emerald-500/20 transition-all flex items-center gap-3 font-black text-[11px] uppercase tracking-widest group">
                            <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform duration-300"></i>
                            {{ __('Nuevo Examen') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                });
            </script>
        @endif

        <!-- Exams Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($exams as $exam)
                <div
                    class="group relative p-8 rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-500 overflow-hidden">
                    <!-- Glow effect -->
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-500/5 blur-3xl rounded-full group-hover:bg-emerald-500/10 transition-colors">
                    </div>

                    <!-- Date Badge -->
                    <div
                        class="absolute top-8 right-8 flex flex-col items-center bg-slate-50 dark:bg-slate-900/50 px-4 py-2 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <span
                            class="text-2xl font-black text-slate-900 dark:text-white leading-none">{{ \Carbon\Carbon::parse($exam->date)->format('d') }}</span>
                        <span
                            class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">{{ \Carbon\Carbon::parse($exam->date)->format('M') }}</span>
                    </div>

                    <div class="mb-8">
                        <div
                            class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform duration-500">
                            <i class="ti ti-file-certificate text-3xl"></i>
                        </div>
                        <h3
                            class="text-xl font-black text-slate-900 dark:text-white mb-2 uppercase tracking-tight italic group-hover:text-emerald-500 transition-colors">
                            {{ $exam->exam }}
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium leading-relaxed line-clamp-2">
                            {{ $exam->note ?? __('Sin observaciones adicionales para esta evaluación.') }}
                        </p>
                    </div>

                    <div
                        class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Acciones rápidas') }}</span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('exam.show', $exam->examID) }}"
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm"
                                title="{{ __('Ver Detalles') }}">
                                <i class="ti ti-eye text-lg"></i>
                            </a>
                            @if (Auth::user()->hasPermission('examen_edit'))
                                <a href="{{ route('exam.edit', $exam->examID) }}"
                                    class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm"
                                    title="{{ __('Editar Examen') }}">
                                    <i class="ti ti-pencil text-lg"></i>
                                </a>
                            @endif
                            @if (Auth::user()->hasPermission('examen_delete'))
                                <button type="button"
                                    onclick="confirmDelete('{{ $exam->examID }}', '{{ $exam->exam }}')"
                                    class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm"
                                    title="{{ __('Eliminar Examen') }}">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                                <form id="delete-form-{{ $exam->examID }}"
                                    action="{{ route('exam.destroy', $exam->examID) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div
                        class="w-24 h-24 bg-slate-100 dark:bg-slate-800/50 rounded-[2.5rem] flex items-center justify-center text-slate-400 mx-auto mb-6">
                        <i class="ti ti-calendar-off text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase italic tracking-tight">
                        {{ __('No hay exámenes') }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-8 max-w-xs mx-auto">
                        {{ __('Aún no se han programado exámenes. Comienza creando uno nuevo.') }}</p>
                    @if (Auth::user()->hasPermission('examen_add'))
                        <a href="{{ route('exam.create') }}"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 dark:bg-emerald-600 text-white rounded-[2rem] text-[11px] font-black uppercase tracking-widest transition-all hover:scale-105">
                            <i class="ti ti-plus text-lg"></i>
                            {{ __('Crear Primer Examen') }}
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `Vas a eliminar el examen "${name}". Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
