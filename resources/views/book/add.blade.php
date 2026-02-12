<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-bookmark-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nuevo Libro
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ingresa los metadatos del
                        ejemplar</p>
                </div>
            </div>
            <a href="{{ route('book.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-blue-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('book.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Book Title -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Título
                            del Libro</label>
                        <input type="text" name="book" value="{{ old('book') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Ej: El Quijote de la Mancha">
                        @error('book')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Autor</label>
                        <input type="text" name="author" value="{{ old('author') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Miguel de Cervantes">
                        @error('author')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Code -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Código
                            de Materia</label>
                        <input type="text" name="subject_code" value="{{ old('subject_code') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="LEN-101">
                        @error('subject_code')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Precio
                            ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                                class="w-full pl-8 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                                placeholder="0.00">
                        </div>
                        @error('price')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Cantidad
                            de Ejemplares</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold"><i
                                    class="ti ti-stack"></i></span>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" required
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                                placeholder="10">
                        </div>
                        @error('quantity')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rack -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Ubicación
                            física (Rack/Pasillo)</label>
                        <input type="text" name="rack" value="{{ old('rack') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Estante A, Fila 3">
                        @error('rack')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 dark:border-slate-700/50">
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
                        <i class="ti ti-device-floppy text-xl"></i>
                        Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
