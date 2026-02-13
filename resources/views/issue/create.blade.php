<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-slate-200 dark:border-orange-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-bookmark-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nuevo Préstamo
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Asignar libro a un miembro</p>
                </div>
            </div>

            <a href="{{ route('issue.index') }}"
                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                <i class="ti ti-arrow-left text-lg"></i>
                Volver
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
            <form action="{{ route('issue.store') }}" method="POST" class="p-8 md:p-12 space-y-10" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <!-- Member Selection -->
                    <div class="md:col-span-1 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Miembro</label>
                        <select name="lmembercardID"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            <option value="">Seleccione un miembro...</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->lmembercardID }}"
                                    {{ old('lmembercardID') == $member->lmembercardID ? 'selected' : '' }}>
                                    {{ $member->name }} (ID: {{ $member->lmembercardID }})
                                </option>
                            @endforeach
                        </select>
                        @error('lmembercardID')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Book Selection -->
                    <div class="md:col-span-1 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Libro</label>
                        <select name="bookID"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            <option value="">Seleccione un libro disponible...</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->bookID }}"
                                    {{ old('bookID') == $book->bookID ? 'selected' : '' }}>
                                    {{ $book->book }} (Disp: {{ $book->quantity - $book->due_quantity }})
                                </option>
                            @endforeach
                        </select>
                        @error('bookID')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Serial No -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Número
                            de Serie (Cualquier ID único)</label>
                        <input type="text" name="serial_no" value="{{ old('serial_no') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Ej: SN-45220">
                        @error('serial_no')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dates Row -->
                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                                de Préstamo</label>
                            <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}"
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            @error('issue_date')
                                <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                                de Vencimiento</label>
                            <input type="date" name="due_date"
                                value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}"
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            @error('due_date')
                                <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Observaciones
                            / Notas (Opcional)</label>
                        <textarea name="note" rows="3"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-orange-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Ej: El libro tiene un pequeño daño en la portada.">{{ old('note') }}</textarea>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-5 rounded-2xl bg-orange-600 hover:bg-orange-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-orange-600/30 hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-3">
                        <i class="ti ti-bookmark text-lg"></i>
                        Confirmar Préstamo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
