<x-app-layout>
    <div class="min-h-screen bg-[#0f172a] text-white font-sans selection:bg-cyan-500/30">
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                        📖 Préstamos de Libros
                    </h1>
                    <p class="mt-2 text-slate-400">Registra y rastrea la salida y entrada de libros.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('issue.create') }}"
                        class="px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold transition-all shadow-lg shadow-cyan-500/20 flex items-center gap-2">
                        <i class="ti ti-plus text-lg"></i>
                        Nuevo Préstamo
                    </a>
                </div>
            </div>

            <!-- Issues Table Card -->
            <div class="rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm p-6 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-sm font-medium border-b border-slate-700/50">
                                <th class="pb-4 px-4">Estudiante (Carnet)</th>
                                <th class="pb-4 px-4">Libro</th>
                                <th class="pb-4 px-4">Serial</th>
                                <th class="pb-4 px-4">F. Préstamo</th>
                                <th class="pb-4 px-4">F. Vencimiento</th>
                                <th class="pb-4 px-4">F. Devolución</th>
                                <th class="pb-4 px-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/30">
                            @foreach ($issues as $issue)
                                <tr class="group hover:bg-slate-700/20 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-200">{{ $issue->member->name ?? 'N/A' }}</span>
                                            <span class="text-xs text-blue-400 font-mono">{{ $issue->lID }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-slate-300 font-medium">{{ $issue->book->book ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-4 text-slate-400 text-sm font-mono">{{ $issue->serial_no }}</td>
                                    <td class="py-4 px-4 text-slate-400 text-sm">{{ $issue->issue_date }}</td>
                                    <td class="py-4 px-4 text-slate-400 text-sm">
                                        <span
                                            class="{{ !$issue->return_date && \Carbon\Carbon::parse($issue->due_date)->isPast() ? 'text-red-400 font-bold' : '' }}">
                                            {{ $issue->due_date }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($issue->return_date)
                                            <span
                                                class="px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-400 text-xs border border-emerald-500/20">
                                                {{ $issue->return_date }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-md bg-orange-500/10 text-orange-400 text-xs border border-orange-500/20">
                                                Pendiente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if (!$issue->return_date)
                                                <form action="{{ route('issue.update', $issue->issueID) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-600/30 text-xs font-bold transition-all flex items-center gap-1">
                                                        <i class="ti ti-arrow-back-up"></i> Devolver
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('issue.destroy', $issue->issueID) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all"
                                                    onclick="return confirm('¿Eliminar registro?')">
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
    </div>
</x-app-layout>
