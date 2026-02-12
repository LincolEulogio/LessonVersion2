<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header & Navigation -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('event.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-blue-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div class="flex items-center gap-2">
                @admin
                    <a href="{{ route('event.edit', $event->eventID) }}"
                        class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg flex items-center gap-2">
                        <i class="ti ti-edit text-lg"></i>
                        Editar
                    </a>
                @endadmin
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Cover Image -->
                <div
                    class="relative aspect-video rounded-[40px] overflow-hidden bg-slate-100 dark:bg-slate-900 shadow-2xl">
                    @if ($event->photo)
                        <img src="{{ asset('uploads/images/' . $event->photo) }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-200 dark:text-slate-800">
                            <i class="ti ti-calendar-event text-9xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-10 left-10 right-10">
                        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight capitalize">
                            {{ $event->title }}</h1>
                    </div>
                </div>

                <!-- Content Body -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-12 shadow-sm">
                    <div class="prose prose-slate dark:prose-invert max-w-none">
                        <p
                            class="text-xl md:text-2xl text-slate-600 dark:text-slate-300 font-medium leading-relaxed whitespace-pre-line">
                            {{ $event->details }}
                        </p>
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-700/50">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Compartir
                            evento</h4>
                        <div class="flex items-center gap-3">
                            <button
                                class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 text-slate-500 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="ti ti-brand-facebook text-xl"></i>
                            </button>
                            <button
                                class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 text-slate-500 hover:bg-sky-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="ti ti-brand-twitter text-xl"></i>
                            </button>
                            <button
                                class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700 text-slate-500 hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                <i class="ti ti-brand-whatsapp text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Data Card -->
                <div
                    class="bg-blue-600 dark:bg-blue-500/20 border border-blue-700 dark:border-blue-500/30 rounded-[40px] p-8 text-white relative overflow-hidden shadow-xl shadow-blue-600/20">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>

                    <h4 class="text-[10px] font-black uppercase tracking-widest text-blue-100 dark:text-blue-400 mb-8">
                        Cuándo y Dónde</h4>

                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-2xl shrink-0">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-blue-100/70 uppercase tracking-widest mb-1">Inicia
                                </p>
                                <p class="text-lg font-black leading-tight">
                                    {{ \Carbon\Carbon::parse($event->fdate)->format('l, d M Y') }}</p>
                                <p class="text-sm font-bold text-blue-100/80">{{ $event->ftime }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-2xl shrink-0">
                                <i class="ti ti-calendar-check"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-blue-100/70 uppercase tracking-widest mb-1">
                                    Finaliza</p>
                                <p class="text-lg font-black leading-tight">
                                    {{ \Carbon\Carbon::parse($event->tdate)->format('l, d M Y') }}</p>
                                <p class="text-sm font-bold text-blue-100/80">{{ $event->ttime }}</p>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-white/10">
                            <button
                                class="w-full py-4 rounded-2xl bg-white text-blue-600 font-black text-xs uppercase tracking-widest hover:bg-blue-50 hover:scale-[1.02] active:scale-95 transition-all shadow-lg flex items-center justify-center gap-2">
                                <i class="ti ti-bell-plus text-lg"></i>
                                Recordarme
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Organizer / Location -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm text-center">
                    <div
                        class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center mx-auto mb-4 border border-slate-100 dark:border-slate-600 shadow-inner">
                        <i class="ti ti-map-pin text-3xl text-slate-400"></i>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ubicación</p>
                    <p class="text-sm font-black text-slate-900 dark:text-white mt-1 uppercase tracking-tight">
                        Instalaciones del Plantel</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
