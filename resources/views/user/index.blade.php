<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-600/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 shadow-sm">
                    <i class="ti ti-users text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        {{ __('Gestión de Usuarios') }}
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                        Administra el personal operativo y sus roles</p>
                </div>
            </div>

            <a href="{{ route('user.create') }}"
                class="px-6 py-3 rounded-2xl bg-emerald-600 text-white font-black text-xs uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus text-lg"></i> {{ __('Agregar Usuario') }}
            </a>
        </div>

        <!-- Filters Section -->
        <div
            class="mb-8 p-6 rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
            <form id="filter-form" action="{{ route('user.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-12 items-end gap-6">
                <!-- Search Filter -->
                <div class="md:col-span-4 w-full">
                    <label for="search"
                        class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">{{ __('Búsqueda Rápida') }}</label>
                    <div class="relative group">
                        <i
                            class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                        <input type="text" name="search" id="search" value="{{ $search ?? '' }}"
                            placeholder="{{ __('Nombre, DNI, Email, Usuario...') }}"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                    </div>
                </div>

                <!-- Role Filter -->
                <div class="md:col-span-3 w-full">
                    <label for="usertypeID"
                        class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">{{ __('Rol / Tipo') }}</label>
                    <select name="usertypeID" id="usertypeID"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all cursor-pointer">
                        <option value="">{{ __('Todos los Roles') }}</option>
                        @foreach ($usertypes as $type)
                            <option value="{{ $type->usertypeID }}"
                                {{ ($usertypeID ?? '') == $type->usertypeID ? 'selected' : '' }}>
                                {{ $type->usertype }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="md:col-span-2 w-full">
                    <label for="active"
                        class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">{{ __('Estado') }}</label>
                    <select name="active" id="active"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all cursor-pointer">
                        <option value="">{{ __('Todos') }}</option>
                        <option value="1" {{ ($active ?? '') === '1' ? 'selected' : '' }}>{{ __('Activos') }}
                        </option>
                        <option value="0" {{ ($active ?? '') === '0' ? 'selected' : '' }}>{{ __('Inactivos') }}
                        </option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="md:col-span-3 flex items-center gap-3">
                    @if (($search ?? '') || ($active ?? '') !== null || ($usertypeID ?? ''))
                        <a href="{{ route('user.index') }}"
                            class="flex-1 px-4 py-2.5 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-xl font-bold transition-all border border-red-500/20 flex items-center justify-center gap-2"
                            title="{{ __('Limpiar Filtros') }}">
                            <i class="ti ti-rotate"></i>
                            <span>{{ __('Limpiar') }}</span>
                        </a>
                    @endif
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                        <i class="ti ti-filter"></i>
                        <span>{{ __('Filtrar') }}</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div
            class="rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm overflow-hidden min-h-[400px]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-900/20">
                            <th class="px-8 py-4">#</th>
                            <th class="px-6 py-4">Personal</th>
                            <th class="px-6 py-4">DNI / Email</th>
                            <th class="px-6 py-4">Teléfono</th>
                            <th class="px-6 py-4 text-center">Rol</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-8 py-4 text-right pr-6">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse ($users as $index => $user)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all duration-200">
                                <td class="px-8 py-5 text-slate-400 text-sm font-bold">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl border-2 border-slate-100 dark:border-slate-700 overflow-hidden shadow-sm shrink-0 group-hover:border-emerald-500 transition-colors">
                                            <img src="{{ asset($user->photo && $user->photo != 'default.png' ? 'storage/images/' . $user->photo : 'uploads/images/default.png') }}"
                                                class="w-full h-full object-cover" alt="{{ $user->name }}">
                                        </div>
                                        <div>
                                            <p
                                                class="text-sm font-bold text-slate-800 dark:text-slate-100 transition-colors group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                                {{ $user->name }}
                                            </p>
                                            <p
                                                class="text-[10px] font-medium text-slate-500 uppercase tracking-tighter">
                                                @ {{ $user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm text-slate-700 dark:text-slate-300 font-bold uppercase tracking-widest">{{ $user->dni }}</span>
                                        <span class="text-xs text-slate-500">{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="text-sm text-slate-600 dark:text-slate-400 font-mono">{{ $user->phone ?? '---' }}</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span
                                        class="px-3 py-1 bg-blue-500/10 text-blue-500 dark:text-blue-400 border border-blue-500/20 rounded-lg text-[10px] font-black uppercase tracking-wider">
                                        {{ $user->usertype->usertype ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if ($user->active)
                                        <span
                                            class="px-4 py-1.5 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest border border-emerald-500/20 shadow-sm shadow-emerald-500/10 animate-pulse">
                                            Activo
                                        </span>
                                    @else
                                        <span
                                            class="px-4 py-1.5 rounded-full bg-red-500/10 text-red-600 dark:text-red-400 text-[10px] font-black uppercase tracking-widest border border-red-500/20">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <a href="{{ route('user.show', $user->userID) }}"
                                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all"
                                            title="Ver Perfil">
                                            <i class="ti ti-eye text-xl"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $user->userID) }}"
                                            class="p-2.5 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 hover:bg-indigo-600 hover:text-white transition-all shadow-sm"
                                            title="Editar">
                                            <i class="ti ti-edit text-xl"></i>
                                        </a>
                                        <button type="button"
                                            onclick="confirmDelete('{{ $user->userID }}', '{{ $user->name }}')"
                                            class="p-2.5 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-500 hover:bg-rose-600 hover:text-white transition-all shadow-sm"
                                            title="Eliminar">
                                            <i class="ti ti-trash text-xl"></i>
                                        </button>
                                        <form id="delete-form-{{ $user->userID }}"
                                            action="{{ route('user.destroy', $user->userID) }}" method="POST"
                                            class="hidden">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-24 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-24 h-24 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-300 dark:text-slate-600 shadow-inner">
                                            <i class="ti ti-users-off text-5xl"></i>
                                        </div>
                                        <h3 class="text-xl font-black text-slate-900 dark:text-white">
                                            {{ __('No hay usuarios registrados') }}</h3>
                                        <p
                                            class="text-slate-500 dark:text-slate-400 max-w-xs mx-auto text-sm font-medium leading-relaxed">
                                            Comienza agregando personal operativo al sistema para gestionar sus roles.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination & Count -->
            @if ($users->hasPages() || $users->total() > 0)
                <div
                    class="px-8 py-5 bg-slate-50 dark:bg-slate-900/20 border-t border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="text-sm font-medium text-slate-500">
                            {{ __('Mostrando del') }} <span
                                class="text-slate-900 dark:text-white font-black underline decoration-emerald-500/50 uppercase">{{ $users->firstItem() }}</span>
                            {{ __('al') }} <span
                                class="text-slate-900 dark:text-white font-black underline decoration-emerald-500/50 uppercase">{{ $users->lastItem() }}</span>
                            {{ __('de un total de') }} <span
                                class="text-slate-900 dark:text-white font-black underline decoration-emerald-500/50 uppercase">{{ $users->total() }}</span>
                            {{ __('usuarios') }}
                        </div>
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Automatic Filtering Logic
            document.addEventListener('DOMContentLoaded', function() {
                const filterForm = document.getElementById('filter-form');
                if (!filterForm) return;

                const searchInput = filterForm.querySelector('#search');
                const selects = filterForm.querySelectorAll('select');
                let debounceTimer;

                // Auto-submit for selects
                selects.forEach(select => {
                    select.addEventListener('change', () => filterForm.submit());
                });

                // Debounced auto-submit for search
                if (searchInput) {
                    searchInput.addEventListener('input', () => {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            filterForm.submit();
                        }, 800);
                    });

                    // Maintain focus and cursor position
                    const val = searchInput.value;
                    searchInput.value = '';
                    searchInput.value = val;
                }
            });

            function confirmDelete(id, name) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `Estás a punto de eliminar al usuario "${name}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981', // emerald-500
                    cancelButtonColor: '#ef4444', // red-500
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
