<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-cash text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Registrar Pago
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Abono o liquidación de factura
                        escolar</p>
                </div>
            </div>
            <a href="{{ $invoice ? route('invoice.show', $invoice->invoiceID) : route('invoice.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-emerald-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-500/5 dark:bg-emerald-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('payment.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                @if ($invoice)
                    <input type="hidden" name="invoiceID" value="{{ $invoice->invoiceID }}">

                    <!-- Invoice Summary Info -->
                    <div
                        class="p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div>
                            <p
                                class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest pl-1">
                                Estudiante</p>
                            <p class="text-lg font-black text-slate-900 dark:text-white">
                                {{ $invoice->student->name ?? 'N/A' }}</p>
                            <p class="text-xs font-bold text-slate-500 mt-0.5">{{ $invoice->feetypes }}</p>
                        </div>
                        <div class="text-right">
                            @php
                                $discountAmount = ($invoice->amount * $invoice->discount) / 100;
                                $netAmount = $invoice->amount - $discountAmount;
                                $balance = $netAmount - $invoice->paidamount;
                            @endphp
                            <p
                                class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">
                                Saldo Pendiente</p>
                            <p class="text-2xl font-black text-slate-900 dark:text-white">
                                ${{ number_format((float) $balance, 2) }}</p>
                        </div>
                    </div>
                @else
                    <div class="space-y-2">
                        <label for="invoiceID"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Factura</label>
                        <select name="invoiceID" id="invoiceID" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            <option value="">Seleccione factura pendiente...</option>
                            @foreach (\App\Models\Invoice::where('status', '<', 2)->with('student')->get() as $inv)
                                <option value="{{ $inv->invoiceID }}">{{ $inv->student->name }} - {{ $inv->feetypes }}
                                    (#{{ $inv->invoiceID }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Amount -->
                    <div class="space-y-2">
                        <label for="paymentamount"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Monto
                            a Pagar ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" step="0.01" name="paymentamount" id="paymentamount"
                                value="{{ $invoice ? $balance : '' }}" max="{{ $invoice ? $balance : '' }}" required
                                class="w-full pl-8 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold placeholder-slate-400 dark:placeholder-slate-600">
                        </div>
                    </div>

                    <!-- Payment Type -->
                    <div class="space-y-2">
                        <label for="paymenttype"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Método
                            de Pago</label>
                        <select name="paymenttype" id="paymenttype" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold cursor-pointer">
                            <option value="Cash">Efectivo</option>
                            <option value="Check">Cheque</option>
                            <option value="Card">Tarjeta de Crédito/Débito</option>
                            <option value="Transfer">Transferencia Bancaria</option>
                            <option value="Other">Otro</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="paymentdate"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Pago</label>
                        <input type="date" name="paymentdate" id="paymentdate" value="{{ date('Y-m-d') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>

                    <!-- Reference Number (Manual Transaction ID if needed) -->
                    <div class="space-y-2">
                        <label for="notice"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Notas
                            / Referencia</label>
                        <input type="text" name="notice" id="notice"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Ej: Recibo No. 456">
                    </div>
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ $invoice ? route('invoice.show', $invoice->invoiceID) : route('invoice.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-check text-xl"></i>
                        Confirmar Pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
