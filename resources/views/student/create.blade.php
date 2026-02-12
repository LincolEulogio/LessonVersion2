<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-linear-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">
                    {{ __('Nuevo Estudiante') }}
                </h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">
                    {{ __('Complete la información para registrar un nuevo estudiante.') }}</p>
            </div>
            <a href="{{ route('student.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl transition-all border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                <i class="ti ti-arrow-left"></i>
                {{ __('Volver') }}
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="p-8 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Basic Information Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-user-circle text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Información Personal') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Nombre Completo') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- DOB -->
                        <div class="space-y-2">
                            <label for="dob"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Fecha de Nacimiento') }}</label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('dob')" class="mt-1" />
                        </div>

                        <!-- Sex -->
                        <div class="space-y-2">
                            <label for="sex"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Género') }}
                                <span class="text-red-500">*</span></label>
                            <select name="sex" id="sex" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                <option value="">{{ __('Seleccionar...') }}</option>
                                <option value="Masculino" {{ old('sex') == 'Masculino' ? 'selected' : '' }}>
                                    {{ __('Masculino') }}
                                </option>
                                <option value="Femenino" {{ old('sex') == 'Femenino' ? 'selected' : '' }}>
                                    {{ __('Femenino') }}
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('sex')" class="mt-1" />
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Teléfono / Celular') }}</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Academic Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-school text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Información Académica') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Classes -->
                        <div class="space-y-2">
                            <label for="classesID"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Clase / Grado') }}
                                <span class="text-red-500">*</span></label>
                            <select name="classesID" id="classesID" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                <option value="">{{ __('Seleccionar Clase...') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ old('classesID') == $class->classesID ? 'selected' : '' }}>
                                        {{ $class->classes }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('classesID')" class="mt-1" />
                        </div>

                        <!-- Section -->
                        <div class="space-y-2">
                            <label for="sectionID"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Sección') }}
                                <span class="text-red-500">*</span></label>
                            <select name="sectionID" id="sectionID" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                <option value="">{{ __('Seleccionar Sección...') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->sectionID }}"
                                        {{ old('sectionID') == $section->sectionID ? 'selected' : '' }}>
                                        {{ $section->section }} ({{ $section->class->classes ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sectionID')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100 dark:border-slate-700/30">

                <!-- Parent Information Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-heart-handshake text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Vínculo Familiar') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Parent -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="parentID"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Padre de Familia / Tutor') }}</label>
                            <select name="parentID" id="parentID"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                <option value="">{{ __('Sin Tutor Asignado...') }}</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->parentsID }}"
                                        {{ old('parentID') == $parent->parentsID ? 'selected' : '' }}>
                                        {{ $parent->name }} ({{ $parent->phone ?? 'Sin Teléfono' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parentID')" class="mt-1" />
                            <p class="text-[10px] text-slate-500 dark:text-slate-500 italic mt-1 ml-1 leading-relaxed">
                                <i class="ti ti-info-circle text-indigo-500/50 mr-1"></i>
                                {{ __('Seleccione al tutor responsable para habilitar el seguimiento académico desde el portal de padres.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Credentials Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-lock text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Credenciales de Acceso') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div class="space-y-2">
                            <label for="username"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Usuario') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Contraseña') }}
                                <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-700/30">

                <!-- Photo Upload -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-camera text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Fotografía del Estudiante') }}
                    </h3>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 overflow-hidden"
                            id="photo-preview-container">
                            <i class="ti ti-photo-plus text-3xl"></i>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-600/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-600/20 transition-all">
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-500">
                                {{ __('JPG, PNG o GIF. Tamaño máx. 2MB.') }}
                            </p>
                            <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-bold text-lg active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        <i class="ti ti-device-floppy text-2xl"></i>
                        {{ __('Registrar Estudiante') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Simple script for image preview -->
    <script>
        document.getElementById('photo').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const container = document.getElementById('photo-preview-container');
                container.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
                container.classList.remove('border-dashed');
                container.classList.add('border-solid', 'border-indigo-500/50');
            }
        }
    </script>
</x-app-layout>
