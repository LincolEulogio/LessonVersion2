<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2">
                    <i class="ti ti-smart-home text-sm"></i>
                    {{ __('Dashboard') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('mark.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Calificaciones') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Porcentajes') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Tipos de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Evaluación') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                        {{ __('Configure los pesos y porcentajes para cada tipo de nota') }}
                    </p>
                </div>

                <a href="{{ route('markpercentage.create') }}"
                    class="group px-8 py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] shadow-2xl shadow-emerald-500/30 font-black text-[10px] uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-3 overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                    <i class="ti ti-plus text-lg"></i>
                    {{ __('Nuevo Tipo') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($markpercentages as $item)
                <div
                    class="group p-8 rounded-[3rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:translate-y-[-8px] hover:shadow-2xl hover:shadow-emerald-500/10">
                    <div class="flex justify-between items-start mb-8">
                        <div
                            class="w-16 h-16 rounded-3xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                            <i class="ti ti-percentage text-3xl"></i>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('markpercentage.edit', $item->markpercentageID) }}"
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                                <i class="ti ti-edit text-lg"></i>
                            </a>
                            <form action="{{ route('markpercentage.destroy', $item->markpercentageID) }}"
                                method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this)"
                                    class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center text-slate-400 hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3
                            class="text-2xl font-black text-slate-800 dark:text-white uppercase italic tracking-tighter">
                            {{ $item->markpercentage }}
                        </h3>
                        <div class="flex items-center justify-between">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Peso sobre el total') }}</span>
                            <span
                                class="text-3xl font-black text-emerald-500 italic tracking-tighter">{{ $item->markpercentage_numeric }}%</span>
                        </div>
                        <div class="h-2 w-full bg-slate-100 dark:bg-slate-900 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full group-hover:animate-pulse transition-all duration-1000"
                                style="width: {{ $item->markpercentage_numeric }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(btn) {
                const form = btn.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará este tipo de evaluación permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#f43f5e',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
