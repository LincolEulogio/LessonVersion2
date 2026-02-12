<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-file-invoice text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Facturación Escolar
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Control de pagos, descuentos y
                        saldos de estudiantes</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('invoice.create') }}"
                    class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Nueva Factura
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 animate-in fade-in slide-in-from-top-4 duration-500">
                <div
                    class="w-8 h-8 rounded-lg bg-white dark:bg-emerald-500/20 flex items-center justify-center shadow-sm">
                    <i class="ti ti-circle-check text-xl"></i>
                </div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Invoice Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Estudiante</th>
                            <th class="px-6 py-4">Concepto</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Pagado</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($invoices as $invoice)
                            @php
                                $discountAmount = ($invoice->amount * $invoice->discount) / 100;
                                $netAmount = $invoice->amount - $discountAmount;
                                $balance = $netAmount - $invoice->paidamount;
                            @endphp
                            <tr class="group hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-all">
                                <td class="px-6 py-4 text-sm font-bold text-slate-500 dark:text-slate-400 font-mono">
                                    #{{ str_pad($invoice->invoiceID, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-black text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-600 shadow-sm">
                                            {{ substr($invoice->student->name ?? 'N', 0, 1) }}
                                        </div>
                                        <div>
                                            <div
                                                class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-sm group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                {{ $invoice->student->name ?? 'N/A' }}
                                            </div>
                                            <p
                                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                                {{ $invoice->classes->classes ?? 'S/G' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-bold text-slate-600 dark:text-slate-300 uppercase truncate max-w-[150px] inline-block"
                                        title="{{ $invoice->feetypes }}">
                                        {{ $invoice->feetypes }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-black text-slate-900 dark:text-white">${{ number_format($netAmount, 2) }}</span>
                                        @if ($invoice->discount > 0)
                                            <span
                                                class="text-[9px] font-bold text-emerald-500 uppercase tracking-tight">-{{ $invoice->discount }}%
                                                Desc.</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-bold text-slate-600 dark:text-slate-400">${{ number_format($invoice->paidamount, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($invoice->status == 0)
                                        <span
                                            class="px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 text-[10px] font-black uppercase tracking-widest border border-rose-100 dark:border-rose-500/20">Deuda</span>
                                    @elseif ($invoice->status == 1)
                                        <span
                                            class="px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest border border-amber-100 dark:border-amber-500/20">Parcial</span>
                                    @else
                                        <span
                                            class="px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest border border-emerald-100 dark:border-emerald-500/20">Pagado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('invoice.show', $invoice->invoiceID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                            title="Ver Detalle / Pagos">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('invoice.edit', $invoice->invoiceID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('invoice.destroy', $invoice->invoiceID) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Eliminar esta factura y todos sus registros de pago?')">
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
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-20 text-center">
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                                        <i class="ti ti-file-invoice text-4xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay facturas
                                        emitidas</h3>
                                    <p class="text-slate-400 dark:text-slate-500 mt-2">Crea cargos para estudiantes por
                                        grado o de forma individual.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
