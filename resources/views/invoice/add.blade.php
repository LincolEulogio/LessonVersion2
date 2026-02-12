<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Nueva Factura
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Genera cargos por cobrar para
                        estudiantes</p>
                </div>
            </div>
            <a href="{{ route('invoice.index') }}"
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

            <form action="{{ route('invoice.store') }}" method="POST" class="space-y-8 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Class Selection -->
                    <div class="space-y-2 text-indigo-600">
                        <label for="classesID"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Grado</label>
                        <select name="classesID" id="classesID" required onchange="fetchStudents(this.value)"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold cursor-pointer">
                            <option value="">Seleccione un grado...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ old('classesID') == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                        @error('classesID')
                            <p class="mt-1 text-xs font-bold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Student Selection -->
                    <div class="space-y-2">
                        <label for="studentID"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Estudiante(s)</label>
                        <select name="studentID" id="studentID" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold cursor-pointer">
                            <option value="">Primero seleccione un grado...</option>
                        </select>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tight pl-1">Se puede
                            seleccionar uno o aplicar a todo el grado</p>
                    </div>

                    <!-- Fee Type -->
                    <div class="space-y-2">
                        <label for="feetypesID"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Tipo
                            de Tarifa</label>
                        <select name="feetypesID" id="feetypesID" required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold cursor-pointer">
                            <option value="">Seleccione concepto...</option>
                            @foreach ($feetypes as $type)
                                <option value="{{ $type->feetypesID }}"
                                    {{ old('feetypesID') == $type->feetypesID ? 'selected' : '' }}>
                                    {{ $type->feetypes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="space-y-2">
                        <label for="date"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha
                            de Facturación</label>
                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>

                    <!-- Amount -->
                    <div class="space-y-2">
                        <label for="amount"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Monto
                            ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" step="0.01" name="amount" id="amount"
                                value="{{ old('amount') }}" required
                                class="w-full pl-8 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold placeholder-slate-400 dark:placeholder-slate-600"
                                placeholder="0.00">
                        </div>
                    </div>

                    <!-- Discount -->
                    <div class="space-y-2">
                        <label for="discount"
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Descuento
                            (%)</label>
                        <div class="relative">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">%</span>
                            <input type="number" step="0.01" name="discount" id="discount"
                                value="{{ old('discount', 0) }}"
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                                placeholder="0">
                        </div>
                    </div>
                </div>

                <div
                    class="pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-end gap-3">
                    <a href="{{ route('invoice.index') }}"
                        class="px-6 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 font-black text-xs uppercase tracking-widest transition-all">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                        <i class="ti ti-checklist text-xl"></i>
                        Generar Factura(s)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        async function fetchStudents(classID) {
            const select = document.getElementById('studentID');
            select.innerHTML = '<option value="">Cargando...</option>';

            if (!classID) {
                select.innerHTML = '<option value="">Primero seleccione un grado...</option>';
                return;
            }

            try {
                const response = await fetch(`/api/students/${classID}`);
                const students = await response.json();

                select.innerHTML = '<option value="all">--- TODOS LOS ESTUDIANTES ---</option>';
                students.forEach(s => {
                    const opt = document.createElement('option');
                    opt.value = s.studentID;
                    opt.text = `${s.name} (Roll: ${s.roll})`;
                    select.appendChild(opt);
                });
            } catch (error) {
                select.innerHTML = '<option value="">Error al cargar estudiantes</p>';
            }
        }
    </script>
</x-app-layout>
