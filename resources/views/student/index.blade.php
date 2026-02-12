<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header & Action Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                    {{ __('Gestión de Estudiantes') }}
                </h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">
                    {{ __('Listado completo de estudiantes registrados en el sistema.') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('student.create') }}"
                    class="group flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-bold transition-all active:scale-95">
                    <i class="ti ti-plus text-lg"></i>
                    <span>{{ __('Añadir Estudiante') }}</span>
                </a>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="mb-8 p-6 rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
            <form action="{{ route('student.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-6">
                <div class="flex-1 w-full">
                    <label for="classesID"
                        class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">{{ __('Filtrar por Grado/Clase') }}</label>
                    <select name="classesID" id="classesID"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                        <option value="">{{ __('Todas las Clases') }}</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="w-full md:w-auto px-6 py-2.5 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-700 dark:text-white rounded-xl font-bold transition-all border border-slate-200 dark:border-slate-600/50 flex items-center justify-center gap-2">
                    <i class="ti ti-filter"></i>
                    {{ __('Filtrar') }}
                </button>
            </form>
        </div>

        <!-- Students Table Card -->
        <div
            class="rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-100 dark:border-slate-700/50">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">{{ __('Foto') }}</th>
                            <th class="px-6 py-4">{{ __('Estudiante') }}</th>
                            <th class="px-6 py-4">{{ __('Clase / Sección') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Estado') }}</th>
                            <th class="px-6 py-4 text-right pr-10">{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                        @forelse($students as $student)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-all duration-200">
                                <td class="px-6 py-4 text-slate-400 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ $student->photo ? asset('uploads/images/' . $student->photo) : asset('uploads/images/default.png') }}"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-slate-200 dark:border-slate-700 group-hover:border-indigo-500 transition-colors"
                                        alt="{{ $student->name }}">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $student->name }}</span>
                                        <span
                                            class="text-xs text-slate-500">{{ $student->email ?? __('Sin email') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-md text-xs font-bold">{{ $student->classes->classes ?? 'N/A' }}</span>
                                        <span class="text-slate-600">/</span>
                                        <span class="text-slate-400">{{ $student->section->section ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($student->active)
                                        <span
                                            class="px-3 py-1 bg-green-500/10 text-green-500 border border-green-500/20 rounded-full text-xs font-bold">{{ __('Activo') }}</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-red-500/10 text-red-500 border border-red-500/20 rounded-full text-xs font-bold">{{ __('Inactivo') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right pr-6">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('student.show', $student->studentID) }}"
                                            class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all"
                                            title="{{ __('Ver Perfil') }}">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('student.edit', $student->studentID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="{{ __('Editar') }}">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button
                                            class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                            title="{{ __('Eliminar') }}">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ti ti-users-minus text-4xl"></i>
                                        <p>{{ __('No se encontraron estudiantes para los filtros seleccionados.') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($students->hasPages())
                <div
                    class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-900/20">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
