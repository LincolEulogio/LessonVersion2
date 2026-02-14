<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-6xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="space-y-4">
                <nav class="flex items-center gap-3 text-slate-400">
                    <a href="{{ route('section.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-layers-subtract text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Secciones') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Detalles') }}</span>
                </nav>
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-[32px] bg-emerald-600 flex items-center justify-center text-white shadow-xl shadow-emerald-500/20">
                        <i class="ti ti-layers-subtract text-4xl"></i>
                    </div>
                    <div>
                        <h1
                            class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase italic underline decoration-emerald-500/30">
                            {{ $section->section }}
                        </h1>
                        <div class="flex items-center gap-3 mt-1">
                            <span
                                class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $section->category }}</span>
                            <span class="text-emerald-500 font-black">•</span>
                            <span
                                class="text-xs font-bold text-slate-400 uppercase tracking-tighter">{{ $section->class->classes ?? __('Sin Clase') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if ($user && $user->hasPermission('seccion_edit'))
                    <a href="{{ route('section.edit', $section->sectionID) }}"
                        class="px-8 py-4 bg-amber-500 hover:bg-amber-400 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-edit text-lg"></i>
                        {{ __('Editar') }}
                    </a>
                @endif
                @if ($user && $user->hasPermission('seccion_delete'))
                    <button type="button"
                        onclick="confirmDelete('{{ $section->sectionID }}', '{{ $section->section }}')"
                        class="px-8 py-4 bg-rose-500 hover:bg-rose-400 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-trash text-lg"></i>
                        {{ __('Eliminar') }}
                    </button>
                    <form id="delete-form-{{ $section->sectionID }}"
                        action="{{ route('section.destroy', $section->sectionID) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Info Section -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-10 shadow-sm dark:shadow-none space-y-10 relative overflow-hidden group">
                    <div
                        class="absolute -right-20 -top-20 text-emerald-500/5 group-hover:scale-110 transition-transform duration-700 pointer-events-none rotate-12">
                        <i class="ti ti-layers-subtract text-[300px]"></i>
                    </div>

                    <div class="relative z-10 space-y-10">
                        <div>
                            <h3
                                class="text-[10px] font-black text-emerald-500 dark:text-emerald-400 uppercase tracking-[0.3em] mb-6 flex items-center gap-3 italic">
                                <span class="w-6 h-[2px] bg-emerald-500"></span>
                                {{ __('Descripción y Objetivos') }}
                            </h3>
                            <div class="prose prose-slate dark:prose-invert max-w-none">
                                <p
                                    class="text-lg font-medium text-slate-700 dark:text-slate-200 leading-relaxed italic opacity-90">
                                    "{{ $section->note ?? __('No se han registrado notas específicas para esta sección académica.') }}"
                                </p>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-10 border-t border-slate-100 dark:border-slate-700/50 pt-10">
                            <div class="space-y-2">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Capacidad Máxima') }}</span>
                                <div class="flex items-center gap-4">
                                    <span
                                        class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $section->capacity }}</span>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-black text-emerald-500 uppercase tracking-tighter">{{ __('Cupos') }}</span>
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase">{{ __('Disponibles') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Categoría Local') }}</span>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-400">
                                        <i class="ti ti-tag text-2xl"></i>
                                    </div>
                                    <span
                                        class="text-xl font-black text-slate-700 dark:text-slate-200 uppercase tracking-tight">{{ $section->category }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Placeholder -->
                <div
                    class="bg-slate-50/50 dark:bg-slate-900/30 border border-dashed border-slate-200 dark:border-slate-700/50 rounded-[40px] p-10 text-center space-y-4 group transition-all hover:bg-white dark:hover:bg-slate-800/40 hover:border-emerald-500/30">
                    <div
                        class="w-20 h-20 rounded-[28px] bg-white dark:bg-slate-800 flex items-center justify-center mx-auto text-slate-200 dark:text-slate-700 group-hover:text-emerald-500 transition-colors shadow-sm">
                        <i class="ti ti-users-group text-4xl"></i>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-base font-black text-slate-800 dark:text-slate-200">
                            {{ __('Lista de Estudiantes') }}</h4>
                        <p
                            class="text-sm text-slate-400 dark:text-slate-500 font-medium max-w-sm mx-auto leading-relaxed uppercase tracking-tighter">
                            {{ __('La integración de estudiantes vinculados se habilitará tras completar la migración de módulos educativos primarios.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <!-- Teacher Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-1 shadow-sm dark:shadow-none overflow-hidden group">
                    <div class="p-8 space-y-6">
                        <h3 class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic">
                            {{ __('Mentor Asignado') }}</h3>

                        @if ($section->teacher_name)
                            <div class="flex items-center gap-4">
                                @if ($section->teacher_photo)
                                    <img src="{{ asset('uploads/images/' . $section->teacher_photo) }}"
                                        class="w-20 h-20 rounded-[28px] object-cover ring-4 ring-slate-50 dark:ring-slate-900 shadow-xl"
                                        alt="">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-[28px] bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                        <i class="ti ti-user-star text-4xl"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-lg font-black text-slate-800 dark:text-white leading-tight">
                                        {{ $section->teacher_name }}</p>
                                    <p class="text-xs font-bold text-emerald-500 uppercase tracking-tighter">
                                        {{ __('Líder de Sección') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center gap-4 opacity-50 italic">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-slate-400">
                                    <i class="ti ti-user-off text-3xl"></i>
                                </div>
                                <span
                                    class="text-slate-400 font-bold tracking-tight">{{ __('Sin mentor asignado') }}</span>
                            </div>
                        @endif
                    </div>
                    @if ($section->teacher_name)
                        <div
                            class="px-8 py-5 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700/50 text-center group/more cursor-help">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover/more:text-emerald-500 transition-colors">{{ __('Ver Perfil Docente') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Academic Metadata -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm dark:shadow-none space-y-6">
                    <h3
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic border-b border-slate-100 dark:border-slate-700/50 pb-4">
                        {{ __('Detalles de Registro') }}
                    </h3>

                    <div class="space-y-5">
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Creado Por') }}</span>
                            <div class="flex items-center gap-2">
                                <i class="ti ti-user-circle text-emerald-500"></i>
                                <span
                                    class="text-sm font-black text-slate-700 dark:text-slate-200">{{ $section->create_username ?? __('Sistema') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Fecha Registro') }}</span>
                            <div class="flex items-center gap-2 font-mono">
                                <i class="ti ti-calendar-event text-emerald-500"></i>
                                <span
                                    class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($section->create_date)->format('M d, Y - H:i') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 pt-2 border-t border-slate-50 dark:border-slate-700/30">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('Última Modificación') }}</span>
                            <div class="flex items-center gap-2 font-mono">
                                <i class="ti ti-history text-emerald-500"></i>
                                <span
                                    class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($section->modify_date)->format('M d, Y - H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '¿ELIMINAR SECCIÓN?',
                text: `Estás a punto de borrar la sección "${name}". Esta acción es irreversible y los estudiantes vinculados perderán su asignación.`,
                icon: 'warning',
                iconColor: '#f43f5e',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'SÍ, ELIMINAR',
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

</x-app-layout>
