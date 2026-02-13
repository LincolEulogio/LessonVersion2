<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-emerald-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-info-circle text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Detalle del Libro
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ficha técnica y disponibilidad
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('book.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Volver
                </a>
                <a href="{{ route('book.edit', $book->bookID) }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-amber-600 text-white font-black text-xs uppercase tracking-widest hover:bg-amber-500 transition-all shadow-lg shadow-amber-600/20">
                    <i class="ti ti-edit text-lg"></i>
                    Editar Libro
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Book Cover Placeholder/Highlight -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 text-center shadow-sm relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl"></div>

                    <div class="relative inline-block mb-6">
                        <div
                            class="w-40 h-56 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-2xl flex items-center justify-center p-6 text-white text-center">
                            <div>
                                <i class="ti ti-book text-6xl mb-4 opacity-50"></i>
                                <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Libro</p>
                                <p class="font-bold text-sm leading-tight mt-1">{{ $book->book }}</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 dark:text-white leading-tight mb-1">{{ $book->book }}
                    </h3>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6">
                        {{ $book->author }}</p>

                    <div class="flex flex-col gap-3">
                        <div
                            class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 flex justify-between items-center text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Código</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $book->subject_code }}</span>
                        </div>
                        <div
                            class="px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 flex justify-between items-center text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estante</span>
                            <span
                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $book->rack }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stock Status -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Estado de
                        Disponibilidad</h4>

                    @php $available = $book->quantity - $book->due_quantity; @endphp
                    <div class="space-y-6">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Disponibles
                                </p>
                                <h5 class="text-3xl font-black text-emerald-600">{{ $available }}</h5>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total</p>
                                <h5 class="text-xl font-black text-slate-900 dark:text-white">{{ $book->quantity }}</h5>
                            </div>
                        </div>

                        <div
                            class="h-3 w-full bg-slate-100 dark:bg-slate-900 rounded-full overflow-hidden border border-slate-100 dark:border-slate-700">
                            <div class="h-full bg-emerald-500 transition-all duration-1000"
                                style="width: {{ ($available / max(1, $book->quantity)) * 100 }}%"></div>
                        </div>

                        <div
                            class="flex items-center gap-3 p-4 rounded-2xl {{ $available > 0 ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20' : 'bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-400 border-rose-100 dark:border-rose-500/20' }} border">
                            <i class="ti {{ $available > 0 ? 'ti-check' : 'ti-alert-triangle' }} text-xl"></i>
                            <p class="text-xs font-bold">
                                {{ $available > 0 ? 'Libro disponible para préstamo inmediato.' : 'No hay ejemplares disponibles en este momento.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Technical Info & History Placeholder -->
            <div class="lg:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest mb-8 flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <i class="ti ti-list-details"></i>
                        </span>
                        Especificaciones Técnicas
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Autor Principal</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ $book->author }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Valor Unitario</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                ${{ number_format($book->price, 2) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Ejemplares en Préstamo</p>
                            <p class="text-xl font-black text-blue-600">{{ $book->due_quantity }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Código Referencia</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ $book->subject_code }}</p>
                        </div>
                    </div>
                </div>

                <!-- History / Recent Issues Placeholder -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest mb-8 flex items-center gap-3">
                        <i class="ti ti-history text-lg text-slate-400"></i>
                        Registro de Ubicación
                    </h4>
                    <div
                        class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-500 flex items-center justify-center">
                                <i class="ti ti-map-pin text-2xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-slate-900 dark:text-white text-sm">Localización Física</h5>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Este libro se encuentra
                                    ubicado en el estante <strong>{{ $book->rack }}</strong>, organizado por el
                                    código de materia <strong>{{ $book->subject_code }}</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
