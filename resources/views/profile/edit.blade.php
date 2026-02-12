<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center gap-4">
            <div
                class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none">
                <i class="ti ti-user-circle text-3xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Mi Perfil</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestiona tu información personal y
                    seguridad de la cuenta</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Quick Info -->
            <div class="lg:col-span-4 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm text-center relative overflow-hidden">
                    <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-br from-indigo-600 to-purple-700"></div>

                    <div class="relative pt-12">
                        <div
                            class="w-32 h-32 rounded-[32px] border-8 border-white dark:border-slate-800 bg-slate-100 dark:bg-slate-900 mx-auto overflow-hidden shadow-2xl flex items-center justify-center">
                            <span class="text-4xl font-black text-indigo-600 dark:text-indigo-400 uppercase">
                                {{ substr($user->name, 0, 2) }}
                            </span>
                        </div>

                        <h2
                            class="mt-6 text-2xl font-black text-slate-900 dark:text-white capitalize tracking-tight leading-tight">
                            {{ $user->name }}
                        </h2>
                        <p
                            class="text-xs font-black text-slate-400 uppercase tracking-widest mt-2 px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-900 inline-block">
                            {{ $user->username ?? 'Usuario del Sistema' }}
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Navegación</h4>
                    <nav class="space-y-2">
                        <a href="#profile-info"
                            class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold text-sm transition-all">
                            <i class="ti ti-info-circle text-lg"></i> Información General
                        </a>
                        <a href="#update-password"
                            class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 font-bold text-sm transition-all text-left">
                            <i class="ti ti-lock text-lg"></i> Cambiar Contraseña
                        </a>
                        <a href="#delete-account"
                            class="flex items-center gap-3 px-4 py-3 rounded-2xl text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 font-bold text-sm transition-all">
                            <i class="ti ti-trash text-lg"></i> Eliminar Cuenta
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Right: Forms -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Profile Information -->
                <div id="profile-info"
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                            Información de la Cuenta</h3>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">Actualiza tu nombre y
                            dirección de correo electrónico.</p>
                    </div>

                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div id="update-password"
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                            Actualizar Contraseña</h3>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">Asegúrate de usar una
                            contraseña larga y aleatoria para mantener la seguridad.</p>
                    </div>

                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div id="delete-account"
                    class="bg-rose-500/5 border border-rose-500/10 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                    <div class="mb-10">
                        <h3 class="text-xl font-black text-rose-600 dark:text-rose-400 uppercase tracking-tight">Zona de
                            Riesgo</h3>
                        <p class="text-sm font-medium text-rose-500/70 mt-1">Una vez que se elimine tu cuenta, todos sus
                            recursos y datos se borrarán permanentemente.</p>
                    </div>

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .form-input {
            @apply w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none !important;
        }

        .form-label {
            @apply block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-4 !important;
        }
    </style>
</x-app-layout>
