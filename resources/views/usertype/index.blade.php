<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-rose-500/10 flex items-center justify-center text-rose-600 dark:text-rose-400 border border-slate-200 dark:border-rose-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-user-cog text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Roles de Usuario
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Define los diferentes niveles
                        de acceso y perfiles del sistema</p>
                </div>
            </div>

            <a href="{{ route('usertype.create') }}"
                class="px-6 py-3 rounded-2xl bg-rose-600 hover:bg-rose-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-rose-600/30 hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus text-lg"></i> Nuevo Rol
            </a>
        </div>

        <!-- Role Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($usertypes as $type)
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-6 shadow-sm group hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-rose-600 dark:text-rose-400">
                            <i class="ti ti-shield-check text-2xl"></i>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('usertype.edit', $type->usertypeID) }}"
                                class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-rose-600 transition-colors">
                                <i class="ti ti-edit text-lg"></i>
                            </a>
                            @if ($type->usertypeID > 4)
                                <form action="{{ route('usertype.destroy', $type->usertypeID) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar este rol?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="p-2 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-900/30 text-slate-400 hover:text-rose-600 transition-colors">
                                        <i class="ti ti-trash text-lg"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                        {{ $type->usertype }}</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">ID del Rol:
                        #{{ $type->usertypeID }}</p>

                    <div
                        class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                        <span
                            class="px-3 py-1 rounded-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                            {{ $type->usertypeID <= 4 ? 'Sistema' : 'Personalizado' }}
                        </span>
                        <a href="#"
                            class="text-[10px] font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest hover:underline">Ver
                            Permisos</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
