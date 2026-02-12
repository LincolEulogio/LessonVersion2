<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-sky-500/10 flex items-center justify-center text-sky-600 dark:text-sky-400 border border-slate-200 dark:border-sky-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-palm text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Vacaciones y Feriados
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Días de descanso y
                        suspensiones de labores</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('holiday.create') }}"
                    class="px-6 py-3 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-sky-600/20 hover:shadow-sky-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Añadir Vacaciones
                </a>
            </div>
        </div>

        <!-- Holidays Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($holidays as $holiday)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] overflow-hidden shadow-sm hover:shadow-xl hover:shadow-sky-500/5 transition-all duration-500">
                    <!-- Decor Top -->
                    <div class="h-32 bg-sky-600 dark:bg-sky-500/20 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20 pointer-events-none">
                            <i class="ti ti-sun text-[120px] absolute -right-10 -top-10 rotate-12"></i>
                        </div>
                        <div class="absolute bottom-6 left-8 flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex flex-col items-center justify-center text-white">
                                <span
                                    class="text-[10px] font-black uppercase tracking-tighter">{{ \Carbon\Carbon::parse($holiday->fdate)->format('M') }}</span>
                                <span
                                    class="text-lg font-black leading-none">{{ \Carbon\Carbon::parse($holiday->fdate)->format('d') }}</span>
                            </div>
                            <div class="text-white">
                                <p class="text-[9px] font-black uppercase tracking-widest opacity-60">Duración</p>
                                <p class="text-xs font-black uppercase">
                                    {{ \Carbon\Carbon::parse($holiday->fdate)->diffInDays($holiday->tdate) + 1 }} Días
                                </p>
                            </div>
                        </div>

                        @admin
                            <div class="absolute top-4 right-4 flex gap-2">
                                <a href="{{ route('holiday.edit', $holiday->holidayID) }}"
                                    class="w-8 h-8 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white flex items-center justify-center hover:bg-white hover:text-sky-600 transition-all">
                                    <i class="ti ti-edit text-sm"></i>
                                </a>
                                <form action="{{ route('holiday.destroy', $holiday->holidayID) }}" method="POST"
                                    class="inline" onsubmit="return confirm('¿Eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all">
                                        <i class="ti ti-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endadmin
                    </div>

                    <div class="p-8">
                        <h3
                            class="text-xl font-black text-slate-900 dark:text-white tracking-tight mb-4 group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors uppercase">
                            {{ $holiday->title }}
                        </h3>

                        <p class="text-sm text-slate-500 dark:text-slate-400 font-medium line-clamp-3 mb-8">
                            {{ strip_tags($holiday->details) }}
                        </p>

                        <div
                            class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-700/50">
                            <div class="flex items-center gap-2">
                                <i class="ti ti-calendar text-sky-500"></i>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Desde
                                    {{ \Carbon\Carbon::parse($holiday->fdate)->format('d/m') }} al
                                    {{ \Carbon\Carbon::parse($holiday->tdate)->format('d/m') }}</span>
                            </div>
                            <a href="{{ route('holiday.show', $holiday->holidayID) }}"
                                class="w-10 h-10 rounded-2xl bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-slate-400 hover:bg-sky-600 hover:text-white transition-all shadow-sm">
                                <i class="ti ti-chevron-right text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div
                        class="w-24 h-24 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                        <i class="ti ti-beach text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white">Todo en orden</h3>
                    <p class="text-slate-400 dark:text-slate-500 mt-2">No hay vacaciones programadas próximamente.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
