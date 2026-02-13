<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                    <i class="ti ti-shield-lock text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        {{ __('Permisos de Roles') }}
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">
                        {{ __('Configura los accesos y privilegios para cada nivel de usuario') }}
                    </p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
                <i class="ti ti-circle-check text-xl"></i>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl flex items-center gap-3 text-rose-600 dark:text-rose-400">
                <i class="ti ti-alert-circle text-xl"></i>
                <p class="text-sm font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Role Selector Card -->
        <div
            class="mb-8 p-8 bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm relative overflow-hidden">
            <form id="roleForm" action="{{ route('permission.index') }}" method="GET"
                class="flex flex-col md:flex-row items-center justify-center gap-6">
                <label for="usertypeID"
                    class="text-sm font-black text-slate-400 uppercase tracking-widest">{{ __('Seleccionar Rol') }}</label>
                <div class="relative w-full md:w-72">
                    <select name="usertypeID" id="usertypeID" onchange="this.form.submit()"
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-black text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                        @foreach ($usertypes as $type)
                            <option value="{{ $type->usertypeID }}"
                                {{ $usertypeID == $type->usertypeID ? 'selected' : '' }}>
                                {{ $type->usertype }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Permissions Matrix -->
        <form action="{{ route('permission.store') }}" method="POST">
            @csrf
            <input type="hidden" name="usertypeID" value="{{ $usertypeID }}">

            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm overflow-hidden transition-all duration-500 h-full mb-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] w-16">
                                    <input type="checkbox" id="checkAll"
                                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Nombre Del Módulo') }}</th>
                                <th
                                    class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                    {{ __('Agregar') }}</th>
                                <th
                                    class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                    {{ __('Editar') }}</th>
                                <th
                                    class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                    {{ __('Borrar') }}</th>
                                <th
                                    class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                    {{ __('Ver') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @foreach ($modules as $index => $module)
                                @php
                                    $moduleSlug = Str::slug($module['name'], '_');
                                    // Alternating background color as seen in images (light green/white)
                                    $bgColor =
                                        $index % 2 === 0
                                            ? 'bg-emerald-50/30 dark:bg-emerald-500/5'
                                            : 'bg-white dark:bg-transparent';
                                @endphp
                                <tr
                                    class="{{ $bgColor }} hover:bg-slate-50/50 dark:hover:bg-slate-900/20 transition-colors">
                                    <td class="px-8 py-5">
                                        <input type="checkbox"
                                            class="moduleGroups rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                            data-module="{{ $moduleSlug }}">
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.5)]">
                                            </div>
                                            <span
                                                class="text-sm font-black text-slate-900 dark:text-white capitalize">{{ $module['name'] }}</span>
                                        </div>
                                    </td>

                                    @foreach (['add', 'edit', 'delete', 'view'] as $action)
                                        <td class="px-6 py-5 text-center">
                                            @if (in_array($action, $module['actions']))
                                                @php
                                                    $permName = $moduleSlug . '_' . $action;
                                                    $isAssigned = false;
                                                    $currentPerm = \App\Models\Permission::where(
                                                        'name',
                                                        $permName,
                                                    )->first();
                                                    if (
                                                        $currentPerm &&
                                                        in_array($currentPerm->permissionID, $assignedPermissionIDs)
                                                    ) {
                                                        $isAssigned = true;
                                                    }
                                                @endphp
                                                <input type="checkbox" name="permissions[]" value="{{ $permName }}"
                                                    class="action-checkbox-{{ $moduleSlug }} rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 w-5 h-5 transition-transform hover:scale-110"
                                                    {{ $isAssigned ? 'checked' : '' }}>
                                            @else
                                                <span
                                                    class="text-slate-200 dark:text-slate-800 italic text-[10px]">---</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-12 py-5 rounded-3xl bg-indigo-600 text-white font-black text-xs uppercase tracking-[0.2em] transition-all shadow-2xl shadow-indigo-600/20 hover:scale-105 active:scale-95 hover:bg-indigo-500 flex items-center gap-3">
                    <i class="ti ti-device-floppy text-lg"></i>
                    {{ __('Guardar Cambios') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);

            const groupChecks = document.querySelectorAll('.moduleGroups');
            groupChecks.forEach(cb => cb.checked = this.checked);
        });

        document.querySelectorAll('.moduleGroups').forEach(groupCheck => {
            groupCheck.addEventListener('change', function() {
                const module = this.getAttribute('data-module');
                const actionChecks = document.querySelectorAll('.action-checkbox-' + module);
                actionChecks.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
</x-app-layout>
