<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-history text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Registro de Pagos
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Historial completo de
                        transacciones e ingresos</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('payment.create') }}"
                    class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Nuevo Pago
                </a>
            </div>
        </div>

        <!-- Payment History Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Estudiante</th>
                            <th class="px-6 py-4">Factura</th>
                            <th class="px-6 py-4">Concepto</th>
                            <th class="px-6 py-4">Método</th>
                            <th class="px-6 py-4 text-center">Monto</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($payments as $payment)
                            <tr class="group hover:bg-emerald-50/30 dark:hover:bg-emerald-500/5 transition-all">
                                <td class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 font-mono">
                                    {{ \Carbon\Carbon::parse($payment->paymentdate)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="flex items-center gap-2 text-sm font-bold text-slate-600 dark:text-slate-300">
                                        {{ $payment->student->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('invoice.show', $payment->invoiceID) }}"
                                        class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase hover:underline">
                                        #{{ str_pad($payment->invoiceID, 5, '0', STR_PAD_LEFT) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-tight">
                                        {{ $payment->invoice->feetypes ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-[9px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-600">
                                        {{ $payment->paymenttype }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-black text-sm border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                                            ${{ number_format((float) $payment->paymentamount, 2) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('payment.destroy', $payment->paymentID) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Eliminar este registro de pago? Se actualizará el saldo de la factura.')">
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
                                        <i class="ti ti-history text-4xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay pagos
                                        registrados</h3>
                                    <p class="text-slate-400 dark:text-slate-500 mt-2">Registra abonos a facturas
                                        escolares aquí.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
