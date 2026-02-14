<x-app-layout>
    <div class="py-8 px-4 max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                <i class="ti ti-smart-home text-sm"></i>
                {{ __('Dashboard') }}
            </a>
            <i class="ti ti-chevron-right text-[8px]"></i>
            <span class="text-slate-300">{{ __('Académico') }}</span>
            <i class="ti ti-chevron-right text-[8px]"></i>
            <span class="text-amber-500/80">{{ __('Escalas Evaluación') }}</span>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">
            <div class="relative">
                <h1
                    class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter flex flex-wrap items-center gap-x-4">
                    {{ __('Escalas de') }}
                    <span class="relative inline-block text-amber-500">
                        {{ __('Evaluación') }}
                        <div
                            class="absolute -bottom-2 left-0 w-full h-4 bg-amber-500/10 -rotate-1 -z-10 rounded-full blur-sm">
                        </div>
                    </span>
                </h1>
                <div class="flex items-center gap-3 mt-4">
                    <div class="w-3 h-3 rounded-full bg-amber-500/30 flex items-center justify-center">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                        {{ __('Definición de rangos y niveles de rendimiento académico') }}
                    </p>
                </div>
            </div>

            @if (Auth::user()->hasPermission('grado_add'))
                <div class="flex shrink-0">
                    <a href="{{ route('grade.create') }}"
                        class="group relative inline-flex items-center gap-3 bg-amber-600 hover:bg-amber-500 text-white px-8 py-4 rounded-full font-black uppercase text-[11px] tracking-widest shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all duration-300">
                        <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform duration-500"></i>
                        <span>{{ __('Nuevo Grado') }}</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Grade Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 px-4">
            @foreach ($grades as $grade)
                <div
                    class="group relative bg-white dark:bg-slate-800 p-8 rounded-[2rem] border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">

                    <!-- Top Section: Grade Badge & Actions -->
                    <div class="flex flex-col items-center justify-between mb-8">
                        <div
                            class="rounded-2xl h-12 bg-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-500/20 mb-4 w-full">
                            <span class="text-md font-black italic tracking-tighter">{{ $grade->grade }}</span>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('grade.show', $grade->gradeID) }}"
                                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-amber-500 transition-colors border border-slate-100 dark:border-slate-700">
                                <i class="ti ti-eye text-lg"></i>
                            </a>
                            @if (Auth::user()->hasPermission('grado_edit'))
                                <a href="{{ route('grade.edit', $grade->gradeID) }}"
                                    class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-amber-500 transition-colors border border-slate-100 dark:border-slate-700">
                                    <i class="ti ti-edit text-lg"></i>
                                </a>
                            @endif
                            @if (Auth::user()->hasPermission('grado_delete'))
                                <form action="{{ route('grade.destroy', $grade->gradeID) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-500 transition-colors border border-slate-100 dark:border-slate-700">
                                        <i class="ti ti-trash text-lg"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Points Display -->
                    <div class="mb-8">
                        <span
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">{{ __('Grade Point') }}</span>
                        <div class="flex items-baseline gap-2">
                            <p class="text-5xl font-black text-slate-900 dark:text-white italic tracking-tighter">
                                {{ number_format((float) $grade->point, 2) }}
                            </p>
                            <span class="text-sm font-bold text-amber-500">pts</span>
                        </div>
                    </div>

                    <!-- Range Container -->
                    <div
                        class="bg-slate-50 dark:bg-slate-900/40 rounded-3xl p-6 mb-6 border border-slate-100 dark:border-slate-800/50">
                        <div class="flex justify-between items-center mb-4">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Rendimiento') }}</span>
                            <div class="flex items-center gap-3">
                                <span
                                    class="text-xs font-black text-slate-700 dark:text-slate-300">{{ $grade->markfrom }}%</span>
                                <i class="ti ti-arrow-right text-[10px] text-slate-300"></i>
                                <span
                                    class="text-xs font-black text-slate-700 dark:text-slate-300">{{ $grade->markto }}%</span>
                            </div>
                        </div>
                        <div class="h-2 w-full bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                            <div style="width: {{ $grade->markfrom }}%" class="h-full bg-transparent"></div>
                            <div style="width: {{ $grade->markto - $grade->markfrom }}%"
                                class="h-full bg-linear-to-r from-amber-400 to-amber-600 rounded-full shadow-[0_0_12px_rgba(245,158,11,0.3)]">
                            </div>
                        </div>
                    </div>

                    <!-- Footer Note -->
                    @if ($grade->note)
                        <div class="flex items-start gap-3 px-1">
                            <i class="ti ti-notes text-amber-500/30 text-base mt-0.5"></i>
                            <p
                                class="text-[11px] text-slate-500 dark:text-slate-400 font-bold italic line-clamp-2 leading-relaxed">
                                {{ $grade->note }}
                            </p>
                        </div>
                    @else
                        <div class="h-6"></div>
                    @endif
                </div>
            @endforeach
        </div>

        @if ($grades->isEmpty())
            <div
                class="py-24 text-center rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-slate-800/30 mx-4">
                <div class="w-20 h-20 bg-amber-500/10 rounded-[2rem] flex items-center justify-center mx-auto mb-8">
                    <i class="ti ti-chart-bar text-4xl text-amber-500/50"></i>
                </div>
                <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                    {{ __('No hay escalas registradas') }}
                </h3>
                <p class="text-sm font-bold text-slate-400 mt-2">
                    {{ __('Comienza añadiendo una nueva escala de calificación.') }}</p>
                @if (Auth::user()->hasPermission('grado_add'))
                    <a href="{{ route('grade.create') }}"
                        class="group relative inline-flex items-center gap-3 bg-amber-600 hover:bg-amber-500 text-white px-8 py-4 rounded-full font-black uppercase text-[11px] tracking-widest shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all duration-300 mt-4">
                        <i class="ti ti-plus text-lg"></i>
                        <span>{{ __('Crear Primer Grado') }}</span>
                    </a>
                @endif
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function confirmDelete(button) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
