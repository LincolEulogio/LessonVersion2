<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-slate-200 dark:border-amber-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nueva Categoría
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Configura un nuevo tipo de
                        habitación y su tarifa</p>
                </div>
            </div>
            <a href="{{ route('category.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-amber-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-500/5 dark:bg-amber-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('category.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Hostel Selection -->
                    <div class="space-y-2">
                        <label for="hostelID"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Hostal</label>
                        <select name="hostelID" id="hostelID" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold cursor-pointer">
                            <option value="">Seleccione un hostal...</option>
                            @foreach ($hostels as $hostel)
                                <option value="{{ $hostel->hostelID }}"
                                    {{ old('hostelID') == $hostel->hostelID ? 'selected' : '' }}>
                                    {{ $hostel->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hostelID')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Room Type -->
                    <div class="space-y-2">
                        <label for="class_type"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Tipo
                            de Habitación</label>
                        <input type="text" name="class_type" id="class_type" value="{{ old('class_type') }}" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                            placeholder="Ej: Individual Premium">
                        @error('class_type')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cost -->
                    <div class="space-y-2">
                        <label for="hbalance"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Costo
                            Mensual ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" step="0.01" name="hbalance" id="hbalance"
                                value="{{ old('hbalance') }}" required
                                class="w-full pl-8 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                                placeholder="0.00">
                        </div>
                        @error('hbalance')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Note -->
                <div class="space-y-2">
                    <label for="note"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Notas
                        / Características</label>
                    <textarea name="note" id="note" rows="4"
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none"
                        placeholder="Ej: Aire acondicionado, baño privado, internet..."></textarea>
                    @error('note')
                        <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('category.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-amber-600 hover:bg-amber-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-amber-600/30 hover:shadow-amber-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-device-floppy text-xl"></i>
                        Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
