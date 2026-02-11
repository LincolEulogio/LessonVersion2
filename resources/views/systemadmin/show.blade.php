<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <img src="{{ asset($systemadmin->photo && $systemadmin->photo != 'default.png' ? 'storage/images/' . $systemadmin->photo : 'uploads/images/default.png') }}"
                    class="w-24 h-24 rounded-3xl object-cover border-4 border-slate-800 shadow-2xl"
                    alt="{{ $systemadmin->name }}">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $systemadmin->name }}</h1>
                    <div class="mt-2 flex items-center gap-3">
                        <span
                            class="px-3 py-1 bg-purple-600/20 text-purple-400 border border-purple-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                            Administrador del Sistema
                        </span>
                        <span class="text-slate-500">•</span>
                        <span class="text-slate-400 text-sm italic">Acceso total desde:
                            {{ \Carbon\Carbon::parse($systemadmin->jod)->format('M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('systemadmin.edit', $systemadmin->systemadminID) }}"
                    class="p-3 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20"
                    title="Editar Perfil">
                    <i class="ti ti-edit text-xl"></i>
                </a>
                <a href="{{ route('systemadmin.index') }}"
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50">
                    Volver
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-4">Seguridad</h3>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 uppercase tracking-wider">DNI</span>
                            <span
                                class="text-slate-200 font-bold text-lg tracking-widest">{{ $systemadmin->dni }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 uppercase tracking-wider">Alias de Usuario</span>
                            <span class="text-purple-400 font-mono text-sm">@ {{ $systemadmin->username }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm space-y-4 shadow-xl">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Contacto</h3>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-purple-500/10 text-purple-400 rounded-xl group-hover:bg-purple-500 group-hover:text-white transition-all">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Email</span>
                            <span class="text-sm text-slate-200 truncate">{{ $systemadmin->email }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-purple-500/10 text-purple-400 rounded-xl group-hover:bg-purple-500 group-hover:text-white transition-all">
                            <i class="ti ti-phone"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Teléfono</span>
                            <span class="text-sm text-slate-200">{{ $systemadmin->phone ?? 'Sin registrar' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="md:col-span-2 space-y-8">
                <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-info-circle text-purple-400"></i>
                        Información Detallada
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Fecha de
                                Nacimiento</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium">{{ \Carbon\Carbon::parse($systemadmin->dob)->format('d \d\e F, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Género</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium">{{ $systemadmin->sex ?? 'No especificado' }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Dirección de
                                Residencia</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium leading-relaxed">{{ $systemadmin->address ?? 'No hay dirección registrada.' }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm opacity-60 shadow-xl">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-history text-purple-400"></i>
                        Actividad Reciente (Próximamente)
                    </h2>
                    <p class="text-slate-400 italic text-sm text-center py-6">El registro de auditoría y acciones
                        administrativas estará disponible en la siguiente fase de migración.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
