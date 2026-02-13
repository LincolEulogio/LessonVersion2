<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('classes.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-school text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Clases') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Detalles') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ $class->classes }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Perfil Académico Completo del Nivel') }}</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('classes.edit', $class->classesID) }}"
                    class="px-6 py-3 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-200 font-black text-xs uppercase tracking-widest transition-all hover:border-emerald-500 hover:text-emerald-500 flex items-center gap-2">
                    <i class="ti ti-edit text-lg"></i> {{ __('Editar') }}
                </a>
                <a href="{{ route('classes.index') }}"
                    class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-black text-xs uppercase tracking-widest transition-all hover:bg-slate-800 flex items-center gap-2">
                    <i class="ti ti-arrow-left text-lg"></i> {{ __('Volver') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Main Content Area -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Class Identity Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 relative overflow-hidden group">
                    <!-- Background Decoration -->
                    <div
                        class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all duration-700">
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
                        <div
                            class="w-24 h-24 rounded-3xl bg-emerald-600/10 flex items-center justify-center text-emerald-600 text-4xl shadow-inner group-hover:scale-110 transition-transform duration-500">
                            <i class="ti ti-school"></i>
                        </div>

                        <div class="flex-1 space-y-4">
                            <div class="flex flex-wrap gap-3">
                                <span
                                    class="px-4 py-1.5 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest">
                                    {{ __('Nivel Escolar') }}
                                </span>
                                <span
                                    class="px-4 py-1.5 bg-slate-100 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50 rounded-xl text-[10px] font-black uppercase tracking-widest">
                                    {{ __('Valor Numérico: ') }} {{ $class->classes_numeric }}
                                </span>
                            </div>

                            <h2 class="text-2xl font-black text-slate-900 dark:text-white">{{ $class->classes }}</h2>

                            <div
                                class="bg-slate-50/50 dark:bg-slate-900/50 p-6 rounded-3xl border border-slate-100 dark:border-slate-700/30">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">
                                    {{ __('Descripción Académica') }}</p>
                                <p class="text-slate-600 dark:text-slate-300 leading-relaxed italic">
                                    {{ $class->note ?? __('No se han registrado notas u observaciones específicas para este grado académico.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teacher Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 group overflow-hidden relative">
                    <h3
                        class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                        <i class="ti ti-user-star text-emerald-500 text-lg"></i>
                        {{ __('Docente Responsable del Grado') }}
                    </h3>

                    @if ($class->teacher_name)
                        <div class="flex items-center gap-8 relative z-10">
                            <div class="relative">
                                @if ($class->teacher_photo)
                                    <img src="{{ asset('uploads/images/' . $class->teacher_photo) }}"
                                        class="w-24 h-24 rounded-[32px] object-cover border-4 border-white dark:border-slate-700 shadow-xl shadow-emerald-500/10"
                                        alt="{{ $class->teacher_name }}">
                                @else
                                    <div
                                        class="w-24 h-24 rounded-[32px] bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-3xl font-black shadow-inner">
                                        {{ substr($class->teacher_name, 0, 1) }}
                                    </div>
                                @endif
                                <div
                                    class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-800">
                                    <i class="ti ti-certificate text-xl"></i>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <h4
                                    class="text-2xl font-black text-slate-900 dark:text-white group-hover:text-emerald-500 transition-colors duration-300">
                                    {{ $class->teacher_name }}
                                </h4>
                                <p class="text-slate-500 dark:text-slate-400 font-bold text-sm">
                                    {{ $class->teacher_email }}</p>
                                <div class="pt-4 flex items-center gap-4">
                                    <span
                                        class="text-[10px] font-black bg-emerald-500/10 text-emerald-600 px-3 py-1 rounded-lg uppercase tracking-widest">
                                        {{ __('Titular de Grado') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center py-6 text-slate-400">
                            <i class="ti ti-user-off text-4xl mb-2"></i>
                            <p class="font-bold text-sm">{{ __('Sin maestro asignado actualmente') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- System Info Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-8">
                    <h3
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                        <i class="ti ti-info-circle text-lg"></i>
                        {{ __('Información de Sistema') }}
                    </h3>

                    <div class="space-y-6">
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Fecha de Registro') }}</span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ \Carbon\Carbon::parse($class->create_date)->translatedFormat('d \d\e F, Y') }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Creado por') }}</span>
                            <div class="flex items-center gap-2">
                                <i class="ti ti-user-check text-emerald-500 text-sm"></i>
                                <span
                                    class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $class->create_username ?? __('Administrator') }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Último Cambio') }}</span>
                            <span
                                class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-500/5 px-3 py-2 rounded-xl border border-emerald-500/10">
                                {{ \Carbon\Carbon::parse($class->modify_date)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Academic Context Card -->
                <div
                    class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-[32px] p-8 text-white shadow-xl shadow-emerald-500/20 relative overflow-hidden group">
                    <div
                        class="absolute -bottom-10 -right-10 text-white/10 group-hover:scale-125 transition-transform duration-700">
                        <i class="ti ti-award text-[120px]"></i>
                    </div>

                    <h4 class="text-sm font-black uppercase tracking-widest mb-6 opacity-80">
                        {{ __('Métricas Académicas') }}</h4>
                    <div class="grid grid-cols-2 gap-4 relative z-10">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 text-center">
                            <p class="text-xs font-bold opacity-70 mb-1 tracking-tighter">{{ __('Estudiantes') }}</p>
                            <span class="text-2xl font-black">--</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 text-center">
                            <p class="text-xs font-bold opacity-70 mb-1 tracking-tighter">{{ __('Materias') }}</p>
                            <span class="text-2xl font-black">--</span>
                        </div>
                    </div>
                    <p class="mt-6 text-[10px] font-bold opacity-60 leading-relaxed italic uppercase tracking-tighter">
                        {{ __('Vinculaciones dinámicas disponibles en la próxima actualización de módulos.') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
