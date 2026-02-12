<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-user-cog text-indigo-500"></i>
                    Asistencia del Docente
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Control mensual de puntualidad y
                    asistencia facultativa.</p>
            </div>
            <a href="{{ route('tattendance.add') }}"
                class="inline-flex items-center gap-3 px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-[2rem] transition-all transform hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-indigo-500/30">
                <i class="ti ti-calendar-plus text-xl"></i>
                Registrar Asistencia
            </a>
        </div>

        <!-- Quick Info Card -->
        <div
            class="mb-10 p-8 rounded-[2.5rem] bg-indigo-600 shadow-2xl shadow-indigo-500/20 text-white overflow-hidden relative group">
            <div
                class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700">
            </div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 rounded-3xl bg-white/20 backdrop-blur-md flex items-center justify-center">
                        <i class="ti ti-clock-hour-4 text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black tracking-tight">Registro Maestro</h2>
                        <p class="text-indigo-100 font-medium">Sistema de control para el personal administrativo y
                            docente.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="px-5 py-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                        <span class="block text-[9px] font-black uppercase tracking-widest text-indigo-200">Fecha
                            Actual</span>
                        <span class="text-lg font-bold">{{ date('d F, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Table -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 shadow-sm overflow-hidden backdrop-blur-xl">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-widest text-xs">Lista de
                    Personal</h3>
                <span
                    class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                    {{ $teachers->count() }} Docentes
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/40">
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                #</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Docente</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Designación</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Estado Semanal</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-700/30">
                        @foreach ($teachers as $teacher)
                            <tr
                                class="group hover:bg-slate-50/50 dark:hover:bg-indigo-500/5 transition-all duration-300">
                                <td class="px-8 py-6 text-slate-400 font-mono text-sm leading-none">
                                    {{ $loop->iteration }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 overflow-hidden group-hover:scale-110 transition-transform shadow-inner">
                                            <img src="{{ asset($teacher->photo ? 'storage/images/' . $teacher->photo : 'uploads/images/default.png') }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div
                                                class="font-black text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 transition-colors uppercase tracking-tight">
                                                {{ $teacher->name }}</div>
                                            <div
                                                class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">
                                                DNI: {{ $teacher->dni }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                                        {{ $teacher->designation }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-1.5 focus:outline-none cursor-default">
                                        @for ($i = 0; $i < 6; $i++)
                                            <div class="w-2 h-4 rounded-sm bg-slate-200 dark:bg-slate-700/50"></div>
                                        @endfor
                                        <span
                                            class="text-[9px] text-slate-400 font-bold ml-2 uppercase tracking-widest">Pendiente</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('tattendance.show', $teacher->teacherID) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500/10 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded-xl transition-all text-xs font-bold uppercase tracking-widest group">
                                        <i class="ti ti-eye text-base group-hover:rotate-12 transition-transform"></i>
                                        Reporte
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
