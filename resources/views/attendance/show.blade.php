<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav
                    class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4">
                    <a href="{{ route('attendance.index') }}"
                        class="hover:text-rose-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Asistencia</a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-rose-400 uppercase tracking-widest font-bold text-[10px]">Reporte Mensual</span>
                </nav>
                <h1 class="text-4xl font-black text-white tracking-tight flex items-center gap-4">
                    {{ $student->name }}
                </h1>
                <p class="text-slate-400 font-medium flex items-center gap-2 mt-2">
                    <i class="ti ti-calendar-month text-rose-500/50"></i>
                    Mes Académico: <span
                        class="text-slate-200 font-bold underline decoration-rose-500/30 underline-offset-4">{{ $monthyear }}</span>
                </p>
            </div>

            <form action="{{ route('attendance.show', $student->studentID) }}" method="GET"
                class="flex items-center gap-3">
                <input type="month" name="month_input"
                    value="{{ Carbon\Carbon::createFromFormat('m-Y', $monthyear)->format('Y-m') }}"
                    onchange="const d = new Date(this.value + '-01'); const m = ('0' + (d.getMonth() + 1)).slice(-2); const y = d.getFullYear(); window.location.href = '{{ route('attendance.show', $student->studentID) }}?monthyear=' + m + '-' + y;"
                    class="bg-slate-900/50 border border-slate-700/50 rounded-2xl px-4 py-2 text-white outline-none focus:ring-4 focus:ring-rose-500/10 transition-all">
            </form>
        </div>

        <!-- Attendance Grid -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-900/50">
                            <th
                                class="p-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] @if ($attendance_type == 'subject') min-w-[200px] @else min-w-[100px] @endif">
                                @if ($attendance_type == 'subject')
                                    Materia
                                @else
                                    Fecha
                                @endif
                            </th>
                            @for ($i = 1; $i <= 31; $i++)
                                <th
                                    class="p-2 text-center text-[9px] font-black text-slate-500 uppercase border-l border-slate-700/30">
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($attendances as $attendance)
                            <tr class="group hover:bg-slate-700/10 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg @if ($attendance_type == 'subject') bg-indigo-500/10 text-indigo-400 @else bg-rose-500/10 text-rose-400 @endif flex items-center justify-center">
                                            <i
                                                class="ti @if ($attendance_type == 'subject') ti-book @else ti-calendar @endif"></i>
                                        </div>
                                        <span class="text-slate-200 font-bold text-xs uppercase tracking-wider">
                                            @if ($attendance_type == 'subject')
                                                {{ $attendance->subject->subject }}
                                            @else
                                                General
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                @for ($i = 1; $i <= 31; $i++)
                                    @php
                                        $aday = "a$i";
                                        $status = $attendance->$aday;
                                    @endphp
                                    <td class="p-1 border-l border-slate-700/30 text-center">
                                        @if ($status == 'P')
                                            <div class="w-6 h-6 rounded-md bg-emerald-500/20 text-emerald-400 text-[10px] font-black flex items-center justify-center mx-auto shadow-sm"
                                                title="Presente">P</div>
                                        @elseif($status == 'A')
                                            <div class="w-6 h-6 rounded-md bg-rose-500/20 text-rose-400 text-[10px] font-black flex items-center justify-center mx-auto shadow-sm"
                                                title="Ausente">A</div>
                                        @elseif($status == 'L')
                                            <div class="w-6 h-6 rounded-md bg-amber-500/20 text-amber-400 text-[10px] font-black flex items-center justify-center mx-auto shadow-sm"
                                                title="Tarde">L</div>
                                        @else
                                            <div
                                                class="w-6 h-6 rounded-md bg-slate-900/40 text-slate-700 text-[10px] font-black flex items-center justify-center mx-auto">
                                                -</div>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="32" class="p-20 text-center">
                                    <div
                                        class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center text-slate-600 mx-auto mb-4">
                                        <i class="ti ti-database-off text-3xl"></i>
                                    </div>
                                    <p class="text-slate-500 font-medium italic text-sm">No se encontraron registros
                                        para este periodo.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-8 flex flex-wrap items-center gap-8 px-6">
            <div class="flex items-center gap-3">
                <div
                    class="w-4 h-4 rounded bg-emerald-500/20 text-emerald-400 text-[8px] font-black flex items-center justify-center">
                    P</div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Presente</span>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="w-4 h-4 rounded bg-rose-500/20 text-rose-400 text-[8px] font-black flex items-center justify-center">
                    A</div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Ausente</span>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="w-4 h-4 rounded bg-amber-500/20 text-amber-400 text-[8px] font-black flex items-center justify-center">
                    L</div>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Tarde</span>
            </div>
        </div>
    </div>
</x-app-layout>
