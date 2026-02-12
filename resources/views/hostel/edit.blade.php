<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-edit text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Editar Hostal
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Actualiza los detalles de la
                        infraestructura</p>
                </div>
            </div>
            <a href="{{ route('hostel.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/5 dark:bg-indigo-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('hostel.update', $hostel->hostelID) }}" method="POST" class="space-y-8 relative">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Hostel Name -->
                    <div class="space-y-2">
                        <label for="name"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Nombre
                            del Hostal / Residencia</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $hostel->name) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold">
                        @error('name')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="space-y-2">
                        <label for="address"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Dirección
                            Física</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold"><i
                                    class="ti ti-map-pin"></i></span>
                            <input type="text" name="address" id="address"
                                value="{{ old('address', $hostel->address) }}" required
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold">
                        </div>
                        @error('address')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div class="space-y-2">
                        <label for="note"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Notas
                            / Detalles Adicionales</label>
                        <textarea name="note" id="note" rows="4"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none">{{ old('note', $hostel->note) }}</textarea>
                        @error('note')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('hostel.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-refresh text-xl"></i>
                        Actualizar Hostal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
