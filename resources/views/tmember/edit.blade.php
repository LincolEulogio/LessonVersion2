<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20 shadow-sm">
                    <i class="ti ti-edit text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                        Editar Membresía
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Modificar asignación de
                        transporte para <strong>{{ $tmember->student->name }}</strong></p>
                </div>
            </div>

            <a href="{{ route('tmember.index') }}"
                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                <i class="ti ti-arrow-left text-lg"></i>
                Cancelar
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
            <form action="{{ route('tmember.update', $tmember->tmemberID) }}" method="POST"
                class="p-8 md:p-12 space-y-10" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <!-- Read-only Student Info -->
                    <div
                        class="md:col-span-2 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1 mb-1">Estudiante
                        </p>
                        <p class="text-lg font-black text-slate-800 dark:text-white">{{ $tmember->student->name }} (ID:
                            {{ $tmember->studentID }})</p>
                    </div>

                    <!-- Transport Selection -->
                    <div class="md:col-span-1 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Ruta
                            de Transporte</label>
                        <select name="transportID"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            @foreach ($transports as $transport)
                                <option value="{{ $transport->transportID }}"
                                    {{ old('transportID', $tmember->transportID) == $transport->transportID ? 'selected' : '' }}>
                                    {{ $transport->route }} (${{ number_format($transport->cost, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('transportID')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Balance -->
                    <div class="md:col-span-1 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Costo
                            Mensual ($)</label>
                        <input type="number" name="tbalance" value="{{ old('tbalance', $tmember->tbalance) }}"
                            step="0.01"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        @error('tbalance')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Join Date -->
                    <div class="md:col-span-2 space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Ingreso al Servicio</label>
                        <input type="date" name="tjoindate" value="{{ old('tjoindate', $tmember->tjoindate) }}"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-yellow-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        @error('tjoindate')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-5 rounded-2xl bg-yellow-600 hover:bg-yellow-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-yellow-600/30 hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-3">
                        <i class="ti ti-refresh text-lg"></i>
                        Actualizar Membresía
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
