<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                    {{ __('Nuevo Padre / Tutor') }}
                </h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">Registre un nuevo tutor legal para la vinculación con
                    estudiantes.</p>
            </div>
            <a href="{{ route('parents.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl transition-all border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                <i class="ti ti-arrow-left"></i>
                Volver
            </a>
        </div>

        <div
            class="p-8 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
            <form id="parents-form" action="{{ route('parents.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                <!-- Basic Info -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2 mb-6">
                        <i class="ti ti-user-plus text-sky-600 dark:text-sky-400 text-xl"></i>
                        Datos del Tutor
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-600 dark:text-slate-400">Nombre
                                Completo del Tutor
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                oninput="this.value = this.value.replace(/[0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div class="space-y-2">
                            <label for="dni" class="text-sm font-medium text-slate-600 dark:text-slate-400">DNI /
                                Documento <span class="text-red-500">*</span></label>
                            <input type="text" name="dni" id="dni" value="{{ old('dni') }}"
                                maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                            <x-input-error :messages="$errors->get('dni')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200 dark:border-slate-700/30">

                <!-- Family Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="father_name" class="text-sm font-medium text-slate-600 dark:text-slate-400">Nombre
                            del Padre <span class="text-red-500">*</span></label>
                        <input type="text" name="father_name" id="father_name" value="{{ old('father_name') }}"
                            oninput="this.value = this.value.replace(/[0-9]/g, '')"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('father_name')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="father_profession"
                            class="text-sm font-medium text-slate-600 dark:text-slate-400">Profesión del
                            Padre <span class="text-red-500">*</span></label>
                        <input type="text" name="father_profession" id="father_profession"
                            value="{{ old('father_profession') }}"
                            oninput="this.value = this.value.replace(/[0-9]/g, '')"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('father_profession')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="mother_name" class="text-sm font-medium text-slate-600 dark:text-slate-400">Nombre
                            de la Madre <span class="text-red-500">*</span></label>
                        <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name') }}"
                            oninput="this.value = this.value.replace(/[0-9]/g, '')"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('mother_name')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="mother_profession"
                            class="text-sm font-medium text-slate-600 dark:text-slate-400">Profesión de la
                            Madre <span class="text-red-500">*</span></label>
                        <input type="text" name="mother_profession" id="mother_profession"
                            value="{{ old('mother_profession') }}"
                            oninput="this.value = this.value.replace(/[0-9]/g, '')"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('mother_profession')" class="mt-1" />
                    </div>
                </div>

                <hr class="border-slate-200 dark:border-slate-700/30">

                <!-- Contact & Account -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-slate-600 dark:text-slate-400">Email de
                            Contacto <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="phone" class="text-sm font-medium text-slate-600 dark:text-slate-400">Teléfono
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="username" class="text-sm font-medium text-slate-600 dark:text-slate-400">Usuario
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('username')" class="mt-1" />
                    </div>
                    <div class="space-y-2">
                        <label for="password"
                            class="text-sm font-medium text-slate-600 dark:text-slate-400">Contraseña
                            <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="address" class="text-sm font-medium text-slate-600 dark:text-slate-400">Dirección
                        Domiciliaria <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-sky-500/50 focus:border-sky-500 transition-all">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>

                <!-- Photo -->
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 overflow-hidden shadow-inner bg-slate-50 dark:bg-slate-900/30"
                        id="photo-preview-container">
                        <i class="ti ti-camera-plus text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-sky-600/10 file:text-sky-400 hover:file:bg-sky-600/20 transition-all cursor-pointer">
                        <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-sky-600 hover:bg-sky-500 text-white rounded-2xl font-bold text-lg active:scale-[0.98] transition-all">
                    Registrar Tutor
                </button>
            </form>
        </div>

        @push('scripts')
            <script>
                document.getElementById('photo').onchange = evt => {
                    const [file] = evt.target.files
                    if (file) {
                        const container = document.getElementById('photo-preview-container');
                        container.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
                        container.classList.remove('border-dashed');
                        container.classList.add('border-solid', 'border-sky-500/50');
                    }
                }

                // Live validation logic
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('parents-form');
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
                            } else if (field.getAttribute('minlength') && val && val.length < parseInt(field
                                    .getAttribute('minlength'))) {
                                isValid = false;
                            } else if (field.getAttribute('maxlength') && val.length > parseInt(field
                                    .getAttribute('maxlength'))) {
                                // This shouldn't happen with numeric filter but good to have
                                isValid = true;
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
        @endpush
</x-app-layout>
