<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-slate-200 dark:border-orange-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-receipt-2 text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Detalle del Préstamo
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Información histórica y estado
                        actual</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('issue.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Volver
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Transaction Info -->
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                <h4
                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <i class="ti ti-info-circle text-blue-500"></i> Datos del Registro
                </h4>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                            Nº de Serie / ID Único</p>
                        <p class="text-xl font-black text-slate-900 dark:text-white">{{ $issue->serial_no }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha Salida</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ \Carbon\Carbon::parse($issue->issue_date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha Vencimiento</p>
                            <p
                                class="text-sm font-bold {{ \Carbon\Carbon::parse($issue->due_date)->isPast() && !$issue->return_date ? 'text-rose-500' : 'text-slate-700 dark:text-slate-200' }}">
                                {{ \Carbon\Carbon::parse($issue->due_date)->format('d M, Y') }}
                            </p>
                        </div>
                    </div>

                    @if ($issue->return_date)
                        <div
                            class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20">
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Devuelto el</p>
                            <p class="text-lg font-black text-emerald-700 dark:text-emerald-300">
                                {{ \Carbon\Carbon::parse($issue->return_date)->format('d M, Y') }}
                            </p>
                        </div>
                    @else
                        <div
                            class="p-4 rounded-2xl bg-orange-50 dark:bg-orange-500/10 border border-orange-100 dark:border-orange-500/20">
                            <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest">Estado</p>
                            <p class="text-lg font-black text-orange-700 dark:text-orange-300 flex items-center gap-2">
                                <i class="ti ti-clock animate-pulse"></i> Préstamo en curso
                            </p>
                        </div>
                    @endif

                    @if ($issue->note)
                        <div class="pt-6 border-t border-slate-100 dark:border-slate-700/50">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">
                                Notas</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 italic">"{{ $issue->note }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Entities involved -->
            <div class="space-y-8">
                <!-- Book Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <i class="ti ti-book text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Libro Prestado
                            </p>
                            <h4 class="text-lg font-black text-slate-900 dark:text-white leading-tight capitalize">
                                {{ $issue->book?->book ?? 'N/A' }}</h4>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-400">Autor:</span>
                            <span class="text-slate-700 dark:text-slate-200">{{ $issue->book?->author ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-400">Código Materia:</span>
                            <span
                                class="text-slate-700 dark:text-slate-200">{{ $issue->book?->subject_code ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Member Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm overflow-hidden relative group">
                    <div class="flex items-center gap-4 mb-6 relative">
                        <div
                            class="w-16 h-16 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 overflow-hidden flex items-center justify-center text-indigo-500 font-black text-xl uppercase">
                            @if ($issue->member?->student?->photo)
                                <img src="{{ asset('uploads/images/' . $issue->member->student->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                {{ substr($issue->member?->name ?? '?', 0, 2) }}
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Miembro
                                Responsable</p>
                            <h4 class="text-lg font-black text-slate-900 dark:text-white leading-tight capitalize">
                                {{ $issue->member?->name ?? 'N/A' }}</h4>
                            <p class="text-[10px] font-bold text-indigo-500 mt-0.5 tracking-widest uppercase">ID:
                                {{ $issue->lmembercardID }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 relative">
                        <div class="flex items-center gap-3 text-xs font-medium text-slate-600 dark:text-slate-400">
                            <i class="ti ti-mail text-blue-500"></i>
                            <span>{{ $issue->member?->email ?? 'No disponible' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs font-medium text-slate-600 dark:text-slate-400">
                            <i class="ti ti-phone text-blue-500"></i>
                            <span>{{ $issue->member?->phone ?? 'Sin teléfono' }}</span>
                        </div>
                    </div>

                    <div
                        class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl group-hover:bg-indigo-500/10 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
