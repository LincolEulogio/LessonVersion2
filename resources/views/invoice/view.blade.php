<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header & Balance Banner -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('invoice.index') }}"
                    class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-white transition-all flex items-center justify-center group shadow-sm">
                    <i class="ti ti-arrow-left text-xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Detalle de Factura</h1>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                        #{{ str_pad($invoice->invoiceID, 6, '0', STR_PAD_LEFT) }} |
                        {{ \Carbon\Carbon::parse($invoice->date)->format('d M, Y') }}</p>
                </div>
            </div>

            <div
                class="flex items-center gap-4 bg-white dark:bg-slate-800/30 p-2 pl-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl shadow-sm">
                @php
                    $discountAmount = ($invoice->amount * $invoice->discount) / 100;
                    $netAmount = $invoice->amount - $discountAmount;
                    $balance = $netAmount - $invoice->paidamount;
                @endphp
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Saldo
                        Pendiente</p>
                    <p
                        class="text-xl font-black {{ $balance > 0 ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                        ${{ number_format((float) $balance, 2) }}</p>
                </div>
                @if ($balance > 0)
                    <a href="{{ route('payment.create', ['invoiceID' => $invoice->invoiceID]) }}"
                        class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20 flex items-center gap-2">
                        <i class="ti ti-plus text-lg"></i> Pagar
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Student Card -->
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm">
                        <p
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <i class="ti ti-user text-indigo-500"></i> Estudiante
                        </p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-lg font-black text-slate-400 shadow-inner">
                                {{ substr($invoice->student->name ?? 'N', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                    {{ $invoice->student->name ?? 'N/A' }}</p>
                                <p class="text-xs font-bold text-slate-500">{{ $invoice->classes->classes ?? 'S/G' }} |
                                    Roll: {{ $invoice->student->roll ?? '0' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Concept Card -->
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm">
                        <p
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <i class="ti ti-coin text-emerald-500"></i> Concepto de Cobro
                        </p>
                        <p
                            class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-lg leading-tight">
                            {{ $invoice->feetypes }}</p>
                        <p class="text-xs font-bold text-slate-500 mt-1">
                            {{ \Carbon\Carbon::parse($invoice->date)->format('F, Y') }}</p>
                    </div>
                </div>

                <!-- Payment History -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
                    <div
                        class="px-8 py-6 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                        <h3
                            class="font-black text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                            <i class="ti ti-history text-indigo-500"></i> Historial de Pagos
                        </h3>
                    </div>
                    @if ($payments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                                        <th class="px-8 py-4">Fecha</th>
                                        <th class="px-8 py-4">Transacción</th>
                                        <th class="px-8 py-4">Método</th>
                                        <th class="px-8 py-4 text-right">Monto</th>
                                        <th class="px-8 py-4 text-right">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                                    @foreach ($payments as $payment)
                                        <tr
                                            class="group hover:bg-slate-50/50 dark:hover:bg-slate-900/50 transition-all">
                                            <td class="px-8 py-4 text-xs font-bold text-slate-600 dark:text-slate-400">
                                                {{ \Carbon\Carbon::parse($payment->paymentdate)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-8 py-4 text-xs font-mono font-bold text-slate-400">
                                                {{ $payment->transactionID }}
                                            </td>
                                            <td class="px-8 py-4">
                                                <span
                                                    class="px-2 py-0.5 rounded flex items-center gap-1 w-fit bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[9px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-600">
                                                    <i class="ti ti-credit-card"></i> {{ $payment->paymenttype }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-8 py-4 text-right font-black text-slate-900 dark:text-white text-sm">
                                                ${{ number_format((float) $payment->paymentamount, 2) }}
                                            </td>
                                            <td class="px-8 py-4 text-right">
                                                <form action="{{ route('payment.destroy', $payment->paymentID) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('¿Revertir este pago?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-rose-500 hover:text-rose-700 transition-colors">
                                                        <i class="ti ti-trash text-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <p class="text-slate-400 dark:text-slate-500 font-bold text-xs">No se han registrado pagos
                                para esta factura.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Summary Card -->
            <div class="space-y-6">
                <div
                    class="bg-indigo-600 dark:bg-indigo-500/20 border border-indigo-700 dark:border-indigo-500/30 rounded-3xl p-8 relative overflow-hidden shadow-xl shadow-indigo-600/20">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <p
                            class="text-[10px] font-black text-indigo-100 dark:text-indigo-400 uppercase tracking-widest mb-6">
                            Resumen Económico</p>

                        <div class="space-y-4">
                            <div
                                class="flex justify-between items-center bg-white/5 p-3 rounded-2xl border border-white/10">
                                <span class="text-xs text-indigo-100/70 font-bold">Monto Base</span>
                                <span
                                    class="text-sm font-black text-white">${{ number_format((float) $invoice->amount, 2) }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center bg-white/5 p-3 rounded-2xl border border-white/10">
                                <span class="text-xs text-indigo-100/70 font-bold">Descuento
                                    ({{ $invoice->discount }}%)</span>
                                <span
                                    class="text-sm font-black text-emerald-300">-${{ number_format((float) $discountAmount, 2) }}</span>
                            </div>
                            <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                                <span class="text-sm font-black text-white uppercase tracking-tight">Total Neto</span>
                                <span
                                    class="text-2xl font-black text-white">${{ number_format((float) $netAmount, 2) }}</span>
                            </div>
                            <div class="pt-2 flex justify-between items-center text-indigo-100/80">
                                <span class="text-xs font-bold italic">Total Pagado</span>
                                <span
                                    class="text-sm font-black">-${{ number_format((float) $invoice->paidamount, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-white/20">
                            <div class="flex flex-col items-center">
                                <span class="text-[10px] font-black text-indigo-100/60 uppercase tracking-widest">Saldo
                                    Restante</span>
                                <span
                                    class="text-3xl font-black text-white mt-1">${{ number_format((float) $balance, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div
                    class="p-6 rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/30 flex items-center justify-between">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estado</span>
                    @if ($invoice->status == 0)
                        <span class="text-rose-600 dark:text-rose-400 font-black uppercase text-xs">Sin Pago</span>
                    @elseif ($invoice->status == 1)
                        <span class="text-amber-600 dark:text-amber-400 font-black uppercase text-xs">Pago
                            Parcial</span>
                    @else
                        <span
                            class="text-emerald-600 dark:text-emerald-400 font-black uppercase text-xs flex items-center gap-1.5">
                            <i class="ti ti-circle-check"></i> Liquidado
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
