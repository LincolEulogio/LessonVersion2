<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
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
                <a href="{{ route('markpercentage.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Porcentajes') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Nuevo') }}</span>
            </nav>

            <div class="space-y-4">
                <h1
                    class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                    {{ __('Crear Tipo de') }} <span class="text-emerald-500 relative inline-block">
                        {{ __('Evaluación') }}
                        <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                    </span>
                </h1>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] p-10 shadow-sm">
            <form action="{{ route('markpercentage.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="space-y-4">
                    <label for="markpercentage"
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                        {{ __('Nombre del Tipo') }}
                    </label>
                    <div class="relative">
                        <i class="ti ti-tag absolute left-5 top-1/2 -translate-y-1/2 text-emerald-500 z-10 text-xl"></i>
                        <input type="text" name="markpercentage" id="markpercentage"
                            value="{{ old('markpercentage') }}" placeholder="Ej: Examen Final, Deberes..."
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                    </div>
                    @error('markpercentage')
                        <p class="text-[10px] text-rose-500 font-bold uppercase tracking-widest ml-1">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="markpercentage_numeric"
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                        {{ __('Valor Porcentual (%)') }}
                    </label>
                    <div class="relative">
                        <i
                            class="ti ti-percentage absolute left-5 top-1/2 -translate-y-1/2 text-emerald-500 z-10 text-xl"></i>
                        <input type="number" name="markpercentage_numeric" id="markpercentage_numeric"
                            value="{{ old('markpercentage_numeric') }}" placeholder="0 - 100"
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none">
                    </div>
                    @error('markpercentage_numeric')
                        <p class="text-[10px] text-rose-500 font-bold uppercase tracking-widest ml-1">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center gap-4">
                    <button type="submit"
                        class="px-10 py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] shadow-2xl shadow-emerald-500/30 font-black text-[10px] uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-3">
                        <i class="ti ti-device-floppy text-xl"></i>
                        {{ __('Guardar Registro') }}
                    </button>
                    <a href="{{ route('markpercentage.index') }}"
                        class="px-10 py-5 bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 rounded-[2rem] font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-800 transition-all">
                        {{ __('Cancelar') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
