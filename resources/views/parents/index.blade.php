<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold bg-linear-to-r from-sky-400 to-indigo-400 bg-clip-text text-transparent">
                    {{ __('Gestión de Padres y Tutores') }}
                </h1>
                <p class="mt-2 text-slate-400">Padres de familia y tutores legales registrados en la institución.</p>
            </div>
            <a href="{{ route('parents.create') }}"
                class="group flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-500 text-white rounded-xl font-bold transition-all shadow-lg shadow-sky-500/20 active:scale-95">
                <i class="ti ti-users-plus text-lg"></i>
                <span>Nuevo Tutor</span>
            </a>
        </div>

        <!-- Table Card -->
        <div class="rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-700/50 bg-slate-900/20">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Tutor / Guardian</th>
                            <th class="px-6 py-4">DNI / Email</th>
                            <th class="px-6 py-4">Teléfono</th>
                            <th class="px-6 py-4 text-center">Estado</th>
                            <th class="px-6 py-4 text-right pr-10">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($parents as $parent)
                            <tr class="group hover:bg-slate-700/20 transition-all duration-200">
                                <td class="px-6 py-4 text-slate-400 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset($parent->photo && $parent->photo != 'default.png' ? 'storage/images/' . $parent->photo : 'uploads/images/default.png') }}"
                                            class="w-10 h-10 rounded-xl object-cover border-2 border-slate-700 group-hover:border-sky-500 transition-colors"
                                            alt="{{ $parent->name }}">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-100 group-hover:text-sky-400 transition-colors">{{ $parent->name }}</span>
                                            <span class="text-xs text-slate-500">@ {{ $parent->username }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-slate-300 font-medium">{{ $parent->dni }}</span>
                                        <span class="text-xs text-slate-500">{{ $parent->email ?? 'Sin email' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-sm">
                                    {{ $parent->phone ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($parent->active)
                                        <span
                                            class="px-3 py-1 bg-sky-500/10 text-sky-400 border border-sky-500/20 rounded-full text-xs font-bold shadow-sm">Activo</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-red-500/10 text-red-500 border border-red-500/20 rounded-full text-xs font-bold shadow-sm">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right pr-6">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('parents.show', $parent->parentsID) }}"
                                            class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('parents.edit', $parent->parentsID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('parents.destroy', $parent->parentsID) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Está seguro de eliminar este tutor?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 italic">No se
                                    encontraron tutores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-slate-900/20 border-t border-slate-700/50">
                {{ $parents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
