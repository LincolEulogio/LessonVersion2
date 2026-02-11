<x-app-layout>
    <div class="min-h-screen bg-[#0f172a] text-white font-sans selection:bg-blue-500/30">
        <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">

            <!-- Header Section -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                        👥 Miembros de Biblioteca
                    </h1>
                    <p class="mt-2 text-slate-400">Gestiona los estudiantes registrados en la biblioteca.</p>
                </div>

                <!-- Filter by Class -->
                <form action="{{ route('lmember.index') }}" method="GET" class="flex items-center gap-3">
                    <select name="classID" onchange="this.form.submit()"
                        class="bg-slate-800/50 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Students List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($students as $student)
                    <div
                        class="p-6 rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm hover:border-blue-500/30 transition-all duration-300 group">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-700 flex-shrink-0 border-2 border-slate-600/50">
                                @if ($student->photo)
                                    <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-500 font-bold text-xl uppercase">
                                        {{ substr($student->name, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3
                                    class="font-bold text-slate-200 truncate group-hover:text-blue-400 transition-colors">
                                    {{ $student->name }}</h3>
                                <p class="text-slate-500 text-sm">ID: {{ $student->studentID }}</p>
                                <p class="text-slate-400 text-xs mt-1">Roll: {{ $student->roll }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <i class="ti ti-mail text-slate-500"></i>
                                <span class="truncate">{{ $student->email ?? 'Sin correo' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <i class="ti ti-phone text-slate-500"></i>
                                <span>{{ $student->phone ?? 'Sin teléfono' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                            @if (in_array($student->studentID, $members))
                                <span
                                    class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs border border-emerald-500/20 font-medium flex items-center gap-1">
                                    <i class="ti ti-check text-sm"></i> Miembro Activo
                                </span>
                                <form action="{{ route('lmember.destroy', $student->studentID) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-400 hover:text-red-300 text-sm font-bold transition-colors">
                                        Remover
                                    </button>
                                </form>
                            @else
                                <button onclick="openModal('{{ $student->studentID }}', '{{ $student->name }}')"
                                    class="w-full py-2.5 rounded-xl bg-blue-600/20 hover:bg-blue-600 text-blue-400 hover:text-white border border-blue-600/30 hover:border-blue-600 font-bold transition-all text-sm">
                                    Registrar Miembro
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal"
        class="hidden fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-[#0f172a] border border-slate-700 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6 border-b border-slate-700 flex justify-between items-center">
                <h3 class="text-xl font-bold">Registrar en Biblioteca</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ti ti-x text-2xl"></i>
                </button>
            </div>
            <form action="{{ route('lmember.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="studentID" id="modal_studentID">

                <div class="mb-4">
                    <p class="text-sm text-slate-400 mb-1">Estudiante seleccionando:</p>
                    <p class="text-lg font-bold text-blue-400" id="modal_studentName"></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">ID de Biblioteca (Carnet)</label>
                    <input type="text" name="lID" required
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-200 outline-none"
                        placeholder="Ej: LIB-2026-001">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Saldo Inicial ($)</label>
                    <input type="number" name="lbalance" value="0" step="0.01"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all text-slate-200 outline-none">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold transition-all shadow-lg shadow-blue-500/20">
                        Confirmar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, name) {
            document.getElementById('modal_studentID').value = id;
            document.getElementById('modal_studentName').innerText = name;
            document.getElementById('registerModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('registerModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
