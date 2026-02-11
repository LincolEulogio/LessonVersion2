<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transport.index') }}"
                class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
                <i class="ti ti-arrow-left text-xl"></i>
            </a>
            <span class="bg-linear-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">
                {{ __('Agregar Transporte') }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl overflow-hidden backdrop-blur-sm">
            <form action="{{ route('transport.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="route" class="block text-sm font-bold text-slate-300">{{ __('Ruta') }}</label>
                        <input type="text" name="route" id="route" value="{{ old('route') }}" required
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all placeholder:text-slate-600"
                            placeholder="Ej: Ruta Norte - Sector A">
                        @error('route')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="vehicle"
                            class="block text-sm font-bold text-slate-300">{{ __('Vehículo') }}</label>
                        <input type="text" name="vehicle" id="vehicle" value="{{ old('vehicle') }}" required
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all placeholder:text-slate-600"
                            placeholder="Ej: Bus Escolar #12">
                        @error('vehicle')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="cost"
                            class="block text-sm font-bold text-slate-300">{{ __('Costo Mensual') }}</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold">$</span>
                            <input type="number" step="0.01" name="cost" id="cost"
                                value="{{ old('cost') }}" required
                                class="w-full bg-slate-900/50 border border-slate-700 rounded-xl pl-8 pr-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all"
                                placeholder="0.00">
                        </div>
                        @error('cost')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="note"
                        class="block text-sm font-bold text-slate-300">{{ __('Nota / Descripción') }}</label>
                    <textarea name="note" id="note" rows="4"
                        class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all placeholder:text-slate-600"
                        placeholder="Detalles adicionales sobre la ruta...">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-700/50">
                    <a href="{{ route('transport.index') }}"
                        class="px-6 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-all font-bold">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/20 transition-all font-bold">
                        {{ __('Guardar Transporte') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
