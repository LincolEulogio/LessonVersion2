<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 border border-slate-200 dark:border-purple-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-speakerphone text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Tablón de Anuncios
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Comuníca información
                        importante a la comunidad escolar</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('notice.create') }}"
                    class="px-6 py-3 rounded-2xl bg-purple-600 hover:bg-purple-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-purple-600/20 hover:shadow-purple-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Nuevo Anuncio
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 animate-in fade-in slide-in-from-top-4 duration-500">
                <div
                    class="w-8 h-8 rounded-lg bg-white dark:bg-emerald-500/20 flex items-center justify-center shadow-sm">
                    <i class="ti ti-circle-check text-xl"></i>
                </div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Notice Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($notices as $notice)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm dark:shadow-none hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500/5 dark:bg-purple-500/10 rounded-full blur-3xl group-hover:bg-purple-500/15 transition-all">
                    </div>

                    <div class="flex items-start justify-between mb-4 relative">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2.5 py-1 rounded-lg bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 text-[9px] font-black uppercase tracking-widest border border-purple-100 dark:border-purple-500/20">
                                {{ \Carbon\Carbon::parse($notice->date)->format('d M, Y') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('notice.edit', $notice->noticeID) }}"
                                class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-purple-600 hover:text-white dark:hover:bg-purple-500 dark:hover:text-white transition-all">
                                <i class="ti ti-edit text-base"></i>
                            </a>
                            <form action="{{ route('notice.destroy', $notice->noticeID) }}" method="POST"
                                class="inline" onsubmit="return confirm('¿Eliminar este anuncio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 dark:hover:text-white transition-all">
                                    <i class="ti ti-trash text-base"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3
                        class="font-black text-slate-900 dark:text-white text-lg tracking-tight mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors capitalize">
                        {{ $notice->title }}
                    </h3>

                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium line-clamp-3 mb-6">
                        {{ strip_tags($notice->notice) }}
                    </p>

                    <div
                        class="pt-4 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                        <span
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Publicado
                            Hoy</span>
                        <a href="{{ route('notice.show', $notice->noticeID) }}"
                            class="text-[10px] font-black text-purple-600 dark:text-purple-400 uppercase tracking-widest flex items-center gap-1 hover:gap-2 transition-all">
                            Leer más <i class="ti ti-arrow-right text-sm"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div
                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                        <i class="ti ti-speakerphone text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay anuncios publicados</h3>
                    <p class="text-slate-400 dark:text-slate-500 mt-2">Mantén informada a tu comunidad con noticias y
                        actualizaciones.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
