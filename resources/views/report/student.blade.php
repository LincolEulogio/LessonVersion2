<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('report.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-amber-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Expediente del
                        Estudiante</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Perfil completo y registros
                        académicos del alumno</p>
                </div>
            </div>

            @if ($student)
                <button onclick="window.print()"
                    class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg flex items-center gap-2">
                    <i class="ti ti-printer text-lg"></i> Imprimir Expediente
                </button>
            @endif
        </div>

        <!-- Filter Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-8 mb-8 shadow-sm print:hidden">
            <form action="{{ route('report.student') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                        Clase</label>
                    <select name="classesID" id="classesID" onchange="this.form.submit()" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        <option value="">Seleccione Clase</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                        Estudiante</label>
                    <select name="studentID" id="studentID" onchange="this.form.submit()" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        <option value="">Seleccione Alumno</option>
                        @foreach ($students as $s)
                            <option value="{{ $s->studentID }}" {{ $studentID == $s->studentID ? 'selected' : '' }}>
                                {{ $s->name }} (Roll: {{ $s->roll }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 px-8 py-3.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-amber-600/30">
                        Ver Expediente
                    </button>
                </div>
            </form>
        </div>

        @if ($student)
            <!-- Student Detail View -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Column: Primary Info -->
                <div class="lg:col-span-4 space-y-8">
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm text-center relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-32 bg-amber-500 dark:bg-amber-500/20"></div>

                        <div class="relative pt-12">
                            <div
                                class="w-40 h-40 rounded-[40px] border-8 border-white dark:border-slate-800 bg-slate-100 dark:bg-slate-900 mx-auto overflow-hidden shadow-2xl relative">
                                @if ($student->photo)
                                    <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                                        <i class="ti ti-user text-6xl"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute bottom-0 right-0 px-3 py-1 bg-amber-600 text-white text-[10px] font-black uppercase tracking-widest leading-none">
                                    #{{ str_pad($student->roll, 3, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>

                            <h2
                                class="mt-6 text-2xl font-black text-slate-900 dark:text-white capitalize tracking-tight leading-tight">
                                {{ $student->name }}</h2>
                            <p
                                class="text-xs font-black text-amber-600 dark:text-amber-400 uppercase tracking-widest mt-1">
                                {{ $student->studentID }}</p>

                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div
                                    class="p-4 rounded-3xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Grado</p>
                                    <p class="text-sm font-black text-slate-900 dark:text-white mt-1 uppercase">
                                        {{ $student->classes->classes }}</p>
                                </div>
                                <div
                                    class="p-4 rounded-3xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Sección
                                    </p>
                                    <p class="text-sm font-black text-slate-900 dark:text-white mt-1 uppercase">
                                        {{ $student->section->section }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info Card -->
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm">
                        <h4
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-8">
                            Información de contacto</h4>

                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                    <i class="ti ti-mail text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Correo
                                        Electrónico</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        {{ $student->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                    <i class="ti ti-phone text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Número
                                        Telefónico</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        {{ $student->phone ?? 'No registrado' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                    <i class="ti ti-map-pin text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dirección
                                        Domiliciaria</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        {{ $student->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Secondary Info -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Academic Summary -->
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm relative overflow-hidden">
                        <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative">
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Datos
                                    Biográficos</h4>
                                <div class="space-y-6">
                                    <div
                                        class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                        <span
                                            class="text-xs font-black text-slate-400 uppercase tracking-widest">Género</span>
                                        <span
                                            class="text-sm font-bold text-slate-900 dark:text-white uppercase">{{ $student->sex }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">F. de
                                            Nacimiento</span>
                                        <span
                                            class="text-sm font-bold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($student->dob)->format('d M, Y') }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                        <span
                                            class="text-xs font-black text-slate-400 uppercase tracking-widest">Religión</span>
                                        <span
                                            class="text-sm font-bold text-slate-900 dark:text-white capitalize">{{ $student->religion ?? 'N/A' }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Tipo
                                            de Sangre</span>
                                        <span
                                            class="text-sm text-rose-600 dark:text-rose-400 font-black">{{ $student->bloodgroup ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8">
                                    Información Familiar</h4>
                                @if ($student->parent)
                                    <div
                                        class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400">
                                            <i class="ti ti-users text-3xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                                                Padre / Tutor</p>
                                            <p
                                                class="text-sm font-black text-slate-900 dark:text-white tracking-tight uppercase">
                                                {{ $student->parent->name }}</p>
                                            <p class="text-xs font-bold text-amber-600 dark:text-amber-400 mt-0.5">
                                                {{ $student->parent->phone }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 text-center">
                                        <p class="text-xs font-black text-slate-400">No hay información de padres
                                            registrada.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Statistic View -->
                    <div
                        class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-10 shadow-sm">
                        <h4
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-10">
                            Resumen de Asistencia (Mes Actual)</h4>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div
                                class="p-8 rounded-[32px] bg-emerald-50 dark:bg-emerald-500/5 border border-emerald-100 dark:border-emerald-500/10 text-center">
                                <p
                                    class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest leading-none mb-3">
                                    Días Presente</p>
                                <p class="text-4xl font-black text-emerald-900 dark:text-emerald-300">22</p>
                            </div>
                            <div
                                class="p-8 rounded-[32px] bg-rose-50 dark:bg-rose-500/5 border border-rose-100 dark:border-rose-500/10 text-center">
                                <p
                                    class="text-[9px] font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest leading-none mb-3">
                                    Ausencias</p>
                                <p class="text-4xl font-black text-rose-900 dark:text-rose-300">02</p>
                            </div>
                            <div
                                class="p-8 rounded-[32px] bg-amber-50 dark:bg-amber-500/5 border border-amber-100 dark:border-amber-500/10 text-center">
                                <p
                                    class="text-[9px] font-black text-amber-600 dark:text-amber-400 uppercase tracking-widest leading-none mb-3">
                                    Retardos</p>
                                <p class="text-4xl font-black text-amber-900 dark:text-amber-300">01</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div
                class="bg-white dark:bg-slate-800/30 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-[40px] p-20 text-center">
                <div
                    class="w-24 h-24 rounded-[32px] bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 mx-auto mb-6 shadow-inner">
                    <i class="ti ti-address-book text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Buscar Estudiante</h3>
                <p class="text-slate-500 dark:text-slate-400 font-medium mt-2 max-w-sm mx-auto">Selecciona una clase y
                    un estudiante para visualizar su expediente completo de forma detallada.</p>
            </div>
        @endif
    </div>
</x-app-layout>
