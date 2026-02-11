<x-app-layout>
    <div class="min-h-screen bg-[#0f172a] text-white font-sans selection:bg-cyan-500/30">
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">

            <!-- Header Section -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                        📖 Nuevo Préstamo
                    </h1>
                    <p class="mt-2 text-slate-400">Registra la salida de un libro de la biblioteca.</p>
                </div>
                <a href="{{ route('issue.index') }}"
                    class="p-2.5 rounded-xl bg-slate-800/50 border border-slate-700/50 text-slate-400 hover:text-white transition-all">
                    <i class="ti ti-arrow-left text-xl"></i>
                </a>
            </div>

            <!-- Form Card -->
            <div class="rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm p-8 shadow-2xl">
                <form action="{{ route('issue.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="space-y-6">
                        <!-- Student lID -->
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">ID de Biblioteca (Carnet del
                                Estudiante)</label>
                            <input type="text" name="lID" value="{{ old('lID') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200"
                                placeholder="Ej: LIB-2026-001">
                            @error('lID')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Book Selection -->
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Libro a Prestar</label>
                            <select name="bookID" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200 outline-none">
                                <option value="">Seleccione un libro...</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->bookID }}"
                                        {{ old('bookID') == $book->bookID ? 'selected' : '' }}>
                                        {{ $book->book }} (Disp: {{ $book->quantity - $book->due_quantity }})
                                    </option>
                                @endforeach
                            </select>
                            @error('bookID')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Serial No -->
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Número de Serial
                                    (Copia)</label>
                                <input type="text" name="serial_no" value="{{ old('serial_no') }}" required
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200"
                                    placeholder="Ej: SN-001">
                                @error('serial_no')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Issue Date -->
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Fecha de Préstamo</label>
                                <input type="date" name="issue_date"
                                    value="{{ old('issue_date', now()->toDateString()) }}" required
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200">
                                @error('issue_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-400 mb-2">Fecha de Vencimiento
                                    (Devolución esperada)</label>
                                <input type="date" name="due_date"
                                    value="{{ old('due_date', now()->addDays(7)->toDateString()) }}" required
                                    class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Note -->
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Nota (Opcional)</label>
                            <textarea name="note" rows="3"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900/50 border border-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all text-slate-200 outline-none"
                                placeholder="Observaciones sobre el estado del libro..."></textarea>
                            @error('note')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold transition-all shadow-lg shadow-cyan-500/20 flex items-center justify-center gap-2">
                            <i class="ti ti-book-upload text-xl"></i>
                            Confirmar Préstamo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
