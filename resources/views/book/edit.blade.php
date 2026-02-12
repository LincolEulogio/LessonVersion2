<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">

        <!-- Header Section -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-linear-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">
                    📚 Editar Libro
                </h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">Actualiza la información del libro
                    <strong class="text-blue-600 dark:text-blue-400">{{ $book->book }}</strong>.
                </p>
            </div>
            <a href="{{ route('book.index') }}"
                class="p-2.5 rounded-xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition-all shadow-sm dark:shadow-none">
                <i class="ti ti-arrow-left text-xl"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-sm p-8 shadow-sm dark:shadow-none">
            <form action="{{ route('book.update', $book->bookID) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Book Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Título del
                            Libro</label>
                        <input type="text" name="book" value="{{ old('book', $book->book) }}" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="Ej: El Quijote de la Mancha">
                        @error('book')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Autor</label>
                        <input type="text" name="author" value="{{ old('author', $book->author) }}" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="Miguel de Cervantes">
                        @error('author')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Code -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Código de
                            Materia</label>
                        <input type="text" name="subject_code" value="{{ old('subject_code', $book->subject_code) }}"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="LEN-101">
                        @error('subject_code')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Precio
                            ($)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $book->price) }}"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="0.00">
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label
                            class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Cantidad</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $book->quantity) }}" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="10">
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rack -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Ubicación
                            (Rack)</label>
                        <input type="text" name="rack" value="{{ old('rack', $book->rack) }}" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-700 dark:text-slate-200"
                            placeholder="Estante A, Fila 3">
                        @error('rack')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit"
                        class="flex-1 py-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold transition-all shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                        <i class="ti ti-device-floppy text-xl"></i>
                        Actualizar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
