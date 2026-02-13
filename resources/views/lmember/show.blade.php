<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-id-badge text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Detalle de Membresía
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Carnet de biblioteca y datos
                        del estudiante</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('lmember.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Listado
                </a>
                <a href="{{ route('lmember.edit', $lmember->lmemberID) }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-amber-600 text-white font-black text-xs uppercase tracking-widest hover:bg-amber-500 transition-all shadow-lg shadow-amber-600/20">
                    <i class="ti ti-edit text-lg"></i>
                    Editar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Student Card -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 text-center shadow-sm relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl"></div>

                    <div class="relative inline-block mb-6">
                        <div
                            class="w-32 h-32 rounded-3xl bg-slate-100 dark:bg-slate-700 border-4 border-white dark:border-slate-800 shadow-xl overflow-hidden mx-auto">
                            @if ($lmember->student?->photo)
                                <img src="{{ asset('uploads/images/' . $lmember->student->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-slate-300 font-black text-4xl">
                                    {{ substr($lmember->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center border-4 border-white dark:border-slate-800 shadow-lg">
                            <i class="ti ti-check text-xl"></i>
                        </div>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 dark:text-white leading-tight mb-1">
                        {{ $lmember->name }}</h3>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6">
                        Estudiante Activo</p>

                    <div class="flex flex-col gap-3">
                        <div
                            class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 flex justify-between items-center text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Grado</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $lmember->student?->classes?->classes ?? '--' }}</span>
                        </div>
                        <div
                            class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 flex justify-between items-center text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sección</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $lmember->student?->section?->section ?? '--' }}</span>
                        </div>
                        <div
                            class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 flex justify-between items-center text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Roll</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">#{{ $lmember->student?->roll ?? '--' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Balance Card -->
                <div
                    class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-3xl p-8 text-white shadow-xl shadow-indigo-600/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <div class="relative">
                        <p class="text-[10px] font-black text-white/60 uppercase tracking-widest mb-1">Saldo Disponible
                        </p>
                        <h4 class="text-4xl font-black mb-6">${{ number_format($lmember->lbalance, 2) }}</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                                <i class="ti ti-coin text-xl"></i>
                            </div>
                            <p class="text-xs font-bold leading-tight text-white/80">Crédito disponible para préstamos y
                                multas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Membership Details -->
            <div class="lg:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center">
                            <i class="ti ti-info-circle"></i>
                        </span>
                        Información de Membresía
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                ID de Biblioteca (Carnet)</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ $lmember->lmembercardID }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha de Registro</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ \Carbon\Carbon::parse($lmember->ljoindate)->format('d M, Y') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Teléfono de Contacto</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-300">
                                {{ $lmember->phone ?? 'Sin teléfono registrado' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Correo Electrónico</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-300">
                                {{ $lmember->email ?? 'Sin correo registrado' }}</p>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-700/50">
                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-100 dark:border-slate-700/30">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center flex-shrink-0">
                                    <i class="ti ti-shield-check text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-black text-slate-900 dark:text-white text-sm">Estado de Miembro</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Este estudiante tiene
                                        acceso completo a los servicios de biblioteca, incluyendo préstamo de libros y
                                        uso de áreas de estudio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logs/Activity Placeholder -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                        <i class="ti ti-history text-lg text-slate-400"></i>
                        Actividad Reciente
                    </h4>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-px bg-slate-200 dark:bg-slate-700 relative">
                                <div
                                    class="absolute top-0 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]">
                                </div>
                            </div>
                            <div class="pb-6">
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Membresía
                                    Creada</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300">El estudiante fue
                                    registrado en el sistema de biblioteca.</p>
                                <p class="text-[10px] font-medium text-slate-400 mt-2">
                                    {{ \Carbon\Carbon::parse($lmember->ljoindate)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
