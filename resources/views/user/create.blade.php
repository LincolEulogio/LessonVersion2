<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('user.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Agregar Usuario</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Registra personal operativo con
                    diferentes niveles de acceso</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-8 p-6 bg-rose-500/10 border border-rose-500/20 rounded-3xl">
                <div class="flex items-center gap-3 text-rose-600 dark:text-rose-400 mb-4">
                    <i class="ti ti-alert-circle text-2xl"></i>
                    <h5 class="font-black uppercase text-xs tracking-widest">Se encontraron errores</h5>
                </div>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-xs font-bold text-rose-500/80">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm overflow-hidden relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-slate-500/5 rounded-full blur-3xl"></div>

                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 relative">Información
                    Personal</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
                    <div class="space-y-2">
                        <x-form.label for="name">Nombre Completo</x-form.label>
                        <x-form.input name="name" id="name" required value="{{ old('name') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="dni">DNI / CI</x-form.label>
                        <x-form.input name="dni" id="dni" required value="{{ old('dni') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="dob">Fecha De Nacimiento</x-form.label>
                        <x-form.input type="date" name="dob" id="dob" required
                            value="{{ old('dob') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="sex">Género</x-form.label>
                        <select name="sex" id="sex"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                            <option value="Masculino" {{ old('sex') == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="Femenino" {{ old('sex') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Otro" {{ old('sex') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="jod">Día De Ingreso</x-form.label>
                        <x-form.input type="date" name="jod" id="jod" required
                            value="{{ old('jod') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="phone">Teléfono</x-form.label>
                        <x-form.input name="phone" id="phone" value="{{ old('phone') }}" />
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <x-form.label for="address">Dirección</x-form.label>
                        <x-form.input name="address" id="address" value="{{ old('address') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="photo">Foto</x-form.label>
                        <div class="relative group">
                            <input type="file" name="photo" id="photo" class="hidden"
                                onchange="updateFileName(this)">
                            <label for="photo"
                                class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-indigo-500 transition-colors">
                                <span
                                    class="text-xs font-bold text-slate-400 group-hover:text-indigo-500 transition-colors"
                                    id="file-name">Seleccionar archivo</span>
                                <i class="ti ti-upload text-slate-400 group-hover:text-indigo-500"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm relative overflow-hidden">
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>

                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 relative">Credenciales
                    de Acceso</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                    <div class="space-y-2 lg:col-span-2">
                        <x-form.label for="usertypeID">Rol de Usuarios</x-form.label>
                        <div class="flex gap-2">
                            <select name="usertypeID" id="usertypeID" required
                                class="flex-1 px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                                <option value="">Seleccionar Rol</option>
                                @foreach ($usertypes as $role)
                                    <option value="{{ $role->usertypeID }}"
                                        {{ old('usertypeID') == $role->usertypeID ? 'selected' : '' }}>
                                        {{ $role->usertype }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('usertype.index') }}"
                                class="w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center text-white hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                                <i class="ti ti-plus text-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input type="email" name="email" id="email" required
                            value="{{ old('email') }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="username">Nombre De Usuario</x-form.label>
                        <x-form.input name="username" id="username" required value="{{ old('username') }}" />
                    </div>
                    <div class="space-y-2 lg:col-start-4">
                        <x-form.label for="password">Contraseña</x-form.label>
                        <div class="relative group">
                            <x-form.input type="password" name="password" id="password" required />
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-500">
                                <i class="ti ti-eye text-lg" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-12 py-5 rounded-3xl bg-indigo-600 text-white font-black text-xs uppercase tracking-[0.2em] transition-all shadow-2xl shadow-indigo-600/20 hover:scale-105 active:scale-95 hover:bg-indigo-500">
                    Agregar Usuario
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
            } else {
                label.innerText = 'Seleccionar archivo';
            }
        }

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ti-eye', 'ti-eye-off');
            } else {
                input.type = 'password';
                icon.classList.replace('ti-eye-off', 'ti-eye');
            }
        }
    </script>
</x-app-layout>
