<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-linear-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent">
                    {{ __('Nuevo Administrador') }}
                </h1>
                <p class="mt-2 text-slate-400">Asigne privilegios administrativos a un nuevo usuario.</p>
            </div>
            <a href="{{ route('systemadmin.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50">
                <i class="ti ti-arrow-left"></i>
                Volver
            </a>
        </div>

        <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-2xl">
            <form action="{{ route('systemadmin.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                <!-- Identity Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-shield-check text-purple-400 text-xl"></i>
                        Identidad Administrativa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-400">Nombre Completo <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div class="space-y-2">
                            <label for="dni" class="text-sm font-medium text-slate-400">DNI / Documento <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="dni" id="dni" value="{{ old('dni') }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                            <x-input-error :messages="$errors->get('dni')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Personal Info Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="dob" class="text-sm font-medium text-slate-400">Fecha de Nacimiento <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('dob')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="sex" class="text-sm font-medium text-slate-400">Género</label>
                        <select name="sex" id="sex"
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all cursor-pointer">
                            <option value="">Seleccionar...</option>
                            <option value="Masculino" {{ old('sex') == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="Femenino" {{ old('sex') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        <x-input-error :messages="$errors->get('sex')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-slate-400">Email Administrativo <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="phone" class="text-sm font-medium text-slate-400">Teléfono Corporativo</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="jod" class="text-sm font-medium text-slate-400">Fecha de Alta <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="jod" id="jod" value="{{ old('jod', date('Y-m-d')) }}"
                            required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('jod')" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="address" class="text-sm font-medium text-slate-400">Dirección</label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>

                <hr class="border-slate-700/30">

                <!-- Credentials -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="username" class="text-sm font-medium text-slate-400">Usuario <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('username')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-slate-400">Contraseña <span
                                class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                </div>

                <!-- Photo -->
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-slate-700 flex items-center justify-center text-slate-500 overflow-hidden shadow-inner bg-slate-900/30"
                        id="photo-preview-container">
                        <i class="ti ti-photo-plus text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-purple-600/10 file:text-purple-400 hover:file:bg-purple-600/20 transition-all cursor-pointer">
                        <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-linear-to-r from-purple-600 to-fuchsia-600 hover:from-purple-500 hover:to-fuchsia-500 text-white rounded-2xl font-bold text-lg shadow-xl shadow-purple-500/20 transition-all">
                    Registrar Administrador
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('photo').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const container = document.getElementById('photo-preview-container');
                container.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
                container.classList.remove('border-dashed');
                container.classList.add('border-solid', 'border-purple-500/50');
            }
        }
    </script>
</x-app-layout>
