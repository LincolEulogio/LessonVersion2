<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('schoolyear.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Agregar Año Académico</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Define un nuevo periodo escolar
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm relative overflow-hidden">
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl"></div>

            <form action="{{ route('schoolyear.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <x-form.label for="schoolyear" class="pl-1">Año Académico</x-form.label>
                        <x-form.input name="schoolyear" id="schoolyear" placeholder="Ej: 2024-2025" required />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="schoolyeartitle" class="pl-1">Título</x-form.label>
                        <x-form.input name="schoolyeartitle" id="schoolyeartitle" placeholder="Ej: Periodo Anual"
                            required />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="startingdate" class="pl-1">Fecha de Inicio</x-form.label>
                        <x-form.input type="date" name="startingdate" id="startingdate" required />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="endingdate" class="pl-1">Fecha de Finalización</x-form.label>
                        <x-form.input type="date" name="endingdate" id="endingdate" required />
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30 hover:scale-[1.02] active:scale-95">
                        Crear Año Académico
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
