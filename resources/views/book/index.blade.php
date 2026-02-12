<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-books text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Gestión de Libros
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Inventario y catálogo de
                        ejemplares bibliográficos</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('book.create') }}"
                    class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Añadir Libro
                </a>
            </div>
        </div>

        <!-- Library Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-blue-500/50">
                <div class="flex justify-between items-start relative">
                    <div>
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            Total Ejemplares</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ $books->sum('quantity') }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="ti ti-database text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-orange-500/50">
                <div class="flex justify-between items-start relative">
                    <div>
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            En Préstamo</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ $books->sum('due_quantity') }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-orange-100 dark:border-orange-500/20 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="ti ti-book-upload text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-emerald-500/50">
                <div class="flex justify-between items-start relative">
                    <div>
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            Disponibles</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ $books->sum('quantity') - $books->sum('due_quantity') }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 shadow-sm group-hover:scale-110 transition-transform">
                        <i class="ti ti-book-check text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Table Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Libro</th>
                            <th class="px-6 py-4">Detalles</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @foreach ($books as $book)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all">
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-xs text-slate-400 dark:text-slate-500">#{{ $book->bookID }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20 group-hover:scale-110 transition-transform shadow-sm">
                                            <i class="ti ti-book text-xl"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="font-black text-slate-900 dark:text-white text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                {{ $book->book }}</p>
                                            <p
                                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                                {{ $book->author }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-600/50">
                                                Mat: {{ $book->subject_code }}
                                            </span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-500/5 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-widest border border-blue-100 dark:border-blue-500/10">
                                                Rack: {{ $book->rack }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="flex items-center gap-4 w-full max-w-[120px]">
                                            <div
                                                class="flex-1 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden shadow-inner">
                                                @php
                                                    $percent =
                                                        $book->quantity > 0
                                                            ? (($book->quantity - $book->due_quantity) /
                                                                    $book->quantity) *
                                                                100
                                                            : 0;
                                                    $color =
                                                        $percent > 50
                                                            ? 'bg-emerald-500'
                                                            : ($percent > 20
                                                                ? 'bg-orange-500'
                                                                : 'bg-rose-500');
                                                @endphp
                                                <div class="h-full {{ $color }} transition-all duration-1000"
                                                    style="width: {{ $percent }}%"></div>
                                            </div>
                                            <span
                                                class="text-[10px] font-black text-slate-400 dark:text-slate-500">{{ $book->quantity - $book->due_quantity }}/{{ $book->quantity }}</span>
                                        </div>
                                        @if ($book->quantity - $book->due_quantity > 0)
                                            <span
                                                class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 shadow-sm">Disponible</span>
                                        @else
                                            <span
                                                class="text-[10px] font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest px-2 py-0.5 rounded-full bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 shadow-sm">Agotado</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('book.edit', $book->bookID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                            title="Editar Libro">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('book.destroy', $book->bookID) }}" method="POST"
                                            class="inline" onsubmit="return confirm('¿Eliminar libro del inventario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 dark:hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent"
                                                title="Eliminar">
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
</x-app-layout>
