<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('user.index') }}"
                class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Detalles del Usuario</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-widest">
                    {{ \App\Models\Usertype::find($user->usertypeID)->usertype ?? 'Personal del Sistema' }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Primary Info -->
            <div class="lg:col-span-4 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm text-center relative overflow-hidden">
                    <div class="absolute top-0 inset-x-0 h-32 bg-indigo-600 dark:bg-indigo-900/40"></div>

                    <div class="relative pt-12">
                        <div
                            class="w-40 h-40 rounded-[40px] border-8 border-white dark:border-slate-800 bg-slate-100 dark:bg-slate-900 mx-auto overflow-hidden shadow-2xl relative">
                            @if ($user->photo && $user->photo != 'default.png')
                                <img src="{{ asset('storage/images/' . $user->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600 bg-slate-50 dark:bg-slate-900">
                                    <i class="ti ti-user text-6xl"></i>
                                </div>
                            @endif
                        </div>

                        <h2
                            class="mt-6 text-2xl font-black text-slate-900 dark:text-white capitalize tracking-tight leading-tight">
                            {{ $user->name }}</h2>
                        <div class="mt-2">
                            <span
                                class="px-4 py-1.5 rounded-full bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase tracking-widest">
                                {{ \App\Models\Usertype::find($user->usertypeID)->usertype ?? 'Usuario' }}
                            </span>
                        </div>

                        <div class="mt-8 flex justify-center gap-4">
                            <a href="{{ route('user.edit', $user->userID) }}"
                                class="px-6 py-2.5 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-[10px] uppercase tracking-widest shadow-lg transition-transform hover:scale-105 active:scale-95">
                                Editar Perfil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Contacto</h4>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-center text-slate-400 shrink-0">
                                <i class="ti ti-mail text-xl"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Correo</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate">
                                    {{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 flex items-center justify-center text-slate-400 shrink-0">
                                <i class="ti ti-phone text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Teléfono</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                    {{ $user->phone ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="lg:col-span-8 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10">Datos Generales
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-6">
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">DNI /
                                    CI</span>
                                <span
                                    class="text-sm font-bold text-slate-900 dark:text-white uppercase">{{ $user->dni }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Género</span>
                                <span
                                    class="text-sm font-bold text-slate-900 dark:text-white">{{ $user->sex }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span
                                    class="text-xs font-black text-slate-400 uppercase tracking-widest">Nacimiento</span>
                                <span
                                    class="text-sm font-bold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($user->dob)->format('d M, Y') }}</span>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Usuario</span>
                                <span
                                    class="text-sm text-indigo-600 dark:text-indigo-400 font-black">{{ $user->username }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Día de
                                    Ingreso</span>
                                <span
                                    class="text-sm font-bold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($user->jod)->format('d M, Y') }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Estado</span>
                                <span
                                    class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 text-[9px] font-black uppercase">Activo</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Dirección</p>
                        <div
                            class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-sm font-medium text-slate-600 dark:text-slate-400">
                            {{ $user->address ?? 'Dirección no registrada' }}
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl"></div>
                    <div class="flex items-center gap-4 relative">
                        <div
                            class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                            <i class="ti ti-shield-check text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                Privilegios y Acceso</h5>
                            <p class="text-xs font-bold text-slate-500 dark:text-slate-400 mt-0.5">Nivel de acceso
                                basado en el rol de
                                {{ \App\Models\Usertype::find($user->usertypeID)->usertype ?? 'Usuario' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
