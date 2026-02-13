<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('syllabus.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-folder-open text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Plan De Estudios') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Detalles') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Detalles del Plan') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Visualización completa de la información del documento curricular') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('syllabus.edit', $syllabus->syllabusID) }}"
                    class="bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center gap-2 shadow-sm">
                    <i class="ti ti-edit text-xl"></i>
                    {{ __('Editar') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Syllabus Core Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-12 shadow-sm dark:shadow-none relative overflow-hidden group">
                    <div
                        class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-colors">
                    </div>

                    <div class="relative space-y-10">
                        <div class="flex flex-col md:flex-row md:items-center gap-8">
                            <div
                                class="w-24 h-24 bg-emerald-600 text-white rounded-[32px] flex items-center justify-center shadow-2xl shadow-emerald-600/30 shrink-0 rotate-3 group-hover:rotate-6 transition-transform">
                                <i class="ti ti-file-description text-5xl"></i>
                            </div>
                            <div class="space-y-2">
                                <span
                                    class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                                    {{ $syllabus->class->classes }}
                                </span>
                                <h2
                                    class="text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-tight uppercase italic underline decoration-emerald-500/30 decoration-4 underline-offset-8">
                                    {{ $syllabus->title }}
                                </h2>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic border-b border-slate-100 dark:border-slate-700/50 pb-4">
                                {{ __('Descripción del Documento') }}
                            </h3>
                            <p
                                class="text-slate-600 dark:text-slate-300 text-lg font-medium leading-relaxed italic pr-4">
                                "{{ $syllabus->description ?: __('Sin descripción detallada disponible para este plan de estudios.') }}"
                            </p>
                        </div>

                        @if ($syllabus->file)
                            <div class="pt-8 flex flex-col sm:flex-row items-center gap-4">
                                <a href="{{ route('syllabus.download', $syllabus->syllabusID) }}"
                                    class="w-full sm:w-auto bg-slate-900 dark:bg-white dark:text-slate-900 text-white px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-4 shadow-xl">
                                    <i class="ti ti-download text-2xl"></i>
                                    {{ __('Descargar Documento') }}
                                </a>

                                @php
                                    $ext = pathinfo($syllabus->file, PATHINFO_EXTENSION);
                                @endphp
                                <div
                                    class="px-6 py-5 bg-slate-100 dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-white dark:bg-slate-800 rounded-xl flex items-center justify-center text-slate-500 border border-slate-200 dark:border-slate-700">
                                        <i class="ti ti-file-info text-xl"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ __('Formato') }}</span>
                                        <span
                                            class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-tighter">{{ $ext ?: 'Desconocido' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Preview Box Placeholder (Could be an iframe if PDF) -->
                @if (pathinfo($syllabus->file, PATHINFO_EXTENSION) == 'pdf')
                    <div
                        class="bg-slate-900 rounded-[40px] overflow-hidden shadow-2xl h-[600px] border-4 border-slate-800">
                        <iframe src="{{ asset('uploads/syllabus/' . $syllabus->file) }}"
                            class="w-full h-full border-none"></iframe>
                    </div>
                @endif
            </div>

            <!-- Right Column: Sidebar Metadata -->
            <div class="space-y-8">
                <!-- Academic Metadata -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm dark:shadow-none space-y-6">
                    <h3
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic border-b border-slate-100 dark:border-slate-700/50 pb-4">
                        {{ __('Metadatos del Registro') }}
                    </h3>

                    <div class="space-y-5">
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Creado Por') }}</span>
                            <div class="flex items-center gap-2">
                                <i class="ti ti-user-circle text-emerald-500"></i>
                                <span
                                    class="text-sm font-black text-slate-700 dark:text-slate-200">{{ $syllabus->create_username ?? __('Sistema') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Fecha Registro') }}</span>
                            <div class="flex items-center gap-3 font-mono">
                                <i class="ti ti-calendar-event text-emerald-500"></i>
                                <span
                                    class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($syllabus->create_date)->format('M d, Y - H:i') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 pt-2 border-t border-slate-50 dark:border-slate-700/30">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Última Modificación') }}</span>
                            <div class="flex items-center gap-3 font-mono mt-1">
                                <i class="ti ti-history text-amber-500"></i>
                                <span
                                    class="text-xs text-slate-500 dark:text-slate-400">{{ $syllabus->modify_date ? \Carbon\Carbon::parse($syllabus->modify_date)->diffForHumans() : __('Sin cambios') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions / Danger Zone -->
                <div
                    class="bg-rose-50/30 dark:bg-rose-500/5 border border-rose-100 dark:border-rose-500/10 rounded-[40px] p-8 space-y-4">
                    <button onclick="confirmDelete('{{ $syllabus->syllabusID }}', '{{ $syllabus->title }}')"
                        class="w-full bg-white dark:bg-slate-900 text-rose-600 dark:text-rose-400 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all border border-rose-200 dark:border-rose-900/50 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-600 flex items-center justify-center gap-3 group">
                        <i class="ti ti-trash text-xl group-hover:animate-bounce"></i>
                        {{ __('Eliminar Plan') }}
                    </button>
                    <form id="delete-form-{{ $syllabus->syllabusID }}"
                        action="{{ route('syllabus.destroy', $syllabus->syllabusID) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id, title) {
                Swal.fire({
                    title: '¿ELIMINAR PLAN?',
                    text: `Estás a punto de borrar "${title}". Esta acción no se puede deshacer.`,
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
