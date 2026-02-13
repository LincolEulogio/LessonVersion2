<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20 shadow-sm">
                    <i class="ti ti-users text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                        Miembros de Transporte
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de estudiantes
                        asignados a rutas escolares</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Class Filter -->
                <form action="{{ route('tmember.index') }}" method="GET" class="flex items-center gap-2">
                    <select name="classID" onchange="this.form.submit()"
                        class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-slate-700 dark:text-slate-200 focus:border-yellow-500 transition-all outline-none font-bold text-xs uppercase tracking-widest cursor-pointer shadow-sm">
                        <option value="">Todos los grados</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ route('tmember.create') }}"
                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-yellow-600 text-white font-black text-xs uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-600/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    Asignar Ruta
                </a>
            </div>
        </div>

        <!-- Members Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700/50">
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Estudiante</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Grado</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Ruta / Vehículo</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Costo Mensual</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Estado</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($students as $student)
                            @php $tmember = $student->transportMember; @endphp
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex-shrink-0">
                                            @if ($student->photo)
                                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-slate-400 font-black text-xs uppercase">
                                                    {{ substr($student->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white leading-tight capitalize">
                                                {{ $student->name }}</p>
                                            <p
                                                class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-0.5">
                                                ID: #{{ $student->studentID }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-700/50">
                                        {{ $student->classes->classes ?? 'S/G' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    @if ($tmember)
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $tmember->transport->route }}</span>
                                            <span class="text-[10px] text-slate-400 font-medium">Vehículo:
                                                {{ $tmember->transport->vehicle }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs font-bold text-slate-300 dark:text-slate-600 italic">No
                                            asignado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    @if ($tmember)
                                        <span class="text-sm font-black text-slate-900 dark:text-white">
                                            ${{ number_format($tmember->tbalance, 2) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    @if ($tmember)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-wider border border-emerald-200 dark:border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Activo
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-wider border border-slate-200 dark:border-slate-700">
                                            <i class="ti ti-clock text-xs"></i> Pendiente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($tmember)
                                            <a href="{{ route('tmember.show', $tmember->tmemberID) }}"
                                                class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="ti ti-eye text-lg"></i>
                                            </a>
                                            <a href="{{ route('tmember.edit', $tmember->tmemberID) }}"
                                                class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                                <i class="ti ti-edit text-lg"></i>
                                            </a>
                                            <button
                                                onclick="confirmDeletion('{{ route('tmember.destroy', $tmember->tmemberID) }}', '{{ $student->name }}')"
                                                class="w-9 h-9 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        @else
                                            <a href="{{ route('tmember.create', ['studentID' => $student->studentID]) }}"
                                                class="flex items-center gap-2 px-4 py-2 rounded-xl bg-yellow-600 text-white font-black text-[10px] uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-md shadow-yellow-600/10">
                                                <i class="ti ti-plus text-sm"></i> Asignar
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <p
                                        class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                                        No se encontraron estudiantes para los filtros seleccionados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            function confirmDeletion(url, name) {
                Swal.fire({
                    title: '¿Retirar Estudiante?',
                    text: `¿Estás seguro de que deseas retirar a ${name} de la ruta de transporte?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: 'Sí, retirar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML =
                            `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
