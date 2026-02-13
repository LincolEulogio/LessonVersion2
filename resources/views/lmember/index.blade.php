<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-indigo-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-library text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Miembros de Biblioteca
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión de membresías y
                        estados de cuenta</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('lmember.create') }}"
                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-indigo-600 text-white font-black text-xs uppercase tracking-widest hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    Nuevo Miembro
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                        <i class="ti ti-users text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                            Total Miembros</p>
                        <h4 class="text-2xl font-black text-slate-900 dark:text-white">{{ $members->count() }}</h4>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                        <i class="ti ti-wallet text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                            Saldo Acumulado</p>
                        <h4 class="text-2xl font-black text-slate-900 dark:text-white">
                            ${{ number_format($members->sum('lbalance'), 2) }}</h4>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800/40 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-orange-500/10 flex items-center justify-center text-orange-500">
                        <i class="ti ti-calendar-event text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                            Último Ingreso</p>
                        <h4 class="text-xl font-black text-slate-900 dark:text-white">
                            {{ $members->max('ljoindate') ?? '--' }}</h4>
                    </div>
                </div>
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
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                ID Biblioteca</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Grado</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                Saldo</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($members as $member)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 font-black text-xs uppercase border border-slate-200 dark:border-slate-700">
                                            @if ($member->student?->photo)
                                                <img src="{{ asset('uploads/images/' . $member->student->photo) }}"
                                                    class="w-full h-full object-cover rounded-xl">
                                            @else
                                                {{ substr($member->name, 0, 2) }}
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                                                {{ $member->name }}</p>
                                            <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                                {{ $member->email ?? 'no-email@servidor.com' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-black uppercase tracking-wider border border-indigo-100 dark:border-indigo-500/20">
                                        {{ $member->lmembercardID }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-bold text-slate-600 dark:text-slate-400">
                                        {{ $member->student?->classes?->classes ?? 'Sin asignar' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-black text-slate-900 dark:text-white">
                                        ${{ number_format($member->lbalance, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('lmember.show', $member->lmemberID) }}"
                                            class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                            title="Ver Detalles">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('lmember.edit', $member->lmemberID) }}"
                                            class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all shadow-sm"
                                            title="Editar">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button
                                            onclick="confirmDeletion('{{ route('lmember.destroy', $member->lmemberID) }}', '{{ $member->name }}')"
                                            class="w-9 h-9 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm"
                                            title="Eliminar">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center text-slate-300 mb-4">
                                            <i class="ti ti-mood-empty text-4xl"></i>
                                        </div>
                                        <p
                                            class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                                            No se encontraron miembros registrados</p>
                                    </div>
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
                    title: '¿Estás seguro?',
                    text: `Vas a eliminar la membresía de ${name}. Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a',
                    borderRadius: '1.5rem',
                    customClass: {
                        popup: 'border border-slate-200 dark:border-slate-700 shadow-2xl',
                        confirmButton: 'rounded-xl font-black uppercase tracking-widest text-xs px-6 py-3',
                        cancelButton: 'rounded-xl font-black uppercase tracking-widest text-xs px-6 py-3'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;

                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        form.appendChild(csrfInput);
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
