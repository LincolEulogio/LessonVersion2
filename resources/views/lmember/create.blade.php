<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-user-plus text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Registrar Nuevo Miembro
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Busca y selecciona un
                        estudiante para la biblioteca</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('lmember.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black text-xs uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200 dark:border-slate-700">
                    <i class="ti ti-arrow-left text-lg"></i>
                    Volver al Listado
                </a>
            </div>
        </div>

        <!-- Filter and Search -->
        <div
            class="mb-8 p-6 bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl shadow-sm">
            <form action="{{ route('lmember.create') }}" method="GET"
                class="flex flex-col md:flex-row items-end gap-6">
                <div class="flex-1 w-full space-y-2">
                    <label
                        class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Filtrar
                        por Grado</label>
                    <select name="classID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-3 text-slate-700 dark:text-slate-200 focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none cursor-pointer font-bold">
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Students Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($students as $student)
                @php $isMember = in_array($student->studentID, $existingMembers); @endphp
                <div
                    class="group bg-white dark:bg-slate-800/30 border {{ $isMember ? 'border-emerald-500/30 bg-emerald-500/5' : 'border-slate-200 dark:border-slate-700/50' }} backdrop-blur-xl rounded-2xl p-6 transition-all duration-300 relative overflow-hidden">

                    <div class="flex items-center gap-5 mb-6">
                        <div
                            class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-700 flex-shrink-0 border border-slate-100 dark:border-slate-600">
                            @if ($student->photo)
                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-500 font-black text-xl uppercase">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-black text-slate-900 dark:text-white truncate text-base leading-tight">
                                {{ $student->name }}
                            </h3>
                            <p
                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1">
                                Roll #{{ $student->roll }} | ID: {{ $student->studentID }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3 text-xs font-medium text-slate-600 dark:text-slate-400">
                            <i class="ti ti-mail text-blue-500"></i>
                            <span class="truncate">{{ $student->email ?? 'No disponible' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs font-medium text-slate-600 dark:text-slate-400">
                            <i class="ti ti-phone text-blue-500"></i>
                            <span>{{ $student->phone ?? 'Sin teléfono' }}</span>
                        </div>
                    </div>

                    @if ($isMember)
                        <div
                            class="w-full py-3 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest text-center border border-emerald-500/20">
                            <i class="ti ti-check mr-1"></i> Ya es Miembro
                        </div>
                    @else
                        <button onclick="openModal('{{ $student->studentID }}', '{{ $student->name }}')"
                            class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-black text-[10px] uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
                            <i class="ti ti-user-plus text-base"></i>
                            Seleccionar
                        </button>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400 font-bold">No se encontraron estudiantes en este grado.
                    </p>
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
                    <i class="ti ti-address-book text-blue-500"></i> Datos de Membresía
                </h3>
                <button onclick="closeModal()"
                    class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:text-rose-500 transition-colors flex items-center justify-center">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>
            <form action="{{ route('lmember.store') }}" method="POST" class="p-8 space-y-6" novalidate>
                @csrf
                <input type="hidden" name="studentID" id="modal_studentID" value="{{ old('studentID') }}">

                <div
                    class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20">
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Estudiante</p>
                    <p class="text-lg font-black text-blue-700 dark:text-blue-300" id="modal_studentName">
                        {{ old('studentName', 'Seleccione un estudiante') }}
                    </p>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">ID
                        de Biblioteca (Carnet)</label>
                    <input type="text" name="lmembercardID" value="{{ old('lmembercardID') }}"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                        placeholder="Ej: LIB-1001">
                    @error('lmembercardID')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Saldo
                        Inicial ($)</label>
                    <input type="number" name="lbalance" value="{{ old('lbalance', 0) }}" step="0.01"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-blue-500 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                    @error('lbalance')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30">
                        Finalizar Registro
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openModal(id, name) {
                document.getElementById('modal_studentID').value = id;
                document.getElementById('modal_studentName').innerText = name;
                document.getElementById('registerModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                // Store name for old() handling if needed (though hidden input is better)
                // But for display persistent after validation error:
                let hiddenName = document.createElement('input');
                hiddenName.type = 'hidden';
                hiddenName.name = 'studentName';
                hiddenName.value = name;
                document.querySelector('#registerModal form').appendChild(hiddenName);
            }

            function closeModal() {
                document.getElementById('registerModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            @if ($errors->any())
                document.getElementById('registerModal').classList.remove('hidden');
            @endif
        </script>
    @endpush
</x-app-layout>
