<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2">
                    <i class="ti ti-smart-home text-sm"></i>
                    {{ __('Dashboard') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('mark.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Calificaciones') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Reporte del Estudiante') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Reporte de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Notas') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('mark.add', ['classesID' => $student->classesID, 'sectionID' => $student->sectionID]) }}"
                        class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all shadow-sm">
                        {{ __('Registrar Notas') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Student Profile Card -->
        <div
            class="mb-12 p-8 rounded-[3rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl flex flex-col md:flex-row items-center gap-8">
            <div
                class="w-32 h-32 rounded-[2.5rem] bg-slate-100 dark:bg-slate-900 overflow-hidden ring-8 ring-slate-50 dark:ring-slate-800 shadow-inner">
                <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                    class="w-full h-full object-cover">
            </div>
            <div class="text-center md:text-left space-y-3">
                <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">
                    {{ $student->name }}</h2>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <span
                        class="px-4 py-1.5 bg-emerald-500/10 text-emerald-500 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">
                        {{ $student->classes->classes }}
                    </span>
                    <span
                        class="px-4 py-1.5 bg-blue-500/10 text-blue-500 rounded-full text-[10px] font-black uppercase tracking-widest border border-blue-500/20">
                        {{ $student->section->section }}
                    </span>
                    <span
                        class="px-4 py-1.5 bg-slate-100 dark:bg-slate-900/50 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-800">
                        ROLL: {{ $student->roll }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Dynamic Tabs for Exams -->
        <div x-data="{ activeExam: '{{ $exams->first()->examID ?? '' }}' }" class="space-y-8">
            <div class="flex overflow-x-auto pb-4 gap-4 scrollbar-hide">
                @foreach ($exams as $exam)
                    <button @click="activeExam = '{{ $exam->examID }}'"
                        :class="activeExam === '{{ $exam->examID }}' ?
                            'bg-emerald-600 text-white shadow-xl shadow-emerald-600/20' :
                            'bg-white dark:bg-slate-800 text-slate-400 hover:text-emerald-500'"
                        class="px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all shrink-0 border border-slate-200 dark:border-slate-700">
                        {{ $exam->exam }}
                    </button>
                @endforeach
            </div>

            @foreach ($exams as $exam)
                <div x-show="activeExam === '{{ $exam->examID }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="grid grid-cols-1 gap-6">
                        @php $examMarks = $marks->get($exam->examID) ?? collect(); @endphp
                        @forelse($examMarks as $mark)
                            <div
                                class="p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:bg-emerald-500/[0.02]">
                                <div
                                    class="flex flex-col md:flex-row justify-between gap-8 mb-8 pb-8 border-b border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center gap-6">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                            <i class="ti ti-notebook text-3xl"></i>
                                        </div>
                                        <div>
                                            <h4
                                                class="text-xl font-black text-slate-800 dark:text-white uppercase italic tracking-tighter">
                                                {{ $mark->subject->subject }}</h4>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                {{ __('Desglose de Calificaciones') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <span
                                                class="block text-3xl font-black text-emerald-500 italic tracking-tighter leading-none">{{ $mark->mark }}</span>
                                            <span
                                                class="text-[9px] text-slate-400 font-black uppercase tracking-widest">{{ __('Puntaje Total') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-6">
                                    @foreach ($mark->relations as $relation)
                                        <div
                                            class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 text-center space-y-2">
                                            <span
                                                class="block text-[9px] text-slate-400 font-black uppercase tracking-widest">{{ $relation->percentage->markpercentage }}</span>
                                            <span
                                                class="block text-lg font-black text-slate-700 dark:text-white">{{ $relation->mark }}</span>
                                            <span class="block text-[8px] text-emerald-500 font-bold italic">Max:
                                                {{ $relation->percentage->markpercentage_numeric }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div
                                class="py-20 text-center bg-slate-50/50 dark:bg-slate-900/20 rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-slate-800">
                                <i class="ti ti-chart-bar-off text-6xl text-slate-200 dark:text-slate-700 mb-6"></i>
                                <h3 class="text-xl font-black text-slate-400 uppercase tracking-tighter">
                                    {{ __('No hay notas registradas para este examen') }}</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
