<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nuevo Libro
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Registrar título en la base de
                        datos</p>
                </div>
            </div>

            <a href="{{ route('book.index') }}"
                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                <i class="ti ti-arrow-left text-lg"></i>
                Volver
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
            <form action="{{ route('book.store') }}" method="POST" class="p-8 md:p-12 space-y-10" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <!-- Title -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Título
                            del Libro</label>
                        <input type="text" name="book" value="{{ old('book') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold text-lg"
                            placeholder="Ej: Cien Años de Soledad">
                        @error('book')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Autor</label>
                        <input type="text" name="author" value="{{ old('author') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Gabriel García Márquez">
                        @error('author')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Subject Code -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Código
                            de Materia</label>
                        <input type="text" name="subject_code" value="{{ old('subject_code') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="ESP-01">
                        @error('subject_code')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Precio
                            Unitario ($)</label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" step="0.01"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        @error('price')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Cantidad
                            (Stock Inicial)</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        @error('quantity')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rack -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Ubicación
                            (Estante)</label>
                        <input type="text" name="rack" value="{{ old('rack') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Ej: Pasillo A, Estante 4">
                        @error('rack')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/30 hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-3">
                        <i class="ti ti-device-floppy text-lg"></i>
                        Registrar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
