<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-yellow-500/10 flex items-center justify-center text-yellow-600 dark:text-yellow-400 border border-slate-200 dark:border-yellow-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-info-circle text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight text-capitalize">
                        {{ $transport->route }}
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ficha detallada de la ruta de
                        transporte</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('transport.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Volver
                </a>
                <a href="{{ route('transport.edit', $transport->transportID) }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-amber-600 text-white font-black text-xs uppercase tracking-widest hover:bg-amber-500 transition-all shadow-lg shadow-amber-600/20">
                    <i class="ti ti-edit text-lg"></i>
                    Editar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Summary Card -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 text-center shadow-sm relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-yellow-500/5 rounded-full blur-3xl"></div>

                    <div class="relative inline-block mb-6">
                        <div
                            class="w-32 h-32 rounded-3xl bg-gradient-to-br from-yellow-500 to-orange-600 shadow-2xl flex items-center justify-center text-white">
                            <i class="ti ti-bus text-6xl"></i>
                        </div>
                    </div>

                    <h3 class="text-2xl font-black text-slate-900 dark:text-white leading-tight mb-2 capitalize">
                        {{ $transport->route }}</h3>
                    <p
                        class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">
                        Ruta Escolar Activa</p>

                    <div class="space-y-4">
                        <div class="flex flex-col gap-1 items-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Costo Mensual</p>
                            <p class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">
                                ${{ number_format($transport->cost, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Context -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Detalles del
                        Vehículo</h4>

                    <div
                        class="flex items-center gap-5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30">
                        <div
                            class="w-12 h-12 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-yellow-600 shadow-sm">
                            <i class="ti ti-steering-wheel text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Identificación
                            </p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $transport->vehicle }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Info -->
            <div class="lg:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight mb-8 flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-yellow-500/10 text-yellow-500 flex items-center justify-center">
                            <i class="ti ti-list-details"></i>
                        </span>
                        Especificaciones de la Ruta
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Nombre de Ruta</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight uppercase">
                                {{ $transport->route }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Tipo de Vehículo</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white tracking-tight">
                                {{ $transport->vehicle }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Fecha de Creación</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ \Carbon\Carbon::parse($transport->create_date)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Última Modificación</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ \Carbon\Carbon::parse($transport->modify_date)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if ($transport->note)
                        <div class="mt-10 pt-8 border-t border-slate-100 dark:border-slate-700/50">
                            <p
                                class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3">
                                Observaciones Adicionales</p>
                            <div
                                class="p-6 rounded-2xl bg-yellow-50/50 dark:bg-yellow-500/5 border border-yellow-100 dark:border-yellow-500/10">
                                <p
                                    class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-medium italic">
                                    "{{ $transport->note }}"
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Members Placeholder -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm">
                    <h4
                        class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight mb-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="ti ti-users text-slate-400"></i>
                            Estudiantes en esta Ruta
                        </div>
                        <span
                            class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 text-[10px] font-black text-slate-500">Módulo
                            Transport Member</span>
                    </h4>

                    <div
                        class="p-8 rounded-2xl border-2 border-dashed border-slate-100 dark:border-slate-700 flex flex-col items-center text-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-300 dark:text-slate-700 border border-slate-100 dark:border-slate-700">
                            <i class="ti ti-link-off text-2xl"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Para
                            ver los estudiantes, diríjase al módulo "Miembros de Transporte"</p>
                        <a href="{{ route('tmember.index') }}"
                            class="mt-2 text-[10px] font-black text-yellow-600 dark:text-yellow-400 uppercase tracking-widest hover:underline">Ir
                            a Miembros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
