<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-500/10 flex items-center justify-center text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-user-exclamation text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Administradores del Sistema
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestiona el personal con
                        acceso total a la plataforma</p>
                </div>
            </div>

            <a href="{{ route('systemadmin.create') }}"
                class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus text-lg"></i> Agregar Admin
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
                <i class="ti ti-circle-check text-xl"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Grid View -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($systemadmins as $admin)
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm group hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-slate-500/5 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-slate-500/10 transition-colors">
                    </div>

                    <div class="flex items-center gap-6 mb-8">
                        <div
                            class="w-20 h-20 rounded-[28px] border-4 border-slate-50 dark:border-slate-900 overflow-hidden shadow-lg shrink-0">
                            @if ($admin->photo && $admin->photo != 'default.png')
                                <img src="{{ asset('uploads/images/' . $admin->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-slate-400 text-2xl font-black">
                                    {{ substr($admin->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3
                                class="text-xl font-black text-slate-900 dark:text-white leading-tight capitalize tracking-tight">
                                {{ $admin->name }}</h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">
                                {{ $admin->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-center text-slate-400">
                                <i class="ti ti-phone text-base"></i>
                            </div>
                            <span
                                class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ $admin->phone ?? 'Sin teléfono' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-center text-slate-400">
                                <i class="ti ti-id text-base"></i>
                            </div>
                            <span
                                class="text-sm font-bold text-slate-600 dark:text-slate-400 uppercase">{{ $admin->dni }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-6 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('systemadmin.show', $admin->systemadminID) }}"
                            class="flex-1 py-3.5 rounded-2xl bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white font-black text-[10px] uppercase tracking-widest text-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                            Detalles
                        </a>
                        <a href="{{ route('systemadmin.edit', $admin->systemadminID) }}"
                            class="p-3.5 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                            <i class="ti ti-edit text-lg"></i>
                        </a>
                        @if ($admin->systemadminID != 1)
                            <form action="{{ route('systemadmin.destroy', $admin->systemadminID) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este administrador?')">
                                @csrf @method('DELETE')
                                <button
                                    class="p-3.5 rounded-2xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $systemadmins->links() }}
        </div>
    </div>
</x-app-layout>
