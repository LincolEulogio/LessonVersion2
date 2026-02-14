<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-[1600px] mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-emerald-500 rounded-full"></div>
                    <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase">
                        {{ __('Académica') }}
                    </h1>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-[0.3em] ml-5">
                    {{ __('Gestión de Niveles y Grados Escolares') }}
                </p>
            </div>

            @if ($user && $user->hasPermission('clases_add'))
                <a href="{{ route('classes.create') }}"
                    class="group flex items-center gap-3 px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-3xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-emerald-500/20">
                    <i class="ti ti-plus text-xl group-hover:rotate-90 transition-transform duration-300"></i>
                    {{ __('Registrar Nueva Clase') }}
                </a>
            @endif
        </div>

        <!-- Filter & Stats Dashboard -->
        <div class="mb-10 flex flex-col lg:flex-row gap-6 items-stretch">
            <!-- Search Control -->
            <div
                class="flex-1 bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-6 shadow-sm dark:shadow-none transition-all hover:border-emerald-500/30">
                <form action="{{ route('classes.index') }}" method="GET" id="filter-form" class="relative group">
                    <label for="search" class="sr-only">{{ __('Buscar') }}</label>
                    <i
                        class="ti ti-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 text-lg transition-colors"></i>
                    <input type="text" name="search" id="search" value="{{ $search ?? '' }}"
                        placeholder="{{ __('Busca por nombre de clase, valor numérico o maestro...') }}"
                        oninput="if(this.value.length > 2 || this.value.length == 0) setTimeout(() => document.getElementById('filter-form').submit(), 500)"
                        class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[24px] text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-emerald-500/20 transition-all font-medium">
                </form>
            </div>

            <!-- Total Classes Stat Card -->
            <div
                class="lg:w-72 bg-emerald-600 rounded-[32px] p-6 text-white shadow-xl shadow-emerald-500/20 relative overflow-hidden group">
                <div
                    class="absolute -right-10 -bottom-10 text-white/10 group-hover:scale-125 transition-transform duration-700">
                    <i class="ti ti-school text-[140px]"></i>
                </div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">{{ __('Total Registros') }}
                    </p>
                    <div class="flex items-end gap-3 mt-4">
                        <span class="text-5xl font-black leading-none tracking-tighter">{{ $classes->total() }}</span>
                        <span class="text-xs font-bold opacity-70 mb-1 uppercase">{{ __('Clases') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-900/50">
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] border-b border-slate-100 dark:border-slate-700/50">
                                {{ __('ID') }}
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] border-b border-slate-100 dark:border-slate-700/50">
                                {{ __('Clase y Nivel') }}
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] border-b border-slate-100 dark:border-slate-700/50 text-center">
                                {{ __('Valor Numérico') }}
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] border-b border-slate-100 dark:border-slate-700/50">
                                {{ __('Docente Responsable') }}
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] border-b border-slate-100 dark:border-slate-700/50 text-right">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($classes as $class)
                            <tr
                                class="group hover:bg-slate-50/50 dark:hover:bg-emerald-500/5 transition-all duration-300">
                                <td class="px-8 py-7">
                                    <span
                                        class="text-xs font-black text-slate-400 dark:text-slate-600 group-hover:text-emerald-500 transition-colors uppercase">
                                        #{{ sprintf('%03d', $class->classesID) }}
                                    </span>
                                </td>
                                <td class="px-8 py-7">
                                    <div class="flex items-center gap-5">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/5 dark:from-emerald-500/10 dark:to-emerald-600/5 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-black text-xl border border-emerald-500/10 shadow-inner group-hover:scale-110 transition-transform">
                                            {{ substr($class->classes, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col gap-0.5">
                                            <span
                                                class="text-base font-black text-slate-800 dark:text-slate-100 group-hover:text-emerald-500 transition-colors">
                                                {{ $class->classes }}
                                            </span>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                                {{ __('Nivel Académico') }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-7 text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-10 h-10 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-black shadow-sm group-hover:border-emerald-500/30 transition-all">
                                        {{ $class->classes_numeric }}
                                    </div>
                                </td>
                                <td class="px-8 py-7">
                                    @if ($class->teacher_name)
                                        <div class="flex items-center gap-3">
                                            @if ($class->teacher_photo)
                                                <img src="{{ asset('uploads/images/' . $class->teacher_photo) }}"
                                                    class="w-10 h-10 rounded-xl object-cover border-2 border-white dark:border-slate-700 shadow-sm"
                                                    alt="">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400">
                                                    <i class="ti ti-user-star text-base"></i>
                                                </div>
                                            @endif
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-black text-slate-700 dark:text-slate-200">{{ $class->teacher_name }}</span>
                                                <span
                                                    class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">{{ __('Titular') }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-slate-400 italic">
                                            <i class="ti ti-user-off text-base"></i>
                                            <span class="text-xs font-bold">{{ __('Sin asignar') }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-8 py-7">
                                    <div
                                        class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition-all duration-300">
                                        @if ($user && $user->hasPermission('clases_view'))
                                            <a href="{{ route('classes.show', $class->classesID) }}"
                                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-500/5 group/btn">
                                                <i
                                                    class="ti ti-eye text-xl group-hover/btn:scale-110 transition-transform"></i>
                                            </a>
                                        @endif
                                        @if ($user && $user->hasPermission('clases_edit'))
                                            <a href="{{ route('classes.edit', $class->classesID) }}"
                                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-600 hover:text-white dark:hover:bg-amber-500 transition-all shadow-lg shadow-amber-500/5 group/btn">
                                                <i
                                                    class="ti ti-edit text-xl group-hover/btn:scale-110 transition-transform"></i>
                                            </a>
                                        @endif
                                        @if ($user && $user->hasPermission('clases_delete'))
                                            <button type="button"
                                                onclick="confirmDelete('{{ $class->classesID }}', '{{ $class->classes }}')"
                                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 transition-all shadow-lg shadow-rose-500/5 group/btn">
                                                <i
                                                    class="ti ti-trash text-xl group-hover/btn:scale-110 transition-transform"></i>
                                            </button>
                                            <form id="delete-form-{{ $class->classesID }}"
                                                action="{{ route('classes.destroy', $class->classesID) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center gap-6">
                                        <div
                                            class="w-24 h-24 rounded-full bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center text-slate-200 dark:text-slate-800">
                                            <i class="ti ti-school-off text-6xl"></i>
                                        </div>
                                        <div class="space-y-1">
                                            <p
                                                class="text-xl font-black text-slate-800 dark:text-slate-200 tracking-tight">
                                                {{ __('No se encontraron registros') }}
                                            </p>
                                            <p class="text-slate-400 dark:text-slate-500 text-sm font-medium">
                                                {{ __('Intenta con otros términos o crea una nueva clase para comenzar.') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            <div
                class="px-10 py-8 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Mostrando') }}</span>
                    <div class="flex items-center gap-2">
                        <span
                            class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-xs font-black text-emerald-600 border border-slate-200 dark:border-slate-700 shadow-sm">{{ $classes->firstItem() ?? 0 }}</span>
                        <span class="text-slate-300 dark:text-slate-700">—</span>
                        <span
                            class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-xs font-black text-emerald-600 border border-slate-200 dark:border-slate-700 shadow-sm">{{ $classes->lastItem() ?? 0 }}</span>
                    </div>
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('de') }}</span>
                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ $classes->total() }}</span>
                    <span
                        class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em]">{{ __('Registros Totales') }}</span>
                </div>
                <div class="premium-pagination">
                    {{ $classes->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '¿ELIMINAR CLASE?',
                text: `Estás a punto de borrar "${name}". Esta acción es irreversible y podría afectar la integridad académica de los estudiantes vinculados.`,
                icon: 'warning',
                iconColor: '#f43f5e',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'SÍ, ELIMINAR AHORA',
                cancelButtonText: 'CANCELAR',
                background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                borderRadius: '40px',
                customClass: {
                    popup: 'border border-slate-200 dark:border-slate-700 shadow-2xl backdrop-blur-xl',
                    title: 'text-2xl font-black tracking-tight mt-4',
                    htmlContainer: 'text-sm font-medium leading-relaxed opacity-70',
                    confirmButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] transition-all hover:scale-105 active:scale-95 m-2',
                    cancelButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] m-2 transition-all hover:scale-105 active:scale-95'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
