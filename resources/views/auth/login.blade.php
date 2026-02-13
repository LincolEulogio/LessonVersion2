<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4 bg-slate-50 dark:bg-slate-900">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-indigo-600 shadow-xl shadow-indigo-600/20 mb-6">
                    <i class="ti ti-school text-4xl text-white"></i>
                </div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Bienvenido a Lesson</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium italic">Plataforma de Gestión Educativa</p>
            </div>

            <div
                class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700/50 rounded-[2.5rem] shadow-2xl p-8 md:p-10 backdrop-blur-xl">
                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-6 px-4 py-3 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold text-xs"
                    :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username -->
                    <div class="space-y-2">
                        <label for="username"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] pl-1">Usuario
                            / Registro</label>
                        <div class="relative group">
                            <i
                                class="ti ti-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-600 transition-colors text-xl"></i>
                            <input id="username" type="text" name="username" :value="old('username')" required
                                autofocus
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl py-4 pl-14 pr-5 text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 transition-all outline-none font-bold placeholder:text-slate-400/50"
                                placeholder="Ingresa tu nombre de usuario">
                        </div>
                        <x-input-error :messages="$errors->get('username')"
                            class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-wider" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between pl-1">
                            <label for="password"
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a class="text-[10px] font-black text-indigo-600 hover:text-indigo-500 uppercase tracking-wider transition-colors"
                                    href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <i
                                class="ti ti-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-600 transition-colors text-xl"></i>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password"
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl py-4 pl-14 pr-5 text-slate-700 dark:text-slate-200 focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 transition-all outline-none font-bold placeholder:text-slate-400/50"
                                placeholder="••••••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')"
                            class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-wider" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between px-1">
                        <label for="remember_me" class="flex items-center group cursor-pointer">
                            <div class="relative">
                                <input id="remember_me" type="checkbox" name="remember" class="peer hidden">
                                <div
                                    class="w-5 h-5 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-md peer-checked:bg-indigo-600 peer-checked:border-indigo-600 transition-all">
                                </div>
                                <i
                                    class="ti ti-check absolute inset-0 text-white text-[10px] flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span
                                class="ms-3 text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider group-hover:text-slate-700 dark:group-hover:text-slate-200 transition-colors">Recordar
                                sesión</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-600/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3 uppercase text-xs tracking-[0.2em]">
                            Acceder al Portal
                            <i class="ti ti-arrow-right text-lg"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Role Tags -->
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <span
                    class="px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest border border-slate-200/50 dark:border-slate-700/50">Administrador</span>
                <span
                    class="px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest border border-slate-200/50 dark:border-slate-700/50">Docente</span>
                <span
                    class="px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest border border-slate-200/50 dark:border-slate-700/50">Estudiante</span>
                <span
                    class="px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest border border-slate-200/50 dark:border-slate-700/50">Padre
                    de Familia</span>
            </div>

            <p
                class="mt-10 text-center text-slate-400 dark:text-slate-600 font-bold text-[9px] uppercase tracking-widest">
                &copy; {{ date('Y') }} Lesson v2. Todos los derechos reservados.
            </p>
        </div>
    </div>
</x-guest-layout>
