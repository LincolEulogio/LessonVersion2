<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-yellow-500/10 flex items-center justify-center text-yellow-600 dark:text-yellow-400 border border-slate-200 dark:border-yellow-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-map-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nueva Ruta
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Ingresar datos de transporte
                        escolar</p>
                </div>
            </div>

            <a href="{{ route('transport.index') }}"
                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                <i class="ti ti-arrow-left text-lg"></i>
                Cancelar
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
            <form action="{{ route('transport.store') }}" method="POST" class="p-8 md:p-12 space-y-10" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <!-- Route -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Nombre
                            de la Ruta / Destino</label>
                        <input type="text" name="route" value="{{ old('route') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold text-lg"
                            placeholder="Ej: Ruta Norte - Los Olivos">
                        @error('route')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Vehicle -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Identificador
                            del Vehículo (Placa/Modelo)</label>
                        <input type="text" name="vehicle" value="{{ old('vehicle') }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Ej: Bus Toyota ABC-123">
                        @error('vehicle')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Cost -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Costo
                            Mensual ($)</label>
                        <input type="number" name="cost" value="{{ old('cost') }}" step="0.01"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="0.00">
                        @error('cost')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Notas
                            / Observaciones</label>
                        <textarea name="note" rows="3"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                            placeholder="Detalles adicionales sobre paradas o chofer...">{{ old('note') }}</textarea>
                        @error('note')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-5 rounded-2xl bg-yellow-600 hover:bg-yellow-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-yellow-600/30 hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-3">
                        <i class="ti ti-device-floppy text-lg"></i>
                        Guardar Ruta
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
