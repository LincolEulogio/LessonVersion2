<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-sky-500/10 flex items-center justify-center text-sky-600 dark:text-sky-400 border border-slate-200 dark:border-sky-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Registrar Vacaciones
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Define un periodo de asueto o
                        suspensión de clases</p>
                </div>
            </div>
            <a href="{{ route('holiday.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-sky-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-sky-500/5 dark:bg-sky-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('holiday.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8 relative">
                @csrf

                <!-- Title -->
                <div class="space-y-2">
                    <label for="title"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Motivo
                        / Nombre de la Vacación</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                        placeholder="Ej: Vacaciones de Primavera">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- From Date -->
                    <div class="space-y-2">
                        <label for="fdate"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Inicio</label>
                        <input type="date" name="fdate" id="fdate" value="{{ old('fdate', date('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>

                    <!-- To Date -->
                    <div class="space-y-2">
                        <label for="tdate"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Fin</label>
                        <input type="date" name="tdate" id="tdate" value="{{ old('tdate', date('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>
                </div>

                <!-- Photo (Optional for Holidays) -->
                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Imagen
                        Alusiva (Opcional)</label>
                    <div class="w-full relative group">
                        <label for="photo"
                            class="flex flex-col items-center justify-center w-full h-32 rounded-2xl bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-sky-500 dark:hover:border-sky-400 transition-all cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i
                                    class="ti ti-photo text-3xl text-slate-300 dark:text-slate-600 group-hover:text-sky-500"></i>
                                <p class="text-xs text-slate-400 mt-2 font-bold">Subir foto de portada</p>
                            </div>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-2">
                    <label for="details"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Detalles
                        / Notas Adicionales</label>
                    <textarea name="details" id="details" rows="6" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none"
                        placeholder="Describe el motivo de la suspensión o detalles de las vacaciones..."></textarea>
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('holiday.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-sky-600/30 hover:shadow-sky-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-palm text-xl"></i>
                        Confirmar Vacaciones
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
