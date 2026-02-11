<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <img src="{{ asset($parent->photo && $parent->photo != 'default.png' ? 'storage/images/' . $parent->photo : 'uploads/images/default.png') }}"
                    class="w-24 h-24 rounded-3xl object-cover border-4 border-slate-800 shadow-2xl"
                    alt="{{ $parent->name }}">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $parent->name }}</h1>
                    <div class="mt-2 flex items-center gap-3">
                        <span
                            class="px-3 py-1 bg-sky-600/20 text-sky-400 border border-sky-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                            Padre de Familia / Tutor
                        </span>
                        <span class="text-slate-500">•</span>
                        <span class="text-slate-400 text-sm italic">DNI: {{ $parent->dni }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('parents.edit', $parent->parentsID) }}"
                    class="p-3 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20"
                    title="Editar Perfil">
                    <i class="ti ti-edit text-xl"></i>
                </a>
                <a href="{{ route('parents.index') }}"
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50">
                    Volver
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Family Card -->
            <div class="space-y-6">
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-4">Información Familiar
                    </h3>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500">Padre</span>
                            <span class="text-slate-200 font-bold">{{ $parent->father_name ?? 'N/A' }}</span>
                            @if ($parent->father_profession)
                                <span class="text-[10px] text-sky-400 italic">{{ $parent->father_profession }}</span>
                            @endif
                        </div>
                        <div class="flex flex-col pt-2 border-t border-slate-700/30">
                            <span class="text-xs text-slate-500">Madre</span>
                            <span class="text-slate-200 font-bold">{{ $parent->mother_name ?? 'N/A' }}</span>
                            @if ($parent->mother_profession)
                                <span class="text-[10px] text-sky-400 italic">{{ $parent->mother_profession }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div
                    class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm space-y-4 shadow-xl">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Contacto</h3>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-sky-500/10 text-sky-400 rounded-xl group-hover:bg-sky-500 group-hover:text-white transition-all">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Email</span>
                            <span class="text-sm text-slate-200 truncate">{{ $parent->email ?? 'Sin correo' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div
                            class="p-2.5 bg-sky-500/10 text-sky-400 rounded-xl group-hover:bg-sky-500 group-hover:text-white transition-all">
                            <i class="ti ti-phone"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 uppercase font-bold">Teléfono</span>
                            <span class="text-sm text-slate-200">{{ $parent->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Profile -->
            <div class="md:col-span-2 space-y-8">
                <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-home-heart text-sky-400"></i>
                        Perfil de Tutor
                    </h2>
                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Nombre
                                Completo</span>
                            <span class="text-slate-200 mt-1 block font-semibold text-xl">{{ $parent->name }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Dirección
                                Registrada</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium leading-relaxed">{{ $parent->address ?? 'No hay dirección registrada.' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Students -->
                <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-school text-sky-400"></i>
                        Hijos / Estudiantes Vinculados
                    </h2>

                    @if ($parent->students->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($parent->students as $student)
                                <a href="{{ route('student.show', $student->studentID) }}"
                                    class="group p-4 bg-slate-900/50 border border-slate-700/50 rounded-2xl hover:border-sky-500/50 hover:bg-sky-500/5 transition-all flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-800 overflow-hidden border border-slate-700 flex-shrink-0">
                                        <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    </div>
                                    <div class="overflow-hidden">
                                        <h4
                                            class="text-slate-200 font-bold text-sm truncate group-hover:text-white transition-colors">
                                            {{ $student->name }}</h4>
                                        <div
                                            class="flex items-center gap-2 mt-0.5 text-[10px] text-slate-500 font-semibold uppercase tracking-wider">
                                            <span>Clase:</span>
                                            <span class="text-sky-400">{{ $student->classes->classes ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-auto text-slate-600 group-hover:text-sky-400 transition-colors">
                                        <i class="ti ti-chevron-right"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center space-y-3 opacity-60">
                            <div class="p-4 bg-slate-800 rounded-2xl text-slate-600">
                                <i class="ti ti-users-minus text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Sin
                                    estudiantes vinculados</p>
                                <p class="text-slate-600 text-xs mt-1">Este tutor no tiene estudiantes asignados para
                                    seguimiento.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
