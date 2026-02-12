<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-500/10 flex items-center justify-center text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                    <i class="ti ti-users text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Gestión de Usuarios
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Administra todo el personal y
                        roles operativos del sistema</p>
                </div>
            </div>

            <a href="{{ route('user.create') }}"
                class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus text-lg"></i> Agregar Usuario
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
                <i class="ti ti-circle-check text-xl"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table View -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden transition-all duration-500 h-full">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">#
                            </th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Usuario / Personal</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">DNI /
                                Email</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Teléfono</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Rol
                            </th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Estado</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($users as $index => $user)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-900/20 transition-colors">
                                <td class="px-8 py-5">
                                    <span
                                        class="text-sm font-black text-slate-400">{{ $users->firstItem() + $index }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl border-2 border-slate-100 dark:border-slate-700 overflow-hidden shadow-sm shrink-0">
                                            @if ($user->photo && $user->photo != 'default.png')
                                                <img src="{{ asset('storage/images/' . $user->photo) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-slate-400 font-black">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="text-sm font-black text-slate-900 dark:text-white capitalize transition-colors group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-[10px] font-bold text-slate-400">@ {{ $user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-slate-600 dark:text-slate-400">
                                    <div class="flex flex-col">
                                        <span>{{ $user->dni }}</span>
                                        <span class="text-[10px] font-medium text-slate-400">{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ $user->phone ?? '---' }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-[9px] font-black uppercase tracking-widest">
                                        {{ \App\Models\Usertype::find($user->usertypeID)->usertype ?? 'Usuario' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-4 py-1.5 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest">
                                        Activo
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('user.show', $user->userID) }}"
                                            class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-indigo-600 transition-all"
                                            title="Detalles">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $user->userID) }}"
                                            class="p-2 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 hover:bg-indigo-600 hover:text-white transition-all shadow-sm"
                                            title="Editar">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->userID) }}" method="POST"
                                            onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="p-2 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-500 hover:bg-rose-600 hover:text-white transition-all shadow-sm"
                                                title="Eliminar">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div
                                        class="w-24 h-24 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                                        <i class="ti ti-users-off text-5xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">No hay usuarios
                                        registrados</h3>
                                    <p
                                        class="text-slate-400 dark:text-slate-500 mt-2 max-w-xs mx-auto text-sm font-medium">
                                        Comienza agregando personal operativo al sistema.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
