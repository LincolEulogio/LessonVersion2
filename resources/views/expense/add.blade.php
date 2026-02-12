<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-rose-500/10 flex items-center justify-center text-rose-600 dark:text-rose-400 border border-slate-200 dark:border-rose-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Registrar Gasto
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ingresa un nuevo egreso al
                        sistema</p>
                </div>
            </div>
            <a href="{{ route('expense.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-rose-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-rose-500/5 dark:bg-rose-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('expense.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="date"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            del Gasto</label>
                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        @error('date')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div class="space-y-2">
                        <label for="amount"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Monto
                            del Egreso ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" step="0.01" name="amount" id="amount"
                                value="{{ old('amount') }}" required
                                class="w-full pl-8 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold placeholder-slate-400 dark:placeholder-slate-600"
                                placeholder="0.00">
                        </div>
                        @error('amount')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Expense Title -->
                <div class="space-y-2">
                    <label for="expense"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Concepto
                        / Título del Gasto</label>
                    <input type="text" name="expense" id="expense" value="{{ old('expense') }}" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                        placeholder="Ej: Pago de Luz - Enero 2026">
                    @error('expense')
                        <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note -->
                <div class="space-y-2">
                    <label for="note"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Notas
                        Adicionales</label>
                    <textarea name="note" id="note" rows="4"
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none"
                        placeholder="Detalles sobre el proveedor, número de factura, etc..."></textarea>
                    @error('note')
                        <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('expense.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-rose-600 hover:bg-rose-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-rose-600/30 hover:shadow-rose-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-device-floppy text-xl"></i>
                        Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
