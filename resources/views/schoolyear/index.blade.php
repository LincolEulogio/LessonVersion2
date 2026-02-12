<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-calendar-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Años Académicos
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestiona los periodos
                        escolares y calendarios</p>
                </div>
            </div>

            <a href="{{ route('schoolyear.create') }}"
                class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus text-lg"></i> Nuevo Año
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
                <i class="ti ti-circle-check text-xl"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- List Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700/50">
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Año</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Título</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha Inicio</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha Fin</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                        @forelse($schoolyears as $year)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <div
                                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                        {{ $year->schoolyear }}</div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                        {{ $year->schoolyeartitle }}</div>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($year->startingdate)->format('d M, Y') }}
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($year->endingdate)->format('d M, Y') }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('schoolyear.edit', $year->schoolyearID) }}"
                                            class="p-2 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('schoolyear.destroy', $year->schoolyearID) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este año académico?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="p-2 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div
                                        class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-4">
                                        <i class="ti ti-calendar-off text-3xl"></i>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400 font-bold">No se han registrado años
                                        académicos.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
