<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Profile & Month Selector -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 mb-10">
            <div class="flex items-center gap-6 text-center md:text-left">
                <div class="w-24 h-24 rounded-[2rem] bg-white dark:bg-slate-800 shadow-2xl p-1">
                    <img src="{{ asset($teacher->photo ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                        class="w-full h-full object-cover rounded-[1.8rem]">
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">
                        {{ $teacher->name }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2 justify-center md:justify-start">
                        <span
                            class="px-3 py-1 bg-indigo-100 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ $teacher->designation }}</span>
                        <span class="text-slate-400 font-mono text-xs uppercase tracking-widest font-black">DNI:
                            {{ $teacher->dni }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('tattendance.show', $teacher->teacherID) }}" method="GET"
                class="flex items-center gap-4 bg-white dark:bg-slate-800/50 p-3 rounded-3xl border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
                <input type="month" name="monthyear_raw"
                    value="{{ Carbon\Carbon::createFromFormat('m-Y', $monthyear)->format('Y-m') }}"
                    onchange="let parts = this.value.split('-'); this.nextElementSibling.value = parts[1] + '-' + parts[0]; this.form.submit()"
                    class="bg-transparent border-none text-slate-700 dark:text-white font-black text-sm uppercase tracking-widest focus:ring-0">
                <input type="hidden" name="monthyear" value="{{ $monthyear }}">
                <div class="w-px h-8 bg-slate-200 dark:bg-slate-700"></div>
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-indigo-500 transition-all">Filtrar</button>
            </form>
        </div>

        <!-- Monthly Grid View -->
        <div
            class="bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 rounded-[3rem] overflow-hidden shadow-xl backdrop-blur-xl">
            <div class="p-8 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Calendario Mensual:
                    {{ $monthyear }}</h3>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">P</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">F</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">T</span>
                    </div>
                </div>
            </div>

            <div class="p-8 grid grid-cols-7 sm:grid-cols-7 md:grid-cols-7 lg:grid-cols-7 gap-4">
                @php
                    $attendance = $attendances->first();
                    $daysInMonth = Carbon\Carbon::createFromFormat('m-Y', $monthyear)->daysInMonth;
                    $stats = ['P' => 0, 'A' => 0, 'L' => 0];
                @endphp

                @for ($d = 1; $d <= $daysInMonth; $d++)
                    @php
                        $dayCol = 'a' . $d;
                        $status = $attendance ? $attendance->$dayCol : null;
                        if ($status) {
                            $stats[$status]++;
                        }

                        $bgColor = 'bg-slate-50 dark:bg-slate-900/50 text-slate-300 dark:text-slate-700';
                        $icon = 'ti ti-circle-dotted';
                        if ($status == 'P') {
                            $bgColor = 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20';
                            $icon = 'ti ti-check';
                        }
                        if ($status == 'A') {
                            $bgColor = 'bg-rose-500 text-white shadow-lg shadow-rose-500/20';
                            $icon = 'ti ti-x';
                        }
                        if ($status == 'L') {
                            $bgColor = 'bg-amber-500 text-white shadow-lg shadow-amber-500/20';
                            $icon = 'ti ti-clock-pause';
                        }
                    @endphp
                    <div class="flex flex-col items-center gap-2">
                        <div
                            class="w-full aspect-square rounded-2xl {{ $bgColor }} flex items-center justify-center transition-all hover:scale-105 group relative">
                            <i class="{{ $icon }} text-xl"></i>
                            <div
                                class="absolute -top-1 -right-1 w-6 h-6 rounded-lg bg-white dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center text-[9px] font-black shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-colors border border-slate-100 dark:border-slate-700">
                                {{ $d }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Stats Summary -->
            <div
                class="bg-slate-50 dark:bg-slate-900/40 p-10 border-t border-slate-100 dark:border-slate-700/50 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="space-y-1">
                    <span
                        class="block text-4xl font-black text-emerald-600 dark:text-emerald-400">{{ $stats['P'] }}</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Días Presente</span>
                </div>
                <div class="space-y-1">
                    <span class="block text-4xl font-black text-rose-600 dark:text-rose-400">{{ $stats['A'] }}</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Faltas Totales</span>
                </div>
                <div class="space-y-1">
                    <span
                        class="block text-4xl font-black text-amber-600 dark:text-amber-400">{{ $stats['L'] }}</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tardanzas</span>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('tattendance.index') }}"
                class="px-8 py-3 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:text-indigo-500 transition-all flex items-center gap-3">
                <i class="ti ti-arrow-back text-lg"></i>
                Regresar al Listado
            </a>
        </div>
    </div>
</x-app-layout>
