<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('studentgroup.index') }}"
                    class="hover:text-amber-400 text-slate-400 transition-colors uppercase tracking-widest font-bold text-[10px]">Grupos</a>
                <i class="ti ti-chevron-right text-xs"></i>
                <span class="text-amber-400 uppercase tracking-widest font-bold text-[10px]">Editar Grupo</span>
            </nav>
            <h1 class="text-3xl font-bold text-white tracking-tight">Modificar Grupo</h1>
            <p class="text-slate-400 mt-1">Actualiza el nombre de la categoría para reflejar cambios organizativos.</p>
        </div>

        <!-- Form Card -->
        <div class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl">
            <form action="{{ route('studentgroup.update', $group->studentgroupID) }}" method="POST"
                class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="group"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nombre del
                        Grupo</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-400 transition-colors">
                            <i class="ti ti-users-group"></i>
                        </div>
                        <input type="text" name="group" id="group" value="{{ old('group', $group->group) }}"
                            required
                            class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-slate-700/50 rounded-2xl text-slate-200 placeholder-slate-600 focus:border-amber-500/50 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none"
                            placeholder="Ej: Grupo A, Becados, etc.">
                    </div>
                    @error('group')
                        <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Actions -->
                <div
                    class="pt-6 border-t border-slate-700/50 flex items-center justify-end gap-3 uppercase font-bold tracking-widest text-[10px]">
                    <a href="{{ route('studentgroup.index') }}"
                        class="px-6 py-2.5 bg-slate-700/50 hover:bg-slate-700 text-slate-400 hover:text-white rounded-xl transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-7 py-2.5 bg-amber-600 hover:bg-amber-500 text-white rounded-xl transition-all shadow-lg shadow-amber-600/20 active:scale-95">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
