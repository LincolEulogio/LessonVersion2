<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex items-center gap-3 text-slate-400 mb-2">
                    <i class="ti ti-smart-home text-lg"></i>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Gestión') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Asistencia Docente') }}</span>
                </nav>
                <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Control de Personal') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-tighter">
                    {{ __('Monitoreo de puntualidad y asistencia para el equipo docente') }}
                </p>
            </div>
        </div>

        <!-- Selection Card -->
        <div class="max-w-xl">
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden group">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-6 mb-10">
                        <div
                            class="w-16 h-16 bg-emerald-600 text-white rounded-2xl flex items-center justify-center shadow-xl shadow-emerald-600/20 rotate-3 group-hover:rotate-6 transition-transform">
                            <i class="ti ti-user-check text-3xl"></i>
                        </div>
                        <div>
                            <h3
                                class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight italic">
                                {{ __('Panel de Inicio') }}</h3>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                                {{ __('Selecciona la fecha para el registro') }}</p>
                        </div>
                    </div>

                    <form action="{{ route('tattendance.add') }}" method="GET" class="space-y-8">
                        <!-- Date Picker -->
                        <div class="space-y-3">
                            <label for="date"
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Fecha de Asistencia') }}</label>
                            <div class="relative group/select">
                                <i
                                    class="ti ti-calendar-event absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/select:text-emerald-500 transition-colors z-10"></i>
                                <input type="text" name="date" id="date" value="{{ date('d-m-Y') }}" readonly
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold text-sm cursor-pointer flatpickr">
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full bg-slate-900 dark:bg-white dark:text-slate-900 text-white py-5 rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:scale-[1.02] active:scale-95 transition-all shadow-2xl flex items-center justify-center gap-4 group">
                                <i class="ti ti-list-check text-2xl transition-transform group-hover:rotate-12"></i>
                                {{ __('Cargar Listado de Personal') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .flatpickr-calendar {
                background: #fff;
                border-radius: 24px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
                border: 1px solid #f1f5f9;
            }

            .dark .flatpickr-calendar {
                background: #0f172a;
                border-color: #1e293b;
                color: #fff;
            }

            .flatpickr-day.selected {
                background: #10b981 !important;
                border-color: #10b981 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr(".flatpickr", {
                dateFormat: "d-m-Y",
                locale: "es",
                disableMobile: "true"
            });
        </script>
    @endpush
</x-app-layout>
