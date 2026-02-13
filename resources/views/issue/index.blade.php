<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-slate-200 dark:border-orange-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-history text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Préstamos de Libros
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Control de salidas y
                        devoluciones</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('issue.create') }}"
                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-orange-600 text-white font-black text-xs uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-orange-600/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    Nuevo Préstamo
                </a>
            </div>
        </div>

        <!-- Filters (Optional: Search by Member or Book) -->

        <!-- Issues Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700/50">
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Miembro</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Libro</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Préstamo / Vence</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Estado</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($issues as $issue)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 font-black text-xs">
                                            {{ substr($issue->member?->name ?? '?', 0, 2) }}
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white leading-tight capitalize">
                                                {{ $issue->member?->name ?? 'Desconocido' }}</p>
                                            <p
                                                class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-0.5">
                                                ID: {{ $issue->lmembercardID }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $issue->book?->book ?? 'Libro no encontrado' }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium">S/N:
                                            {{ $issue->serial_no }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col gap-1">
                                        <div
                                            class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                                            <i class="ti ti-calendar-event text-blue-500"></i>
                                            {{ \Carbon\Carbon::parse($issue->issue_date)->format('d M, Y') }}
                                        </div>
                                        <div
                                            class="flex items-center gap-2 text-[10px] font-black uppercase {{ $issue->return_date ? 'text-slate-300' : (\Carbon\Carbon::parse($issue->due_date)->isPast() ? 'text-rose-500' : 'text-amber-500') }}">
                                            <i class="ti ti-clock-stop transition-colors"></i>
                                            {{ \Carbon\Carbon::parse($issue->due_date)->format('d M, Y') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if ($issue->return_date)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-wider border border-emerald-100 dark:border-emerald-500/20">
                                            <i class="ti ti-check text-xs"></i> Devuelto
                                        </span>
                                        <p class="text-[9px] text-slate-400 mt-1 font-medium italic">el
                                            {{ \Carbon\Carbon::parse($issue->return_date)->format('d/m/Y') }}</p>
                                    @else
                                        @if (\Carbon\Carbon::parse($issue->due_date)->isPast())
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 text-[10px] font-black uppercase tracking-wider border border-rose-100 dark:border-rose-500/20">
                                                <i class="ti ti-alert-triangle text-xs"></i> Atrasado
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-wider border border-blue-100 dark:border-blue-500/20">
                                                <i class="ti ti-loader text-xs animate-spin"></i> Activo
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('issue.show', $issue->issueID) }}"
                                            class="w-9 h-9 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center hover:bg-slate-200 transition-all shadow-sm">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>

                                        @if (!$issue->return_date)
                                            <button
                                                onclick="confirmReturn('{{ route('issue.return', $issue->issueID) }}', '{{ $issue->book?->book }}')"
                                                class="w-9 h-9 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all shadow-sm group/btn relative">
                                                <i class="ti ti-book-check text-lg"></i>
                                                <span
                                                    class="absolute -top-10 scale-0 group-hover/btn:scale-100 transition-all bg-slate-900 text-white text-[9px] px-2 py-1 rounded whitespace-nowrap">Marcar
                                                    Devuelto</span>
                                            </button>
                                        @endif

                                        <button
                                            onclick="confirmDeletion('{{ route('issue.destroy', $issue->issueID) }}')"
                                            class="w-9 h-9 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-history text-4xl text-slate-200 dark:text-slate-700"></i>
                                        <p
                                            class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                                            No hay préstamos registrados</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmReturn(url, book) {
                Swal.fire({
                    title: 'Confirmar Devolución',
                    text: `¿Has recibido el libro "${book}" de vuelta?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Sí, devuelto',
                    cancelButtonText: 'No todavía',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML =
                            `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="PATCH">`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            function confirmDeletion(url) {
                Swal.fire({
                    title: '¿Eliminar Registro?',
                    text: "Esta acción eliminará el registro del préstamo. Si el libro no fue devuelto, el stock se ajustará automáticamente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML =
                            `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
