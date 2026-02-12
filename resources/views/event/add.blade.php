<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Programar Evento
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Define los detalles de la
                        próxima actividad escolar</p>
                </div>
            </div>
            <a href="{{ route('event.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-blue-600 dark:hover:text-white transition-all shadow-sm dark:shadow-none flex items-center justify-center group"
                title="Volver">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-sm dark:shadow-none relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-3xl">
            </div>

            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8 relative">
                @csrf

                <!-- Title -->
                <div class="space-y-2">
                    <label for="title"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Nombre
                        del Evento</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                        placeholder="Ej: Graduación 2026">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- From Date & Time -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="fdate"
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                                de Inicio</label>
                            <input type="date" name="fdate" id="fdate"
                                value="{{ old('fdate', date('Y-m-d')) }}" required
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        </div>
                        <div class="space-y-2">
                            <label for="ftime"
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Hora
                                de Inicio</label>
                            <input type="time" name="ftime" id="ftime" value="{{ old('ftime', '08:00') }}"
                                required
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        </div>
                    </div>

                    <!-- To Date & Time -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="tdate"
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                                de Fin</label>
                            <input type="date" name="tdate" id="tdate"
                                value="{{ old('tdate', date('Y-m-d')) }}" required
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        </div>
                        <div class="space-y-2">
                            <label for="ttime"
                                class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Hora
                                de Fin</label>
                            <input type="time" name="ttime" id="ttime" value="{{ old('ttime', '14:00') }}"
                                required
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        </div>
                    </div>
                </div>

                <!-- Photo -->
                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Imagen
                        del Evento (Poster)</label>
                    <div class="w-full relative group">
                        <label for="photo"
                            class="flex flex-col items-center justify-center w-full h-40 rounded-2xl bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i
                                    class="ti ti-cloud-upload text-4xl text-slate-300 dark:text-slate-600 group-hover:text-blue-500 transition-colors"></i>
                                <p class="mb-2 text-sm text-slate-500 dark:text-slate-400 font-bold mt-2">Haz clic para
                                    subir imagen</p>
                                <p class="text-xs text-slate-400">PNG, JPG o GIF (Max. 2MB)</p>
                            </div>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-2">
                    <label for="details"
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Descripción
                        y Detalles</label>
                    <textarea name="details" id="details" rows="6" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold resize-none"
                        placeholder="Lugar del evento, vestimenta, requisitos..."></textarea>
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('event.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-calendar-event text-xl"></i>
                        Programar Actividad
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
