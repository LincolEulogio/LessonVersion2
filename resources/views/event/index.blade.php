<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-calendar-event text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Eventos Escolares
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Calendario de actividades y
                        fechas importantes</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('event.create') }}"
                    class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-plus text-lg"></i>
                    Crear Evento
                </a>
            </div>
        </div>

        <!-- Events List -->
        <div class="space-y-6">
            @forelse($events as $event)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 flex flex-col md:flex-row">
                    <!-- Event Media -->
                    <div class="relative w-full md:w-72 h-48 md:h-auto overflow-hidden bg-slate-100 dark:bg-slate-900">
                        @if ($event->photo)
                            <img src="{{ asset('uploads/images/' . $event->photo) }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                                <i class="ti ti-camera-off text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-linear-to-t from-slate-900/60 to-transparent md:hidden"></div>
                    </div>

                    <!-- Event Info -->
                    <div class="flex-1 p-6 md:p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex flex-wrap items-center gap-4 mb-4">
                                <span
                                    class="px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-widest border border-blue-100 dark:border-blue-500/20">
                                    {{ \Carbon\Carbon::parse($event->fdate)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($event->tdate)->format('d M, Y') }}
                                </span>
                                <span
                                    class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    <i class="ti ti-clock text-sm text-blue-500"></i>
                                    {{ $event->ftime }} a {{ $event->ttime }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-black text-slate-900 dark:text-white tracking-tight mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors capitalize">
                                {{ $event->title }}
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium line-clamp-2">
                                {{ strip_tags($event->details) }}
                            </p>
                        </div>

                        <div
                            class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div
                                    class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 bg-slate-200 flex items-center justify-center text-[10px] font-bold">
                                    JD</div>
                                <div
                                    class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-800 bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600">
                                    +12</div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('event.show', $event->eventID) }}"
                                    class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all">
                                    Detalles
                                </a>
                                @admin
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('event.edit', $event->eventID) }}"
                                            class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 hover:text-blue-600 flex items-center justify-center transition-all border border-slate-100 dark:border-transparent">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('event.destroy', $event->eventID) }}" method="POST"
                                            class="inline" onsubmit="return confirm('¿Eliminar este evento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-400 hover:text-rose-600 flex items-center justify-center transition-all border border-slate-100 dark:border-transparent">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endadmin
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <div
                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                        <i class="ti ti-calendar-event text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Inicia la agenda escolar</h3>
                    <p class="text-slate-400 dark:text-slate-500 mt-2">Registra eventos, ceremonias, juntas o
                        actividades deportivas.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
