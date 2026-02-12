<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter">Programar Nuevo Examen</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Asigna fecha, hora y aula para las
                evaluaciones académicas.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] rounded-[3rem] border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('examschedule.store') }}" method="POST" class="p-12 space-y-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Examen
                            (Periodo)</label>
                        <select name="examID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all">
                            <option value="">Seleccionar Examen</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->examID }}">{{ $exam->exam }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Clase</label>
                        <select id="classesID" name="classesID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all">
                            <option value="">Seleccionar Clase</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}">{{ $class->classes }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-slate-100 dark:border-slate-700/30">
                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Sección</label>
                        <select id="sectionID" name="sectionID" required disabled
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all opacity-50">
                            <option value="">Esperando clase...</option>
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Materia</label>
                        <select id="subjectID" name="subjectID" required disabled
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all opacity-50">
                            <option value="">Esperando clase...</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="space-y-3 md:col-span-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Fecha
                            del Examen</label>
                        <input type="date" name="edate" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all">
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Hora
                            Inicio</label>
                        <input type="time" name="examfrom" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all">
                    </div>

                    <div class="space-y-3">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Hora
                            Fin</label>
                        <input type="time" name="examto" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all">
                    </div>
                </div>

                <div class="space-y-3">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Aula
                        / Salón</label>
                    <input type="text" name="room" maxlength="255"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-rose-500/10 py-4 px-5 font-bold transition-all"
                        placeholder="Ej: Pabellón B - Aula 302">
                </div>

                <div class="flex items-center justify-between pt-10 border-t border-slate-100 dark:border-slate-700/30">
                    <a href="{{ route('examschedule.index') }}"
                        class="px-8 py-4 text-xs font-black text-slate-400 hover:text-slate-900 dark:hover:text-white uppercase tracking-[0.2em] transition-all flex items-center gap-2">
                        <i class="ti ti-chevron-left text-lg"></i> Cancelar
                    </a>
                    <button type="submit"
                        class="px-16 py-5 bg-rose-600 hover:bg-rose-500 text-white font-black rounded-3xl shadow-[0_20px_40px_-10px_rgba(225,29,72,0.3)] transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Confirmar Horario
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('classesID').addEventListener('change', function() {
            const classID = this.value;
            const sectionSelect = document.getElementById('sectionID');
            const subjectSelect = document.getElementById('subjectID');

            if (classID) {
                // Fetch Sections
                fetch(`/api/sections/${classID}/json`)
                    .then(response => response.json())
                    .then(data => {
                        sectionSelect.innerHTML = '<option value="">Seleccionar Sección</option>';
                        data.forEach(section => {
                            sectionSelect.innerHTML +=
                                `<option value="${section.sectionID}">${section.section}</option>`;
                        });
                        sectionSelect.disabled = false;
                        sectionSelect.classList.remove('opacity-50');
                    });

                // Fetch Subjects
                fetch(`/api/topic/subjects/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">Seleccionar Materia</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('opacity-50');
                    });
            } else {
                [sectionSelect, subjectSelect].forEach(select => {
                    select.innerHTML = '<option value="">Esperando clase...</option>';
                    select.disabled = true;
                    select.classList.add('opacity-50');
                });
            }
        });
    </script>
</x-app-layout>
