<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('user.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-emerald-600 transition-all shadow-sm flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        {{ __('Editar Usuario') }}</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                        Actualizando perfil de: <span
                            class="text-emerald-600 font-bold dark:text-emerald-400">{{ $user->name }}</span></p>
                </div>
            </div>
        </div>

        <form action="{{ route('user.update', $user->userID) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Main Form Card -->
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 md:p-12 shadow-sm overflow-hidden relative">

                <!-- Section 1: Personal Information -->
                <div class="mb-12">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-8">
                        <i class="ti ti-user-circle text-emerald-500 dark:text-emerald-400 text-xl"></i>
                        {{ __('Información Personal') }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Nombre Completo') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                oninput="this.value = this.value.replace(/[0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- DNI -->
                        <div class="space-y-2">
                            <label for="dni" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('DNI / Documento Identidad') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="dni" id="dni" value="{{ old('dni', $user->dni) }}"
                                maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('dni')" class="mt-1" />
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-2">
                            <label for="dob" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Fecha de Nacimiento') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob', $user->dob) }}"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('dob')" class="mt-1" />
                        </div>

                        <!-- Gender -->
                        <div class="space-y-2">
                            <label for="sex" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Género') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="sex" id="sex"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                                <option value="">{{ __('Seleccionar') }}</option>
                                <option value="Masculino"
                                    {{ old('sex', $user->sex) == 'Masculino' ? 'selected' : '' }}>
                                    Masculino</option>
                                <option value="Femenino" {{ old('sex', $user->sex) == 'Femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('sex')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <!-- Section 2: Contact & Professional Info -->
                <div class="mb-12 pt-8 border-t border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-8">
                        <i class="ti ti-briefcase text-emerald-500 dark:text-emerald-400 text-xl"></i>
                        {{ __('Información de Contacto y Rol') }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Joining Date -->
                        <div class="space-y-2">
                            <label for="jod" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Fecha de Ingreso') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="jod" id="jod" value="{{ old('jod', $user->jod) }}"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('jod')" class="mt-1" />
                        </div>

                        <!-- User Type / Role -->
                        <div class="space-y-2">
                            <label for="usertypeID" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Rol del Sistema') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="usertypeID" id="usertypeID"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                                <option value="">{{ __('Seleccionar Rol') }}</option>
                                @foreach ($usertypes as $type)
                                    <option value="{{ $type->usertypeID }}"
                                        {{ old('usertypeID', $user->usertypeID) == $type->usertypeID ? 'selected' : '' }}>
                                        {{ $type->usertype }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('usertypeID')" class="mt-1" />
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Teléfono Móvil') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $user->phone) }}" maxlength="9"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2 space-y-2">
                            <label for="email" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Correo Electrónico') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Photo Upload with Preview -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Fotografía') }}
                            </label>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden shrink-0">
                                    <img id="preview"
                                        src="{{ asset($user->photo && $user->photo != 'default.png' ? 'storage/images/' . $user->photo : 'uploads/images/default.png') }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <label for="photo"
                                    class="flex-1 px-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl text-xs font-bold text-slate-500 cursor-pointer hover:border-emerald-500 transition-all flex items-center justify-center gap-2">
                                    <i class="ti ti-upload text-base"></i>
                                    {{ __('Cambiar Foto') }}
                                </label>
                                <input type="file" name="photo" id="photo" class="hidden" accept="image/*"
                                    onchange="previewImage(this)">
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-3 space-y-2">
                            <label for="address" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Dirección Domiciliaria') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" id="address" rows="2"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">{{ old('address', $user->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <!-- Section 3: Credentials -->
                <div class="pt-8 border-t border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-8">
                        <i class="ti ti-shield-lock text-emerald-500 dark:text-emerald-400 text-xl"></i>
                        {{ __('Credenciales de Acceso') }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Username -->
                        <div class="space-y-2">
                            <label for="username" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Nombre de Usuario') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-at absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', $user->username) }}"
                                    class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl pl-11 pr-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ __('Cambiar Contraseña') }} <span
                                    class="text-xs text-slate-400 italic font-normal">({{ __('Opcional') }})</span>
                            </label>
                            <div class="relative group">
                                <i
                                    class="ti ti-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                                <input type="password" name="password" id="password"
                                    placeholder="{{ __('Dejar en blanco para mantener actual') }}"
                                    class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl pl-11 pr-12 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 transition-colors">
                                    <i id="eye-icon" class="ti ti-eye text-xl"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-12 flex justify-end">
                    <button type="submit"
                        class="w-full px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                        <i class="ti ti-device-floppy text-xl"></i>
                        {{ __('Actualizar Usuario') }}
                    </button>
                </div>
            </div>
        </form>

        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.replace('ti-eye', 'ti-eye-off');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.replace('ti-eye-off', 'ti-eye');
                }
            }
        </script>
</x-app-layout>
