<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('notice.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-purple-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Detalle del Anuncio
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Vista completa del comunicado
                        oficial</p>
                </div>
            </div>
            @admin
                <div class="flex items-center gap-3">
                    <a href="{{ route('notice.edit', $notice->noticeID) }}"
                        class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-edit text-lg"></i>
                        Editar Anuncio
                    </a>
                </div>
            @endadmin
        </div>

        <!-- Article Section -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-12 shadow-sm dark:shadow-none relative overflow-hidden">
            <div
                class="absolute -top-24 -right-24 w-64 h-64 bg-purple-500/5 dark:bg-purple-500/10 rounded-full blur-3xl">
            </div>

            <header class="mb-12 relative">
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="px-4 py-1.5 rounded-full bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 text-[10px] font-black uppercase tracking-widest border border-purple-200 dark:border-purple-500/30 shadow-sm">
                        Comunicado Oficial
                    </span>
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <i class="ti ti-calendar text-sm"></i>
                        {{ \Carbon\Carbon::parse($notice->date)->format('d F, Y') }}
                    </span>
                </div>

                <h2
                    class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-[1.1] capitalize">
                    {{ $notice->title }}
                </h2>
            </header>

            <div class="prose prose-slate dark:prose-invert max-w-none relative">
                <div
                    class="text-lg md:text-xl text-slate-600 dark:text-slate-300 font-medium leading-relaxed whitespace-pre-line">
                    {{ $notice->notice }}
                </div>
            </div>

            <footer
                class="mt-16 pt-8 border-t border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-6 relative">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-300 dark:text-slate-600 border border-slate-100 dark:border-slate-800">
                        <i class="ti ti-school text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Emitido por</p>
                        <p class="text-sm font-black text-slate-900 dark:text-white tracking-tight uppercase">Dirección
                            Académica</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="window.print()"
                        class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 text-slate-400 hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent">
                        <i class="ti ti-printer text-xl"></i>
                    </button>
                    <button
                        class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 text-slate-400 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center shadow-sm border border-slate-100 dark:border-transparent">
                        <i class="ti ti-share text-xl"></i>
                    </button>
                </div>
            </footer>
        </div>

        <!-- Floating Action Button for Students/Parents (Signaling Read) -->
        <div class="mt-8 flex justify-center">
            <button
                class="px-8 py-4 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white font-black text-sm uppercase tracking-widest shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                <i class="ti ti-check text-emerald-500 text-xl"></i>
                Marcar como leído
            </button>
        </div>
    </div>
</x-app-layout>
