<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <img src="{{ $student->photo ? asset('uploads/images/' . $student->photo) : asset('uploads/images/default.png') }}"
                        class="w-24 h-24 rounded-3xl object-cover border-4 border-white dark:border-slate-800 shadow-2xl transition-transform duration-300 group-hover:scale-105"
                        alt="{{ $student->name }}">
                    <div
                        class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 border-4 border-white dark:border-slate-900 rounded-full shadow-lg">
                    </div>
                </div>
                <div>
                    <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ $student->name }}
                    </h1>
                    <div class="mt-3 flex flex-wrap items-center gap-3">
                        <span
                            class="px-3 py-1 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-lg text-xs font-black uppercase tracking-wider shadow-sm">
                            {{ $student->classes->classes ?? 'N/A' }}
                        </span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm font-medium flex items-center gap-1.5">
                            <i class="ti ti-layout-grid text-indigo-500/70"></i>
                            {{ __('Sección') }}: <span
                                class="text-slate-700 dark:text-slate-200 uppercase">{{ $student->section->section ?? 'N/A' }}</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('student.edit', $student->studentID) }}"
                    class="px-5 py-2.5 bg-amber-500/10 text-amber-600 dark:text-amber-500 hover:bg-amber-500 hover:text-white rounded-2xl transition-all border border-amber-500/20 shadow-sm active:scale-95 flex items-center gap-2 font-bold text-sm">
                    Editar
                    <i class="ti ti-edit text-2xl"></i>
                </a>
                <a href="{{ route('student.index') }}"
                    class="px-5 py-2.5 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-2xl transition-all border border-slate-200 dark:border-slate-700/50 shadow-sm font-bold text-sm active:scale-95">
                    {{ __('Volver') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Stats/Quick Info -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div
                    class="p-8 rounded-[2rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
                    <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-6">
                        {{ __('Estado de Cuenta') }}</h3>
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="text-slate-600 dark:text-slate-300 font-bold text-sm">{{ __('Asistencia Promedio') }}</span>
                        <span class="text-emerald-500 dark:text-emerald-400 font-black text-lg">94%</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-700/50 rounded-full h-3 overflow-hidden shadow-inner">
                        <div class="bg-linear-to-r from-emerald-500 to-teal-400 h-3 rounded-full transition-all duration-1000"
                            style="width: 94%"></div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div
                    class="p-8 rounded-[2rem] bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl space-y-6 shadow-sm">
                    <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">
                        {{ __('Contacto Directo') }}</h3>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-3 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-2xl group-hover:scale-110 transition-transform shadow-sm">
                            <i class="ti ti-mail text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">{{ __('Email') }}</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200 truncate max-w-[180px]">{{ $student->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-3 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl group-hover:scale-110 transition-transform shadow-sm">
                            <i class="ti ti-phone text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">{{ __('Teléfono') }}</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $student->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Detailed Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- General Info -->
                <div
                    class="p-8 rounded-[2rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
                    <h2 class="text-xl font-black text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                        <div class="w-2 h-8 bg-indigo-500 rounded-full"></div>
                        {{ __('Detalles del Estudiante') }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('DNI / Documento') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->dni ?? 'N/A' }}</span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Número de Registro') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->roll ?? 'N/A' }}</span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Nombre Completo') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->name }}</span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Usuario') }}</span>
                            <span class="text-base font-bold text-indigo-600 dark:text-indigo-400">@
                                {{ $student->username }}</span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Fecha de Nacimiento') }}</span>
                            <span class="text-slate-700 dark:text-slate-200 text-base font-bold capitalize">
                                <i class="ti ti-calendar-event text-slate-400 mr-1"></i>
                                {{ $student->dob ? \Carbon\Carbon::parse($student->dob)->translatedFormat('d \d\e F, Y') : 'N/A' }}
                            </span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Género') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->sex }}</span>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Religión') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->religion ?? 'N/A' }}</span>
                        </div>
                        <div class="md:col-span-2 space-y-1">
                            <span
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Dirección') }}</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 text-base font-bold flex items-start gap-2 leading-relaxed">
                                <i class="ti ti-map-pin text-rose-500/70 mt-1"></i>
                                {{ $student->address ?? __('No registrada') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Parents/Guardian Info -->
                <div
                    class="p-8 rounded-[2rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
                    <h2 class="text-xl font-black text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                        <div class="w-2 h-8 bg-emerald-500 rounded-full"></div>
                        {{ __('Información del Padre / Tutor') }}
                    </h2>
                    @if ($student->parent)
                        <div class="flex items-center gap-6 mb-10 overflow-hidden group">
                            <img src="{{ $student->parent->photo ? asset('uploads/images/' . $student->parent->photo) : asset('uploads/images/default.png') }}"
                                class="w-16 h-16 rounded-[1.25rem] object-cover border-2 border-slate-100 dark:border-slate-700 group-hover:scale-105 transition-transform"
                                alt="{{ $student->parent->name }}">
                            <div>
                                <h4
                                    class="text-lg font-black text-slate-900 dark:text-slate-100 uppercase tracking-tight">
                                    {{ $student->parent->name }}</h4>
                                <p
                                    class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mt-1">
                                    {{ __('Padre / Tutor Legal') }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Padre') }}</span>
                                <span
                                    class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->parent->father_name ?? 'N/A' }}</span>
                            </div>
                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Madre') }}</span>
                                <span
                                    class="text-slate-700 dark:text-slate-200 text-base font-bold">{{ $student->parent->mother_name ?? 'N/A' }}</span>
                            </div>
                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Teléfono Tutor') }}</span>
                                <span
                                    class="text-slate-700 dark:text-slate-200 text-base font-bold flex items-center gap-2">
                                    <i class="ti ti-phone-call text-emerald-500/70"></i>
                                    {{ $student->parent->phone ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">{{ __('Email Tutor') }}</span>
                                <span
                                    class="text-slate-700 dark:text-slate-200 text-base font-bold flex items-center gap-2 truncate whitespace-normal">
                                    <i class="ti ti-mail-forward text-indigo-500/70"></i>
                                    {{ $student->parent->email ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex items-center gap-4 p-6 bg-amber-500/5 text-amber-600 dark:text-amber-500 border border-amber-500/10 rounded-3xl">
                            <i class="ti ti-alert-triangle text-3xl"></i>
                            <div class="flex flex-col">
                                <span
                                    class="font-black uppercase tracking-wider text-xs mb-1">{{ __('Atención') }}</span>
                                <p class="text-sm font-medium leading-relaxed">
                                    {{ __('No hay información de padres/tutores asignada a este estudiante.') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
