<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <img src="{{ asset($teacher->photo && $teacher->photo != 'default.png' ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                    class="w-24 h-24 rounded-3xl object-cover border-4 border-white dark:border-slate-800 shadow-2xl"
                    alt="{{ $teacher->name }}">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $teacher->name }}</h1>
                    <div class="mt-2 flex items-center gap-3">
                        <span
                            class="px-3 py-1 bg-emerald-600/10 dark:bg-emerald-600/20 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                            {{ $teacher->designation }}
                        </span>
                        <span class="text-slate-300 dark:text-slate-500">•</span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm italic">Miembro desde:
                            {{ \Carbon\Carbon::parse($teacher->jod)->format('M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('teacher.edit', $teacher->teacherID) }}"
                    class="p-3 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20"
                    title="Editar Perfil">
                    <i class="ti ti-edit text-xl"></i>
                </a>
                <a href="{{ route('teacher.index') }}"
                    class="px-4 py-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl transition-all border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                    Volver
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Quick Info & Identity -->
            <div class="space-y-6">
                <!-- ID Card -->
                <div
                    class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
                    <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4">
                        Identificación</h3>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 uppercase tracking-wider">DNI / Cédula</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 font-bold text-lg tracking-widest">{{ $teacher->dni }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 uppercase tracking-wider">Usuario en Sistema</span>
                            <span
                                class="text-emerald-600 dark:text-emerald-400 font-mono text-sm">{{ $teacher->username }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div
                    class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">
                        Canales de Contacto</h3>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-indigo-500/10 text-indigo-400 rounded-xl group-hover:bg-indigo-500 group-hover:text-white transition-all">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Corporativo</span>
                            <span
                                class="text-sm text-slate-700 dark:text-slate-200 truncate">{{ $teacher->email }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-emerald-500/10 text-emerald-400 rounded-xl group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <i class="ti ti-phone"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Teléfono Móvil</span>
                            <span
                                class="text-sm text-slate-700 dark:text-slate-200">{{ $teacher->phone ?? 'Sin registrar' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Detail Tabs -->
            <div class="md:col-span-2 space-y-8">
                <!-- Bio/Personal Info -->
                <div
                    class="p-8 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
                    <h2
                        class="text-xl font-bold text-slate-900 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-user-check text-emerald-500 dark:text-emerald-400"></i>
                        Perfil Profesional & Personal
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div>
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Especialidad</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 mt-1 block font-semibold text-lg">{{ $teacher->designation }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Fecha de
                                Nacimiento</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 mt-1 block font-medium">{{ \Carbon\Carbon::parse($teacher->dob)->format('d \d\e F, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Género</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 mt-1 block font-medium">{{ $teacher->sex }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Antigüedad</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 mt-1 block font-medium">{{ \Carbon\Carbon::parse($teacher->jod)->diffForHumans(['parts' => 2]) }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Residencia</span>
                            <span
                                class="text-slate-700 dark:text-slate-200 mt-1 block font-medium leading-relaxed">{{ $teacher->address ?? 'Dirección no registrada en el sistema.' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Academic Load / Subjects - Prototype -->
                <div
                    class="p-8 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm opacity-60">
                    <h2
                        class="text-xl font-bold text-slate-900 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-book text-emerald-500 dark:text-emerald-400"></i>
                        Carga Académica (Próximamente)
                    </h2>
                    <p class="text-slate-400 italic text-sm text-center py-6">La integración de horarios y asignaturas
                        asignadas estará disponible tras la migración del módulo de Cursos.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
