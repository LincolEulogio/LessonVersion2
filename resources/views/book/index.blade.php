<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-books text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Catálogo de Libros
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de inventario y
                        títulos bibliográficos</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('book.create') }}"
                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-600 text-white font-black text-xs uppercase tracking-widest hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-600/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    Agregar Libro
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                    Total Títulos</p>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">{{ $books->count() }}</h4>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                    Total Ejemplares</p>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">{{ $books->sum('quantity') }}</h4>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">En
                    Préstamo</p>
                <h4 class="text-3xl font-black text-blue-600 dark:text-blue-400">{{ $books->sum('due_quantity') }}</h4>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                    Disponibles</p>
                <h4 class="text-3xl font-black text-emerald-600 dark:text-emerald-400">
                    {{ $books->sum('quantity') - $books->sum('due_quantity') }}</h4>
            </div>
        </div>

        <!-- Books Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700/50">
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Libro / Autor</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Código</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Estante</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Stock</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Precio</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($books as $book)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 flex items-center justify-center border border-emerald-100 dark:border-emerald-500/20">
                                            <i class="ti ti-book text-xl"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                                                {{ $book->book }}</p>
                                            <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500">Por:
                                                {{ $book->author }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase border border-slate-200 dark:border-slate-700">
                                        {{ $book->subject_code }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-slate-600 dark:text-slate-400">
                                    {{ $book->rack }}
                                </td>
                                <td class="px-6 py-5">
                                    @php $available = $book->quantity - $book->due_quantity; @endphp
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black {{ $available > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $available }} de {{ $book->quantity }}
                                        </span>
                                        <div
                                            class="h-1 w-16 bg-slate-100 dark:bg-slate-700 rounded-full mt-1 overflow-hidden">
                                            <div class="h-full bg-emerald-500"
                                                style="width: {{ ($available / max(1, $book->quantity)) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm font-black text-slate-900 dark:text-white">
                                    ${{ number_format($book->price, 2) }}
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('book.show', $book->bookID) }}"
                                            class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('book.edit', $book->bookID) }}"
                                            class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button
                                            onclick="confirmDeletion('{{ route('book.destroy', $book->bookID) }}', '{{ $book->book }}')"
                                            class="w-9 h-9 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <p
                                        class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                                        No hay libros en el catálogo</p>
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
            function confirmDeletion(url, name) {
                Swal.fire({
                    title: '¿Eliminar Libro?',
                    text: `Vas a eliminar "${name}" del catálogo. Esta acción es permanente.`,
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
