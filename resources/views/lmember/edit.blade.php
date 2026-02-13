<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-slate-200 dark:border-amber-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-edit text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Editar Membresía
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Actualizar información de la
                        biblioteca</p>
                </div>
            </div>

            <a href="{{ route('lmember.index') }}"
                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                <i class="ti ti-arrow-left text-lg"></i>
                Listado
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 flex items-center justify-center shadow-inner overflow-hidden">
                        @if ($lmember->student?->photo)
                            <img src="{{ asset('uploads/images/' . $lmember->student->photo) }}"
                                class="w-full h-full object-cover">
                        @else
                            <span
                                class="text-2xl font-black text-slate-300 uppercase">{{ substr($lmember->name, 0, 2) }}</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white">{{ $lmember->name }}</h3>
                        <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest">Estudiante
                            #{{ $lmember->studentID }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('lmember.update', $lmember->lmemberID) }}" method="POST" class="p-8 space-y-8"
                novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Library ID -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">ID
                            de Biblioteca (Carnet)</label>
                        <div class="relative group">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="ti ti-id"></i>
                            </span>
                            <input type="text" name="lmembercardID"
                                value="{{ old('lmembercardID', $lmember->lmembercardID) }}"
                                class="w-full pl-11 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                                placeholder="Ej: LIB-1001">
                        </div>
                        @error('lmembercardID')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Balance -->
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Saldo
                            ($)</label>
                        <div class="relative group">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors font-bold">$</span>
                            <input type="number" name="lbalance" value="{{ old('lbalance', $lmember->lbalance) }}"
                                step="0.01"
                                class="w-full pl-11 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        </div>
                        @error('lbalance')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30 hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-2">
                        <i class="ti ti-device-floppy text-lg"></i>
                        Guardar Cambios
                    </button>
                    <a href="{{ route('lmember.index') }}"
                        class="block w-full text-center mt-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">
                        Cancelar y Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
