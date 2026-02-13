<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav class="flex items-center gap-3 text-slate-400 mb-2">
                    <a href="{{ route('attendance.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-calendar-check text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Asistencia') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Reporte Mensual') }}</span>
                </nav>
                <h1
                    class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase italic underline decoration-emerald-500/30 decoration-8 underline-offset-8">
                    {{ __('Registro de Asistencia') }}
                </h1>
            </div>

            <!-- Month Filter -->
            <form action="{{ route('attendance.show', $student->studentID) }}" method="GET" id="monthForm">
                <div class="relative group/select">
                    <i
                        class="ti ti-calendar-month absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                    <input type="month" name="monthyear_picker" id="monthyear_picker"
                        value="{{ \Carbon\Carbon::createFromFormat('m-Y', $monthyearInput)->format('Y-m') }}"
                        onchange="updateMonth(this.value)"
                        class="w-full pl-14 pr-6 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-black text-xs uppercase tracking-widest shadow-sm">
                    <input type="hidden" name="monthyear" id="monthyear" value="{{ $monthyearInput }}">
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Student Info Card -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm text-center relative overflow-hidden group">
                    <div
                        class="absolute -right-16 -top-16 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-colors">
                    </div>

                    <div class="relative space-y-6">
                        <div
                            class="w-32 h-32 mx-auto bg-slate-100 dark:bg-slate-900 rounded-[40px] border-4 border-white dark:border-slate-800 shadow-2xl overflow-hidden rotate-3 group-hover:rotate-0 transition-all duration-500">
                            @if ($student->photo)
                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i class="ti ti-user text-6xl"></i>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h2
                                class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic">
                                {{ $student->name }}</h2>
                            <p class="text-emerald-500 text-[10px] font-black tracking-[0.2em] uppercase mt-1">
                                {{ __('Estudiante Regular') }}</p>
                        </div>

                        <div class="space-y-4 pt-6 border-t border-slate-100 dark:border-slate-700/50 text-left">
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Clase') }}</span>
                                <span
                                    class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $student->classes->classes }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Sección') }}</span>
                                <span
                                    class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $student->section->section }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('N° Orden') }}</span>
                                <span
                                    class="text-xs font-bold text-emerald-600">{{ str_pad($student->roll, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div
                    class="bg-slate-900 border border-slate-800 rounded-[40px] p-8 space-y-8 shadow-2xl text-white italic uppercase font-black">
                    <h3 class="text-[10px] tracking-[0.2em] text-slate-500">{{ __('Resumen Mensual') }}</h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex flex-col items-center">
                            <span class="text-2xl text-emerald-500">
                                @php
                                    $presentCount = 0;
                                    foreach ($attendances as $att) {
                                        for ($i = 1; $i <= $daysInMonth; $i++) {
                                            $d = "a$i";
                                            if ($att->$d == 'P') {
                                                $presentCount++;
                                            }
                                        }
                                    }
                                @endphp
                                {{ $presentCount }}
                            </span>
                            <span class="text-[8px] text-emerald-500/60 tracking-widest">{{ __('Presentes') }}</span>
                        </div>
                        <div
                            class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl flex flex-col items-center">
                            <span class="text-2xl text-rose-500">
                                @php
                                    $absentCount = 0;
                                    foreach ($attendances as $att) {
                                        for ($i = 1; $i <= $daysInMonth; $i++) {
                                            $d = "a$i";
                                            if ($att->$d == 'A') {
                                                $absentCount++;
                                            }
                                        }
                                    }
                                @endphp
                                {{ $absentCount }}
                            </span>
                            <span class="text-[8px] text-rose-500/60 tracking-widest">{{ __('Ausentes') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Grid -->
            <div class="lg:col-span-3">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden p-8 md:p-12 h-full">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight italic">
                            {{ __('Calendario de Asistencia') }}
                            <span
                                class="block text-[10px] text-slate-400 font-bold tracking-[0.2em] mt-1">{{ __('Vista detallada de :month', ['month' => $monthyearInput]) }}</span>
                        </h3>
                        <div class="flex items-center gap-6">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">P</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">T</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-rose-500 rounded-full"></div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">A</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        @if ($attendance_type == 'subject')
                            @foreach ($attendances as $att)
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <i class="ti ti-book-2 text-emerald-500"></i>
                                        <h4
                                            class="text-xs font-black text-slate-700 dark:text-slate-200 uppercase tracking-widest border-l-4 border-emerald-500 pl-3">
                                            {{ $att->subject->subject }}
                                        </h4>
                                    </div>
                                    <div class="grid grid-cols-7 sm:grid-cols-10 md:grid-cols-16 gap-2">
                                        @for ($i = 1; $i <= $daysInMonth; $i++)
                                            @php
                                                $d = "a$i";
                                                $status = $att->$d;
                                                $color = 'bg-slate-50 dark:bg-slate-900/50 text-slate-300';
                                                if ($status == 'P') {
                                                    $color =
                                                        'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20';
                                                }
                                                if ($status == 'L') {
                                                    $color = 'bg-amber-500 text-white shadow-lg shadow-amber-500/20';
                                                }
                                                if ($status == 'A') {
                                                    $color = 'bg-rose-500 text-white shadow-lg shadow-rose-500/20';
                                                }
                                            @endphp
                                            <div class="aspect-square {{ $color }} rounded-xl flex items-center justify-center text-[10px] font-black transition-all hover:scale-110 cursor-default"
                                                title="{{ __('Día') . ' ' . $i }}">
                                                {{ $i }}
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @forelse($attendances as $att)
                                <div class="grid grid-cols-7 sm:grid-cols-10 md:grid-cols-16 gap-3">
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        @php
                                            $d = "a$i";
                                            $status = $att->$d;
                                            $color = 'bg-slate-50 dark:bg-slate-900/50 text-slate-300';
                                            if ($status == 'P') {
                                                $color = 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20';
                                            }
                                            if ($status == 'L') {
                                                $color = 'bg-amber-500 text-white shadow-lg shadow-amber-500/20';
                                            }
                                            if ($status == 'A') {
                                                $color = 'bg-rose-500 text-white shadow-lg shadow-rose-500/20';
                                            }
                                        @endphp
                                        <div class="aspect-square {{ $color }} rounded-2xl flex items-center justify-center text-xs font-black transition-all hover:scale-110 shadow-sm border border-black/5"
                                            title="{{ __('Día') . ' ' . $i }}">
                                            {{ $i }}
                                        </div>
                                    @endfor
                                </div>
                            @empty
                                <div class="py-24 text-center">
                                    <div
                                        class="w-20 h-20 mx-auto bg-slate-50 dark:bg-slate-900/50 rounded-full flex items-center justify-center text-slate-200 mb-6">
                                        <i class="ti ti-calendar-off text-5xl"></i>
                                    </div>
                                    <p class="text-slate-400 font-black uppercase tracking-[0.2em] italic">
                                        {{ __('Sin registros para este mes') }}</p>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateMonth(val) {
                const [year, month] = val.split('-');
                document.getElementById('monthyear').value = `${month}-${year}`;
                document.getElementById('monthForm').submit();
            }
        </script>
    @endpush
</x-app-layout>
