<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">
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
            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
                novalidate>
                @csrf

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-user-circle text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Información Personal') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DNI -->
                        <div class="space-y-2">
                            <label for="dni"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('DNI / Documento') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="dni" id="dni" value="{{ old('dni') }}" required
                                maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('dni')" class="mt-1" />
                        </div>

                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Nombre Completo') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                oninput="this.value = this.value.replace(/[0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- DOB -->
                        <div class="space-y-2">
                            <label for="dob"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Fecha de Nacimiento') }}
                                <span class="text-red-500">*</span></label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required
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

                        <!-- Religion -->
                        <div class="space-y-2">
                            <label for="religion"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Religión') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="religion" id="religion" value="{{ old('religion') }}" required
                                oninput="this.value = this.value.replace(/[0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('religion')" class="mt-1" />
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Teléfono / Celular') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>
                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Correo Electrónico') }}
                                <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Address -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="address"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Dirección de Residencia') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="address" id="address" rows="2" required
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200 dark:border-slate-700/50 my-8">

                <!-- Academic Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-school text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Información Académica') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Roll Number -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="roll"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Número de Registro (Roll)') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="roll" id="roll" value="{{ old('roll') }}"
                                required oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('roll')" class="mt-1" />
                        </div>

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

                <hr class="border-slate-200 dark:border-slate-700/50 my-8">

                <!-- Parent Information Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-heart-handshake text-indigo-500 dark:text-indigo-400 text-xl"></i>
                        {{ __('Vínculo Familiar') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Parent -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="parentID"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Padre de Familia / Tutor') }}
                                <span class="text-red-500">*</span></label>
                            <select name="parentID" id="parentID" required
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

                <hr class="border-slate-200 dark:border-slate-700/50 my-8">

                <!-- Credentials Section -->
                <div class="space-y-6">
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
                                required minlength="8"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password"
                                class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __('Contraseña') }}
                                <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" required minlength="8"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200 dark:border-slate-700/50 my-8">

                <!-- Photo Upload -->
                <div class="space-y-6">
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

    <!-- Simple script for image preview and live validation -->
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

        // Live validation logic
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if (!form) return;

            const fields = form.querySelectorAll('input, select, textarea');

            fields.forEach(field => {
                const handler = () => {
                    const parentDiv = field.closest('.space-y-2');
                    if (!parentDiv) return;

                    const errorContainer = parentDiv.querySelector('ul, .text-red-600, .text-red-500');
                    if (!errorContainer) return;

                    // Basic validation check
                    let isValid = true;
                    const val = field.value.trim();

                    if (field.hasAttribute('required') && !val) {
                        isValid = false;
                    } else if (field.type === 'email' && val) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(val)) isValid = false;
                    } else if (field.getAttribute('minlength') && val.length < parseInt(field
                            .getAttribute('minlength'))) {
                        isValid = false;
                    }

                    if (isValid) {
                        errorContainer.classList.add('hidden');
                        field.classList.remove('border-red-500', 'ring-red-500/20');
                    } else {
                        // Keep error visible if still invalid
                        errorContainer.classList.remove('hidden');
                    }
                };

                field.addEventListener('input', handler);
                field.addEventListener('change', handler);
            });
        });
    </script>
</x-app-layout>
