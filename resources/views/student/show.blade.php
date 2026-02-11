<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <img src="{{ $student->photo ? asset('uploads/images/' . $student->photo) : asset('uploads/images/default.png') }}"
                    class="w-24 h-24 rounded-3xl object-cover border-4 border-slate-800 shadow-2xl"
                    alt="{{ $student->name }}">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $student->name }}</h1>
                    <div class="mt-2 flex items-center gap-3">
                        <span
                            class="px-3 py-1 bg-indigo-600/20 text-indigo-400 border border-indigo-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                            {{ $student->classes->classes ?? 'N/A' }}
                        </span>
                        <span class="text-slate-500">•</span>
                        <span class="text-slate-400 text-sm">Sección: {{ $student->section->section ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('student.edit', $student->studentID) }}"
                    class="p-3 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20">
                    <i class="ti ti-edit text-xl"></i>
                </a>
                <a href="{{ route('student.index') }}"
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50">
                    Volver
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left: Stats/Quick Info -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-4">Estado de Cuenta</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-200 font-medium">Asistencia Promedio</span>
                        <span class="text-green-400 font-bold">94%</span>
                    </div>
                    <div class="mt-4 w-full bg-slate-700/30 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Contacto Directo</h3>
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-500/10 text-indigo-400 rounded-lg">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500">Email</span>
                            <span class="text-sm text-slate-200 break-all">{{ $student->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-lg">
                            <i class="ti ti-phone"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500">Teléfono</span>
                            <span class="text-sm text-slate-200">{{ $student->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Detailed Tabs/Info -->
            <div class="md:col-span-2 space-y-8">
                <!-- General Info -->
                <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-2">
                        <i class="ti ti-info-circle text-indigo-400"></i>
                        Detalles del Estudiante
                    </h2>
                    <div class="grid grid-cols-2 gap-y-6 gap-x-12">
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Nombre
                                Completo</span>
                            <span class="text-slate-200 mt-1 block font-medium">{{ $student->name }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Usuario</span>
                            <span class="text-slate-200 mt-1 block font-medium">{{ $student->username }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Fecha de
                                Nacimiento</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d \d\e F, Y') : 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Género</span>
                            <span class="text-slate-200 mt-1 block font-medium">{{ $student->sex }}</span>
                        </div>
                        <div class="col-span-2">
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Dirección</span>
                            <span
                                class="text-slate-200 mt-1 block font-medium">{{ $student->address ?? 'No registrada' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Parents/Guardian Info -->
                <div class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-2">
                        <i class="ti ti-users text-indigo-400"></i>
                        Información del Padre / Tutor
                    </h2>
                    @if ($student->parent)
                        <div class="flex items-center gap-6 mb-6">
                            <img src="{{ $student->parent->photo ? asset('uploads/images/' . $student->parent->photo) : asset('uploads/images/default.png') }}"
                                class="w-16 h-16 rounded-2xl object-cover border-2 border-slate-700"
                                alt="{{ $student->parent->name }}">
                            <div>
                                <h4 class="text-lg font-bold text-slate-100">{{ $student->parent->name }}</h4>
                                <p class="text-sm text-slate-400">Padre / Tutor Legal</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-y-6 gap-x-12">
                            <div>
                                <span
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Padre</span>
                                <span
                                    class="text-slate-200 mt-1 block font-medium">{{ $student->parent->father_name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Madre</span>
                                <span
                                    class="text-slate-200 mt-1 block font-medium">{{ $student->parent->mother_name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Teléfono
                                    Tutor</span>
                                <span
                                    class="text-slate-200 mt-1 block font-medium">{{ $student->parent->phone ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Email
                                    Tutor</span>
                                <span
                                    class="text-slate-200 mt-1 block font-medium">{{ $student->parent->email ?? 'N/A' }}</span>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex items-center gap-3 p-4 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-2xl">
                            <i class="ti ti-alert-triangle text-xl"></i>
                            <p class="text-sm font-medium">No hay información de padres/tutores asignada a este
                                estudiante.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
