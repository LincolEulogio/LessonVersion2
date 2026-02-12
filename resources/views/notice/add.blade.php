<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 border border-slate-200 dark:border-purple-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nuevo Anuncio
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Crea un comunicado para el
                        tablón digital</p>
                </div>
            </div>
            <a href="{{ route('notice.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-purple-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500/5 dark:bg-purple-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('notice.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Title -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="title"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Título
                            del Anuncio</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Ej: Suspensión de clases por feriado">
                        @error('title')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="date"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Publicación</label>
                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>
                </div>

                <!-- Rich Text Area (Simple for now, can use Trix/CKEditor if preferred) -->
                <div class="space-y-2">
                    <label for="notice"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Contenido
                        del Comunicado</label>
                    <textarea name="notice" id="notice" rows="10" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none"
                        placeholder="Escribe aquí los detalles del anuncio..."></textarea>
                    @error('notice')
                        <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('notice.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-purple-600 hover:bg-purple-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-purple-600/30 hover:shadow-purple-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-speakerphone text-xl"></i>
                        Publicar Ahora
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
