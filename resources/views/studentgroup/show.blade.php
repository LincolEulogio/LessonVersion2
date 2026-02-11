<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Card -->
        <div
            class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl relative">
            <!-- Decorative Accent -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-500/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>

            <div class="p-8 md:p-12 text-center">
                <div
                    class="w-20 h-20 rounded-2xl bg-sky-500/20 flex items-center justify-center text-sky-400 text-4xl mx-auto mb-6 shadow-inner border border-sky-500/20">
                    <i class="ti ti-users-group"></i>
                </div>

                <h1 class="text-4xl font-bold text-white mb-2 uppercase tracking-widest">
                    {{ $group->group }}</h1>
                <p class="text-slate-500 font-mono text-xs uppercase tracking-[0.3em] mb-8">Categoría Académica</p>

                <div
                    class="inline-flex flex-col items-center gap-6 p-6 bg-slate-900/40 rounded-3xl border border-slate-700/30">
                    <div class="space-y-1">
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest">Estado del
                            Grupo</span>
                        <span
                            class="px-4 py-1.5 bg-emerald-500/10 text-emerald-400 rounded-full text-xs font-bold border border-emerald-500/20 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                            ACTIVO
                        </span>
                    </div>
                </div>

                <div class="mt-12 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('studentgroup.edit', $group->studentgroupID) }}"
                        class="px-8 py-3 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-2xl transition-all border border-amber-500/20 font-bold text-sm flex items-center gap-2 uppercase tracking-widest leading-none">
                        <i class="ti ti-edit"></i>
                        Editar Grupo
                    </a>
                    <a href="{{ route('studentgroup.index') }}"
                        class="px-8 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-300 rounded-2xl transition-all border border-slate-600/30 font-bold text-sm flex items-center gap-2 uppercase tracking-widest leading-none">
                        <i class="ti ti-list"></i>
                        Ver Todos
                    </a>
                </div>
            </div>

            <!-- Footer Meta -->
            <div
                class="bg-slate-900/40 p-6 border-t border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                <div class="flex items-center gap-2">
                    <i class="ti ti-calendar-event opacity-50"></i>
                    Creado: <span
                        class="text-slate-400">{{ \Carbon\Carbon::parse($group->create_date)->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="ti ti-history opacity-50"></i>
                    Modificado: <span
                        class="text-slate-400">{{ \Carbon\Carbon::parse($group->modify_date)->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
