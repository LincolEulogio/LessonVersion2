<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-linear-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">
                    {{ __('Editar Docente') }}
                </h1>
                <p class="mt-2 text-slate-400">Actualizando el perfil de: <span
                        class="text-emerald-400 font-bold">{{ $teacher->name }}</span></p>
            </div>
            <a href="{{ route('teacher.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50">
                <i class="ti ti-arrow-left"></i>
                Volver
            </a>
        </div>

        <!-- Form Card -->
        <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-2xl">
            <form action="{{ route('teacher.update', $teacher->teacherID) }}" method="POST"
                enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Profile Info Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-user-edit text-emerald-400 text-xl"></i>
                        Información Profesional
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-400">Nombre Completo <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $teacher->name) }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Designation -->
                        <div class="space-y-2">
                            <label for="designation" class="text-sm font-medium text-slate-400">Cargo / Especialidad
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="designation" id="designation"
                                value="{{ old('designation', $teacher->designation) }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('designation')" class="mt-1" />
                        </div>

                        <!-- DNI -->
                        <div class="space-y-2">
                            <label for="dni" class="text-sm font-medium text-slate-400">DNI / Documento <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="dni" id="dni" value="{{ old('dni', $teacher->dni) }}"
                                required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('dni')" class="mt-1" />
                        </div>

                        <!-- JOD (Joining Date) -->
                        <div class="space-y-2">
                            <label for="jod" class="text-sm font-medium text-slate-400">Fecha de Ingreso <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="jod" id="jod" value="{{ old('jod', $teacher->jod) }}"
                                required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('jod')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Personal Info Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-id text-emerald-400 text-xl"></i>
                        Datos Personales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DOB -->
                        <div class="space-y-2">
                            <label for="dob" class="text-sm font-medium text-slate-400">Fecha de Nacimiento <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob', $teacher->dob) }}"
                                required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('dob')" class="mt-1" />
                        </div>

                        <!-- Sex -->
                        <div class="space-y-2">
                            <label for="sex" class="text-sm font-medium text-slate-400">Género <span
                                    class="text-red-500">*</span></label>
                            <select name="sex" id="sex" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all cursor-pointer">
                                <option value="Masculino"
                                    {{ old('sex', $teacher->sex) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino"
                                    {{ old('sex', $teacher->sex) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            <x-input-error :messages="$errors->get('sex')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-slate-400">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $teacher->email) }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-medium text-slate-400">Teléfono</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $teacher->phone) }}"
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Credentials Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-lock text-emerald-400 text-xl"></i>
                        Seguridad
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div class="space-y-2">
                            <label for="username" class="text-sm font-medium text-slate-400">Usuario <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="username" id="username"
                                value="{{ old('username', $teacher->username) }}" required
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-slate-400">Nueva Contraseña (Dejar
                                vacío para mantener)</label>
                            <input type="password" name="password" id="password"
                                class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-200 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Photo Upload -->
                <div>
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-camera text-emerald-400 text-xl"></i>
                        Fotografía
                    </h3>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-2xl border-2 border-slate-700/50 flex items-center justify-center text-slate-500 overflow-hidden shadow-inner bg-slate-900/30"
                            id="photo-preview-container">
                            <img src="{{ asset($teacher->photo && $teacher->photo != 'default.png' ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-600/10 file:text-emerald-400 hover:file:bg-emerald-600/20 transition-all cursor-pointer">
                            <p class="mt-2 text-xs text-slate-500">Suba una imagen nueva para reemplazar la actual.</p>
                            <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-4 bg-linear-to-r from-amber-600 to-orange-600 hover:from-amber-500 hover:to-orange-500 text-white rounded-2xl font-bold text-lg shadow-xl shadow-amber-500/20 active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        <i class="ti ti-device-floppy text-2xl"></i>
                        Actualizar Docente
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image preview script -->
    <script>
        document.getElementById('photo').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const container = document.getElementById('photo-preview-container');
                container.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
                container.classList.add('border-emerald-500/50');
            }
        }
    </script>
</x-app-layout>
