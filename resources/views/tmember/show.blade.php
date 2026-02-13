<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20 shadow-sm">
                    <i class="ti ti-id text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                        Detalle de Membresía
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ficha de transporte del
                        estudiante</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('tmember.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Volver
                </a>
                <a href="{{ route('tmember.edit', $tmember->tmemberID) }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-amber-600 text-white font-black text-xs uppercase tracking-widest hover:bg-amber-500 transition-all shadow-lg shadow-amber-600/20">
                    <i class="ti ti-edit text-lg"></i>
                    Editar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Student Profile Card -->
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-32 h-32 rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-900 border-4 border-white dark:border-slate-800 shadow-xl mb-6">
                        @if ($tmember->student->photo)
                            <img src="{{ asset('uploads/images/' . $tmember->student->photo) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center text-slate-300 font-black text-4xl uppercase">
                                {{ substr($tmember->student->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight capitalize">
                        {{ $tmember->student->name }}</h2>
                    <p class="text-xs font-bold text-yellow-600 dark:text-yellow-400 uppercase tracking-widest mt-1">
                        Estudiante en Transporte</p>

                    <div class="mt-8 w-full grid grid-cols-2 gap-4">
                        <div
                            class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Grado</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ $tmember->student->classes->classes ?? '-' }}</p>
                        </div>
                        <div
                            class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Roll</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                #{{ $tmember->student->roll }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transport Details -->
            <div class="space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight mb-8 flex items-center gap-3">
                        <i class="ti ti-route text-yellow-500"></i> Información de Ruta
                    </h4>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 flex items-center justify-center border border-yellow-100 dark:border-yellow-500/20 shadow-sm">
                                <i class="ti ti-map-2 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ruta Asignada
                                </p>
                                <p class="text-lg font-black text-slate-800 dark:text-white capitalize">
                                    {{ $tmember->transport->route }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/10 text-orange-600 flex items-center justify-center border border-orange-100 dark:border-orange-500/20 shadow-sm">
                                <i class="ti ti-tir text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Vehículo /
                                    Placa</p>
                                <p class="text-lg font-black text-slate-800 dark:text-white">
                                    {{ $tmember->transport->vehicle }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tarifa
                                    Mensual</p>
                                <p class="text-xl font-black text-emerald-600">
                                    ${{ number_format($tmember->tbalance, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Fecha Ingreso
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                    {{ \Carbon\Carbon::parse($tmember->tjoindate)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Banner -->
                <div
                    class="p-8 rounded-3xl bg-amber-600 dark:bg-amber-500 shadow-xl shadow-amber-900/20 flex items-center justify-between text-white overflow-hidden relative group">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/80 mb-1">Estado del
                            Servicio</p>
                        <h4 class="text-2xl font-black italic text-white drop-shadow-sm">Membresía Activa</h4>
                    </div>
                    <div
                        class="relative z-10 w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 shadow-inner">
                        <i class="ti ti-circle-check text-3xl text-white animate-pulse"></i>
                    </div>

                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-white/20 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
