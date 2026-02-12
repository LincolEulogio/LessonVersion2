<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-book-upload text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Préstamos de Libros
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Control de circulación y
                        estado de devoluciones</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('issue.create') }}"
                    class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Nuevo Préstamo
                </a>
            </div>
        </div>

        <!-- Issues Table Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">Estudiante</th>
                            <th class="px-6 py-4">Libro / Serial</th>
                            <th class="px-6 py-4">F. Préstamo</th>
                            <th class="px-6 py-4">Vencimiento</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30 text-sm">
                        @foreach ($issues as $issue)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20 shadow-sm">
                                            <i class="ti ti-user text-lg"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-xs group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                {{ $issue->member->name ?? 'N/A' }}</p>
                                            <p
                                                class="font-mono text-[10px] text-blue-500 font-bold uppercase tracking-widest mt-0.5">
                                                {{ $issue->lID }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-bold text-slate-700 dark:text-slate-200">
                                            {{ $issue->book->book ?? 'N/A' }}</p>
                                        <p
                                            class="font-mono text-[10px] text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                            SN: {{ $issue->serial_no }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500 dark:text-slate-400 font-medium">
                                    {{ \Carbon\Carbon::parse($issue->issue_date)->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $isOverdue =
                                            !$issue->return_date && \Carbon\Carbon::parse($issue->due_date)->isPast();
                                    @endphp
                                    <span
                                        class="font-bold {{ $isOverdue ? 'text-rose-600 dark:text-rose-400' : 'text-slate-500 dark:text-slate-400' }}">
                                        {{ \Carbon\Carbon::parse($issue->due_date)->format('d M, Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($issue->return_date)
                                        <div class="inline-flex flex-col items-center">
                                            <span
                                                class="px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-black text-[10px] uppercase border border-emerald-100 dark:border-emerald-500/20 shadow-sm">Devuelto</span>
                                            <span
                                                class="text-[9px] text-slate-400 dark:text-slate-500 mt-1 font-bold">{{ \Carbon\Carbon::parse($issue->return_date)->format('d/m/y') }}</span>
                                        </div>
                                    @else
                                        @if ($isOverdue)
                                            <span
                                                class="px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 font-black text-[10px] uppercase border border-rose-100 dark:border-rose-500/20 shadow-sm animate-pulse">Atrasado</span>
                                        @else
                                            <span
                                                class="px-2.5 py-1 rounded-lg bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 font-black text-[10px] uppercase border border-orange-100 dark:border-orange-500/20 shadow-sm">Pendiente</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if (!$issue->return_date)
                                            <form action="{{ route('issue.update', $issue->issueID) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20 flex items-center gap-1.5 transition-all active:scale-95">
                                                    <i class="ti ti-arrow-back-up text-base"></i> Devolver
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('issue.destroy', $issue->issueID) }}" method="POST"
                                            class="inline" onsubmit="return confirm('¿Eliminar registro de préstamo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
