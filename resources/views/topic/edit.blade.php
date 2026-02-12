<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Editar Tema</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Modifica la información del tema seleccionado.</p>
        </div>

        <div
            class="bg-white dark:bg-slate-800 shadow-xl rounded-3xl border border-slate-200 dark:border-slate-700/50 overflow-hidden">
            <form action="{{ route('topic.update', $topic->topicID) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Clase</label>
                        <select id="classesID" name="classesID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all">
                            <option value="">Selecciona una clase</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $topic->classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                        @error('classesID')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Materia</label>
                        <select id="subjectID" name="subjectID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subjectID }}"
                                    {{ $topic->subjectID == $subject->subjectID ? 'selected' : '' }}>
                                    {{ $subject->subject }}</option>
                            @endforeach
                        </select>
                        @error('subjectID')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Título
                        del Tema</label>
                    <input type="text" name="title" value="{{ old('title', $topic->title) }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all"
                        placeholder="Ej: Álgebra Lineal">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest pl-1">Descripción</label>
                    <textarea name="description" rows="4"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all"
                        placeholder="Breve descripción del tema...">{{ old('description', $topic->description) }}</textarea>
                </div>

                <div
                    class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('topic.index') }}"
                        class="px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        Actualizar Tema
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
                        subjectSelect.innerHTML = '<option value="">Selecciona una materia</option>';
                        data.forEach(subject => {
                            subjectSelect.innerHTML +=
                                `<option value="${subject.subjectID}">${subject.subject}</option>`;
                        });
                        subjectSelect.disabled = false;
                        subjectSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                    });
            } else {
                subjectSelect.innerHTML = '<option value="">Primero selecciona una clase</option>';
                subjectSelect.disabled = true;
                subjectSelect.classList.add('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
</x-app-layout>
