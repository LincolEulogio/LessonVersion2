<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight text-center">Editar Asignación
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-center font-medium">Modifica los detalles de la tarea
                asignada.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-2xl rounded-[2.5rem] border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('assignment.update', $assignment->assignmentID) }}" method="POST"
                enctype="multipart/form-data" class="p-10 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Título
                            de la Tarea</label>
                        <input type="text" name="title" value="{{ old('title', $assignment->title) }}" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500 transition-all py-3 px-4"
                            placeholder="Ej: Ensayo sobre la Revolución Industrial">
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Fecha
                            Límite</label>
                        <input type="date" name="deadlinedate"
                            value="{{ old('deadlinedate', \Carbon\Carbon::parse($assignment->deadlinedate)->format('Y-m-d')) }}"
                            required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500 transition-all py-3 px-4">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Clase</label>
                        <select id="classesID" name="classesID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500 transition-all py-3 px-4">
                            <option value="">Seleccionar Clase</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $assignment->classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Materia</label>
                        <select id="subjectID" name="subjectID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500 transition-all py-3 px-4">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subjectID }}"
                                    {{ $assignment->subjectID == $subject->subjectID ? 'selected' : '' }}>
                                    {{ $subject->subject }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Instrucciones
                        Detalladas</label>
                    <textarea name="description" rows="5" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500 transition-all p-4"
                        placeholder="Escribe aquí todas las instrucciones para los estudiantes...">{{ old('description', $assignment->description) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] pl-1">Documento
                        Adjunto (Opcional)</label>
                    @if ($assignment->file)
                        <div
                            class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-700 mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="ti ti-file-description text-2xl text-sky-500"></i>
                                <div>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                        {{ $assignment->originalfile }}</p>
                                    <p class="text-xs text-slate-500">Archivo actual</p>
                                </div>
                            </div>
                            <a href="{{ route('assignment.download', $assignment->assignmentID) }}"
                                class="text-sky-500 hover:text-sky-600 font-bold text-xs uppercase tracking-widest">Descargar</a>
                        </div>
                    @endif
                    <div
                        class="relative group h-40 flex flex-col items-center justify-center border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-[2rem] hover:border-sky-500 hover:bg-sky-500/5 transition-all">
                        <input type="file" name="file" id="file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <i
                            class="ti ti-cloud-upload text-5xl text-slate-300 dark:text-slate-600 group-hover:text-sky-500 transition-colors"></i>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400 font-medium">Haz clic para reemplazar
                            el archivo</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Máximo 10MB</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('assignment.index') }}"
                        class="text-sm font-bold text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 uppercase tracking-widest transition-colors flex items-center gap-2">
                        <i class="ti ti-arrow-left text-lg"></i> Regresar
                    </a>
                    <button type="submit"
                        class="px-12 py-4 bg-sky-600 hover:bg-sky-500 text-white font-bold rounded-2xl shadow-xl shadow-sky-500/20 transition-all hover:scale-105 active:scale-95">
                        Actualizar Asignación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('classesID').addEventListener('change', function() {
            const classID = this.value;
            const subjectSelect = document.getElementById('subjectID');

            if (classID) {
                fetch(`/api/topic/subjects/${classID}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">Seleccionar Materia</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                    });
            } else {
                subjectSelect.innerHTML = '<option value="">Esperando clase...</option>';
                subjectSelect.disabled = true;
                subjectSelect.classList.add('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
</x-app-layout>
