<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('holiday.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-sky-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight capitalize">
                        {{ $holiday->title }}</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Detalles del periodo de asueto
                    </p>
                </div>
            </div>
            @admin
                <div class="flex items-center gap-3">
                    <a href="{{ route('holiday.edit', $holiday->holidayID) }}"
                        class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-edit text-lg"></i>
                        Editar
                    </a>
                </div>
            @endadmin
        </div>

        <!-- content Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] overflow-hidden shadow-sm">
            @if ($holiday->photo)
                <div class="w-full h-80 relative">
                    <img src="{{ asset('uploads/images/' . $holiday->photo) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-linear-to-t from-slate-900/40 to-transparent"></div>
                </div>
            @else
                <div
                    class="w-full h-48 bg-sky-600 dark:bg-sky-500/10 flex items-center justify-center text-white/20 dark:text-sky-500/10">
                    <i class="ti ti-palm text-9xl"></i>
                </div>
            @endif

            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-center">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Desde</span>
                            <div
                                class="w-16 h-20 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 flex flex-col items-center justify-center shadow-inner">
                                <span
                                    class="text-[10px] font-black text-sky-600 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($holiday->fdate)->format('M') }}</span>
                                <span
                                    class="text-2xl font-black text-slate-900 dark:text-white leading-none">{{ \Carbon\Carbon::parse($holiday->fdate)->format('d') }}</span>
                            </div>
                        </div>
                        <div class="w-8 h-px bg-slate-200 dark:bg-slate-700 mt-4"></div>
                        <div class="flex flex-col items-center">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Hasta</span>
                            <div
                                class="w-16 h-20 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 flex flex-col items-center justify-center shadow-inner">
                                <span
                                    class="text-[10px] font-black text-sky-600 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($holiday->tdate)->format('M') }}</span>
                                <span
                                    class="text-2xl font-black text-slate-900 dark:text-white leading-none">{{ \Carbon\Carbon::parse($holiday->tdate)->format('d') }}</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="px-8 py-4 rounded-3xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-center">
                        <p
                            class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em]">
                            Días libres</p>
                        <p class="text-4xl font-black text-emerald-900 dark:text-emerald-300 mt-1">
                            {{ \Carbon\Carbon::parse($holiday->fdate)->diffInDays($holiday->tdate) + 1 }}
                        </p>
                    </div>
                </div>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p
                        class="text-xl md:text-2xl text-slate-600 dark:text-slate-300 font-medium leading-relaxed whitespace-pre-line">
                        {{ $holiday->details }}
                    </p>
                </div>

                <div
                    class="mt-16 pt-8 border-t border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-3">
                        <span
                            class="px-4 py-2 rounded-2xl bg-slate-100 dark:bg-slate-700/50 text-[10px] font-black text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-600 uppercase tracking-widest">
                            #CalendarioEscolar
                        </span>
                        <span
                            class="px-4 py-2 rounded-2xl bg-slate-100 dark:bg-slate-700/50 text-[10px] font-black text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-600 uppercase tracking-widest">
                            #Descanso
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
