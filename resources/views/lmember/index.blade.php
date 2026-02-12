<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-users-group text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Miembros de Biblioteca
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de registros y
                        membresías escolares</p>
                </div>
            </div>

            <!-- Filter by Class -->
            <div
                class="flex items-center gap-3 bg-white dark:bg-slate-800/30 p-2 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl">
                <span
                    class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-3">Filtrar
                    Grado</span>
                <form action="{{ route('lmember.index') }}" method="GET">
                    <select name="classID" onchange="this.form.submit()"
                        class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2 text-slate-700 dark:text-slate-200 focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none cursor-pointer font-bold text-sm">
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <!-- Students List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
            @forelse ($students as $student)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm dark:shadow-none hover:border-blue-500/50 transition-all duration-300 relative overflow-hidden">
                    <!-- Subtle Accent Blur -->
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all">
                    </div>

                    <div class="relative">
                        <div class="flex items-center gap-5 mb-6">
                            <div
                                class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-50 dark:bg-slate-700 flex-shrink-0 border border-slate-100 dark:border-slate-600 shadow-inner group-hover:scale-105 transition-transform duration-500">
                                @if ($student->photo)
                                    <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-500 font-black text-2xl uppercase">
                                        {{ substr($student->name, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20">
                                        Roll #{{ $student->roll }}
                                    </span>
                                </div>
                                <h3
                                    class="font-black text-slate-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors text-lg">
                                    {{ $student->name }}
                                </h3>
                                <p
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                    ID Estudiante: {{ $student->studentID }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div
                                class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 transition-colors group-hover:bg-white dark:group-hover:bg-slate-900">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 shadow-sm">
                                    <i class="ti ti-mail"></i>
                                </div>
                                <span
                                    class="text-sm font-medium text-slate-600 dark:text-slate-300 truncate">{{ $student->email ?? 'no-email@servidor.com' }}</span>
                            </div>
                            <div
                                class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/30 transition-colors group-hover:bg-white dark:group-hover:bg-slate-900">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 shadow-sm">
                                    <i class="ti ti-phone"></i>
                                </div>
                                <span
                                    class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $student->phone ?? 'Sin teléfono' }}</span>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-700/50">
                            @if (in_array($student->studentID, $members))
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest flex items-center gap-1.5 mb-1">
                                        <i class="ti ti-shield-check text-sm"></i> Miembro Activo
                                    </span>
                                    <div class="h-1.5 w-16 bg-emerald-500/20 rounded-full overflow-hidden">
                                        <div class="h-full w-full bg-emerald-500"></div>
                                    </div>
                                </div>
                                <form action="{{ route('lmember.destroy', $student->studentID) }}" method="POST"
                                    class="inline" onsubmit="return confirm('¿Remover membresía de biblioteca?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="h-10 px-4 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 text-xs font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white dark:hover:bg-rose-50 dark:hover:text-white transition-all">
                                        Remover
                                    </button>
                                </form>
                            @else
                                <button onclick="openModal('{{ $student->studentID }}', '{{ $student->name }}')"
                                    class="w-full py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
                                    <i class="ti ti-user-plus text-base"></i>
                                    Registrar Miembro
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full py-20 bg-white dark:bg-slate-800/20 border-4 border-dashed border-slate-100 dark:border-slate-800/50 rounded-3xl text-center">
                    <div
                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                        <i class="ti ti-search text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay estudiantes</h3>
                    <p class="text-slate-400 dark:text-slate-500 mt-2">No se encontraron estudiantes en este grado.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal"
        class="hidden fixed inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div
            class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform transition-all">
            <div
                class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h3
                    class="font-black text-slate-900 dark:text-white flex items-center gap-2 uppercase tracking-tight text-sm">
                    <i class="ti ti-address-book text-blue-500"></i> Registrar en Biblioteca
                </h3>
                <button onclick="closeModal()"
                    class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors flex items-center justify-center">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>
            <form action="{{ route('lmember.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="studentID" id="modal_studentID">

                <div
                    class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20">
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Estudiante
                        seleccionado</p>
                    <p class="text-lg font-black text-blue-700 dark:text-blue-300" id="modal_studentName"></p>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">ID
                        de Biblioteca (Carnet)</label>
                    <input type="text" name="lID" required
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none placeholder-slate-400 dark:placeholder-slate-600 font-bold"
                        placeholder="Ej: LIB-2026-001">
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Saldo
                        Inicial ($)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                        <input type="number" name="lbalance" value="0" step="0.01"
                            class="w-full pl-8 pr-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-[1.02] active:scale-95">
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
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('registerModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-app-layout>
