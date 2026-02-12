<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('systemadmin.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Editar Administrador</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Modifica los datos del perfil de
                    gestión</p>
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

        <form action="{{ route('systemadmin.update', $systemadmin->systemadminID) }}" method="POST"
            enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm overflow-hidden relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-slate-500/5 rounded-full blur-3xl"></div>

                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 relative">Información
                    Personal</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
                    <div class="space-y-2">
                        <x-form.label for="name">Nombre Completo</x-form.label>
                        <x-form.input name="name" id="name" value="{{ $systemadmin->name }}" required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="dni">DNI / ID Personal</x-form.label>
                        <x-form.input name="dni" id="dni" value="{{ $systemadmin->dni }}" required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="dob">F. de Nacimiento</x-form.label>
                        <x-form.input type="date" name="dob" id="dob"
                            value="{{ \Carbon\Carbon::parse($systemadmin->dob)->format('Y-m-d') }}" required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="sex">Género</x-form.label>
                        <select name="sex" id="sex"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold">
                            <option value="Masculino" {{ $systemadmin->sex == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="Femenino" {{ $systemadmin->sex == 'Femenino' ? 'selected' : '' }}>Femenino
                            </option>
                            <option value="Otro" {{ $systemadmin->sex == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="jod">Fecha de Ingreso</x-form.label>
                        <x-form.input type="date" name="jod" id="jod"
                            value="{{ \Carbon\Carbon::parse($systemadmin->jod)->format('Y-m-d') }}" required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="phone">Teléfono</x-form.label>
                        <x-form.input name="phone" id="phone" value="{{ $systemadmin->phone }}" />
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <x-form.label for="address">Dirección de Residencia</x-form.label>
                        <x-form.input name="address" id="address" value="{{ $systemadmin->address }}" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="photo">Cambiar Foto</x-form.label>
                        <input type="file" name="photo"
                            class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm relative overflow-hidden">
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>

                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 relative">Credenciales
                    de Acceso</h4>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                    <div class="space-y-2">
                        <x-form.label for="email">Correo Electrónico</x-form.label>
                        <x-form.input type="email" name="email" id="email" value="{{ $systemadmin->email }}"
                            required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="username">Nombre de Usuario</x-form.label>
                        <x-form.input name="username" id="username" value="{{ $systemadmin->username }}" required />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="password">Nueva Contraseña (Dejar vacío para no cambiar)</x-form.label>
                        <x-form.input type="password" name="password" id="password" />
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-12 py-5 rounded-3xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-[0.2em] transition-all shadow-2xl hover:scale-105 active:scale-95">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
