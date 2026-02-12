<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-slate-200 dark:border-amber-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-file-analytics text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Centro de Informes
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Genera reportes detallados y
                        análisis de datos escolares</p>
                </div>
            </div>
        </div>

        <!-- Report Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Class Report -->
            <a href="{{ route('report.class') }}"
                class="group relative bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                <div
                    class="absolute -top-12 -right-12 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors">
                </div>

                <div
                    class="w-16 h-16 rounded-[24px] bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-8 group-hover:scale-110 transition-transform duration-500">
                    <i class="ti ti-report text-3xl"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight mb-3">Informe de Clase</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed mb-8">
                    Listado completo de estudiantes por clase y sección, ideal para registros administrativos y control
                    de aula.
                </p>

                <div
                    class="flex items-center gap-2 text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                    Generar Reporte <i
                        class="ti ti-arrow-right text-base group-hover:translate-x-2 transition-transform"></i>
                </div>
            </a>

            <!-- Attendance Report -->
            <a href="{{ route('report.attendance') }}"
                class="group relative bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                <div
                    class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-colors">
                </div>

                <div
                    class="w-16 h-16 rounded-[24px] bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-8 group-hover:scale-110 transition-transform duration-500">
                    <i class="ti ti-report-medical text-3xl"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight mb-3">Informe de Asistencia
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed mb-8">
                    Visualiza estadísticas y registros diarios o por materia. Control de puntualidad y ausentismo
                    escolar.
                </p>

                <div
                    class="flex items-center gap-2 text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">
                    Ver Estadísticas <i
                        class="ti ti-arrow-right text-base group-hover:translate-x-2 transition-transform"></i>
                </div>
            </a>

            <!-- Student Report -->
            <a href="{{ route('report.student') }}"
                class="group relative bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] p-8 shadow-sm hover:shadow-2xl hover:shadow-amber-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                <div
                    class="absolute -top-12 -right-12 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl group-hover:bg-amber-500/10 transition-colors">
                </div>

                <div
                    class="w-16 h-16 rounded-[24px] bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-8 group-hover:scale-110 transition-transform duration-500">
                    <i class="ti ti-address-book text-3xl"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight mb-3">Perfil del Estudiante
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed mb-8">
                    Expediente completo del alumno: datos personales, familiares, académicos y de salud en un solo
                    documento.
                </p>

                <div
                    class="flex items-center gap-2 text-[10px] font-black text-amber-600 dark:text-amber-400 uppercase tracking-widest">
                    Consultar Perfil <i
                        class="ti ti-arrow-right text-base group-hover:translate-x-2 transition-transform"></i>
                </div>
            </a>
        </div>

        <!-- System Summary Section (Visual Only) -->
        <div class="mt-16 bg-slate-900 dark:bg-slate-800/50 rounded-[50px] p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-linear-to-l from-indigo-500/20 to-transparent"></div>

            <div class="max-w-2xl relative">
                <h2 class="text-4xl font-black text-white tracking-tight mb-6">Análisis Predictivo y Reportes Avanzados
                </h2>
                <p class="text-slate-400 text-lg font-medium leading-relaxed mb-10">
                    Nuestros informes están diseñados para brindarte una visión clara de la salud institucional. Filtra,
                    personaliza y exporta tus datos en formatos profesionales.
                </p>
                <div class="flex items-center gap-8">
                    <div>
                        <p class="text-3xl font-black text-white leading-none">100%</p>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-2">Personalizable
                        </p>
                    </div>
                    <div class="w-px h-12 bg-slate-700"></div>
                    <div>
                        <p class="text-3xl font-black text-white leading-none">PDF/Excel</p>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-2">Exportación</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
