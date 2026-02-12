<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-bus-stop text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Miembros de Transporte
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de rutas y asignación
                        de transporte para estudiantes</p>
                </div>
            </div>

            <!-- Class Filter -->
            <form action="{{ route('tmember.index') }}" method="GET"
                class="flex items-center gap-3 bg-white dark:bg-slate-800/30 p-2 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl">
                <select name="classID" onchange="this.form.submit()"
                    class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-slate-700 dark:text-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none cursor-pointer font-bold text-sm">
                    <option value="">Todos los grados</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->classesID }}" {{ $classID == $class->classesID ? 'selected' : '' }}>
                            {{ $class->classes }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400 animate-in fade-in slide-in-from-top-4 duration-500">
                <div
                    class="w-8 h-8 rounded-lg bg-white dark:bg-emerald-500/20 flex items-center justify-center shadow-sm">
                    <i class="ti ti-circle-check text-xl"></i>
                </div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Students Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($students as $student)
                <div
                    class="group bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm dark:shadow-none hover:border-blue-500/50 transition-all duration-300 relative overflow-hidden">
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all">
                    </div>

                    <div class="flex items-start gap-4 mb-6 relative">
                        <div
                            class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-50 dark:bg-slate-700 flex-shrink-0 border border-slate-100 dark:border-slate-600 shadow-inner group-hover:scale-105 transition-transform duration-500">
                            @if ($student->photo)
                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-500 font-black text-2xl uppercase">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3
                                class="font-black text-slate-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors text-lg">
                                {{ $student->name }}
                            </h3>
                            <p
                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                ID: {{ $student->studentID }} | Roll: {{ $student->roll }}</p>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                <span
                                    class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-600/50">
                                    {{ $student->classes->classes ?? 'S/G' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 relative">
                        @if ($student->transportMember)
                            <div
                                class="flex items-center gap-3 p-3 rounded-2xl bg-blue-50 dark:bg-blue-500/5 border border-blue-100 dark:border-blue-500/20 transition-colors group-hover:bg-white dark:group-hover:bg-slate-900">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-blue-500 shadow-sm border border-blue-100 dark:border-blue-500/20">
                                    <i class="ti ti-route text-xl"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-black text-blue-400 dark:text-blue-500 uppercase tracking-widest leading-none mb-1">
                                        Ruta Asignada</p>
                                    <p class="font-bold text-slate-700 dark:text-slate-200 text-sm tracking-tight">
                                        {{ $student->transportMember->transport->route }}</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-3 p-3 rounded-2xl bg-indigo-50 dark:bg-indigo-500/5 border border-indigo-100 dark:border-indigo-500/20 transition-colors group-hover:bg-white dark:group-hover:bg-slate-900">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-indigo-500 shadow-sm border border-indigo-100 dark:border-indigo-500/20">
                                    <i class="ti ti-car text-xl"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-black text-indigo-400 dark:text-indigo-500 uppercase tracking-widest leading-none mb-1">
                                        Vehículo | Costo</p>
                                    <p class="font-bold text-slate-700 dark:text-slate-200 text-sm tracking-tight">
                                        {{ $student->transportMember->transport->vehicle }}
                                        (${{ $student->transportMember->tbalance }})
                                    </p>
                                </div>
                            </div>
                        @else
                            <div
                                class="flex items-center justify-center p-6 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-2xl">
                                <p class="text-xs font-bold text-slate-400 dark:text-slate-500 italic">Sin asignación de
                                    transporte</p>
                            </div>
                        @endif
                    </div>

                    <div
                        class="flex items-center justify-between relative border-t border-slate-100 dark:border-slate-700/50 pt-4">
                        @if ($student->transportMember)
                            <div class="flex flex-col">
                                <span
                                    class="text-[9px] font-black text-blue-400 dark:text-blue-500 uppercase tracking-widest">Registrado
                                    desde</span>
                                <span
                                    class="text-[11px] font-bold text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($student->transportMember->tjoindate)->format('d M, Y') }}</span>
                            </div>
                            <form action="{{ route('tmember.destroy', $student->transportMember->tmemberID) }}"
                                method="POST"
                                onsubmit="return confirm('¿Retirar al estudiante de la ruta de transporte?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="h-10 px-4 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 text-[10px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 dark:hover:text-white transition-all">
                                    Retirar
                                </button>
                            </form>
                        @else
                            <button onclick="openModal({{ $student->studentID }}, '{{ $student->name }}')"
                                class="w-full h-11 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2">
                                <i class="ti ti-plus text-base"></i> Registrar Transporte
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div
                        class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                        <i class="ti ti-users text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No se encontraron estudiantes</h3>
                    <p class="text-slate-400 dark:text-slate-500 mt-2">Prueba seleccionando otro grado o verifica la
                        base de datos.</p>
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
                    <i class="ti ti-bus text-blue-500"></i> Asignar Transporte
                </h3>
                <button onclick="closeModal()"
                    class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors flex items-center justify-center">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>
            <form action="{{ route('tmember.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="studentID" id="modal_studentID">

                <div
                    class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20">
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Estudiante</p>
                    <p class="text-lg font-black text-blue-700 dark:text-blue-300" id="modal_studentName"></p>
                </div>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                            Ruta / Transporte</label>
                        <select name="transportID" id="modal_transportID" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                            <option value="">Seleccione una ruta...</option>
                            @foreach ($transports as $t)
                                <option value="{{ $t->transportID }}">{{ $t->route }} ({{ $t->vehicle }}) -
                                    ${{ $t->cost }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-[1.02] active:scale-95">
                        Confirmar Asignación
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
            document.getElementById('registerModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('registerModal').classList.add('hidden');
            document.getElementById('registerModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-app-layout>
