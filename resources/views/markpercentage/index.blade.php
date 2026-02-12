<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-notebook text-indigo-500"></i>
                    Porcentajes de Calificación
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Configura los diferentes pesos y
                    categorías para las evaluaciones.</p>
            </div>
            <a href="{{ route('markpercentage.create') }}"
                class="inline-flex items-center gap-3 px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-[2rem] transition-all transform hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-indigo-500/30">
                <i class="ti ti-plus text-xl"></i>
                Nuevo Porcentaje
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($markpercentages as $percentage)
                <div
                    class="group relative p-8 rounded-[3rem] bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 hover:border-indigo-500/50 transition-all duration-300 shadow-sm hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-16 h-16 rounded-3xl bg-indigo-500/10 flex items-center justify-center text-indigo-500 group-hover:scale-110 transition-transform">
                            <i class="ti ti-percentage text-3xl"></i>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('markpercentage.edit', $percentage->markpercentageID) }}"
                                class="p-2.5 bg-slate-50 dark:bg-slate-900/50 rounded-xl text-slate-400 hover:text-indigo-500 transition-colors">
                                <i class="ti ti-edit text-lg"></i>
                            </a>
                            <form action="{{ route('markpercentage.destroy', $percentage->markpercentageID) }}"
                                method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf @method('DELETE')
                                <button
                                    class="p-2.5 bg-slate-50 dark:bg-slate-900/50 rounded-xl text-slate-400 hover:text-rose-500 transition-colors">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight">
                            {{ $percentage->markpercentage }}</h3>
                        <div class="mt-4 flex items-center gap-4">
                            <div class="px-5 py-2 bg-indigo-500 text-white rounded-2xl font-black text-xl">
                                {{ $percentage->markpercentage_numeric }}%
                            </div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Peso
                                Académico</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($markpercentages->isEmpty())
            <div
                class="py-20 text-center rounded-[3rem] border-4 border-dashed border-slate-200 dark:border-slate-700/30 bg-slate-50/50 dark:bg-slate-800/10">
                <i class="ti ti-percentage text-6xl text-slate-300 mb-4 block"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Sin porcentajes configurados</h3>
                <p class="text-slate-500 mt-2">Empieza creando categorías como 'Examen Final (40%)' o 'Tareas (20%)'.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
