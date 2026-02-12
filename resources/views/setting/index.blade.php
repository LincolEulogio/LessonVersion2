<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-500/10 flex items-center justify-center text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-settings text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Ajustes Generales
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Configura la identidad y
                        funcionamiento del sistema</p>
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

        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf

            <!-- Left Column: Branding -->
            <div class="lg:col-span-4 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Marca y Logotipo
                    </h4>

                    <div class="space-y-8">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Logo
                                Institucional</p>
                            <div class="relative group">
                                <div
                                    class="w-full h-48 rounded-[32px] bg-slate-50 dark:bg-slate-900 border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden">
                                    @if ($site->logo)
                                        <img src="{{ asset('uploads/images/' . $site->logo) }}"
                                            class="max-h-32 object-contain">
                                    @else
                                        <i class="ti ti-photo-plus text-4xl text-slate-300"></i>
                                    @endif
                                </div>
                                <input type="file" name="logo" class="absolute inset-0 opacity-0 cursor-pointer">
                                <div
                                    class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center rounded-[32px] pointer-events-none">
                                    <p class="text-white text-[10px] font-black uppercase tracking-widest">Cambiar Logo
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Favicon
                                (32x32)</p>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center p-2">
                                    @if ($site->favicon)
                                        <img src="{{ asset('uploads/images/' . $site->favicon) }}"
                                            class="w-full h-full object-contain">
                                    @else
                                        <i class="ti ti-world text-2xl text-slate-300"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="favicon"
                                        class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Preferencias del
                        Sistema</h4>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <x-form.label for="language">Idioma Predeterminado</x-form.label>
                            <select name="language" id="language"
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold">
                                <option value="spanish" {{ $site->language == 'spanish' ? 'selected' : '' }}>Español
                                </option>
                                <option value="english" {{ $site->language == 'english' ? 'selected' : '' }}>English
                                </option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <x-form.label for="attendance">Modo de Asistencia</x-form.label>
                            <select name="attendance" id="attendance"
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold">
                                <option value="daily"
                                    {{ ($settings['attendance'] ?? 'daily') == 'daily' ? 'selected' : '' }}>Diaria (Por
                                    Día)</option>
                                <option value="subject"
                                    {{ ($settings['attendance'] ?? 'daily') == 'subject' ? 'selected' : '' }}>Por
                                    Materia (Horario)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Institutional Info -->
            <div class="lg:col-span-8 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10">Información
                        Institucional</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-2">
                            <x-form.label for="title">Nombre de la Institución</x-form.label>
                            <x-form.input name="title" id="title" value="{{ $site->title }}" required />
                        </div>
                        <div class="space-y-2">
                            <x-form.label for="tagline">Lema / Eslogan</x-form.label>
                            <x-form.input name="tagline" id="tagline" value="{{ $site->tagline }}" />
                        </div>
                        <div class="space-y-2">
                            <x-form.label for="email">Correo Oficial</x-form.label>
                            <x-form.input type="email" name="email" id="email" value="{{ $site->email }}" />
                        </div>
                        <div class="space-y-2">
                            <x-form.label for="phone">Teléfono de Contacto</x-form.label>
                            <x-form.input name="phone" id="phone" value="{{ $site->phone }}" />
                        </div>
                    </div>

                    <div class="space-y-2 mb-8">
                        <x-form.label for="address">Dirección Física</x-form.label>
                        <x-form.textarea name="address" id="address"
                            rows="3">{{ $site->address }}</x-form.textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-form.label for="currency_code">Código de Moneda (ISO)</x-form.label>
                            <x-form.input name="currency_code" id="currency_code" value="{{ $site->currency_code }}"
                                placeholder="USD, EUR, MXN..." />
                        </div>
                        <div class="space-y-2">
                            <x-form.label for="currency_symbol">Símbolo Monetario</x-form.label>
                            <x-form.input name="currency_symbol" id="currency_symbol"
                                value="{{ $site->currency_symbol }}" placeholder="$, €, £..." />
                        </div>
                    </div>
                </div>

                <!-- Web settings -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm text-right">
                    <button type="submit"
                        class="px-12 py-5 rounded-[24px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-[0.2em] transition-all shadow-2xl hover:scale-105 active:scale-95">
                        Actualizar Configuración
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
