<div
    class="flex flex-col h-full bg-white text-slate-600 dark:bg-[#0f172a] dark:text-slate-400 font-sans shadow-2xl border-r border-slate-200 dark:border-slate-800/50">
    <!-- Header Logo -->
    <div class="h-16 flex items-center px-6 border-b border-slate-200 dark:border-slate-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
            <div
                class="p-1.5 bg-indigo-500 rounded-lg group-hover:rotate-12 transition-transform shadow-lg shadow-indigo-500/20">
                <x-application-logo class="w-5 h-5 fill-current text-white" />
            </div>
            <span class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">Lesson</span>
        </a>
    </div>

    <!-- User Profile Section -->
    <a href="{{ route('profile.edit') }}"
        class="block p-5 border-b border-slate-200 dark:border-slate-800/50 bg-slate-50 dark:bg-slate-900/10 hover:bg-slate-100 dark:hover:bg-slate-800/30 transition-all group">
        <div class="flex items-center gap-3">
            <div class="relative flex-shrink-0">
                <div
                    class="w-10 h-10 rounded-full border border-indigo-500/50 p-0.5 overflow-hidden transition-transform group-hover:scale-110">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->username ?? Auth::user()->name }}"
                        alt="User" class="w-full h-full rounded-full bg-slate-800">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white dark:border-[#0f172a]">
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p
                    class="text-slate-900 dark:text-slate-200 font-black text-sm truncate uppercase tracking-widest leading-none">
                    {{ Auth::user()->name }}
                </p>
                <div
                    class="flex items-center gap-1.5 text-indigo-500 dark:text-indigo-400 text-xs font-black mt-1.5 uppercase tracking-tighter opacity-80 group-hover:opacity-100 transition-opacity">
                    <i class="ti ti-user-circle"></i>
                    <span>{{ __('Ver Perfil') }}</span>
                </div>
            </div>
            <i
                class="ti ti-chevron-right text-slate-300 dark:text-slate-600 text-xs transition-transform group-hover:translate-x-1"></i>
        </div>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden p-3 space-y-6 scrollbar-hide">
        <div class="space-y-0.5">
            <!-- Inicio -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-500 text-white shadow-indigo-500/20' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-smart-home text-lg {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Inicio') }}</span>
            </a>

            <!-- Estudiante -->
            <a href="{{ route('student.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('student.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-school text-lg {{ request()->routeIs('student.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Estudiante') }}</span>
            </a>

            <!-- Padres -->
            <a href="{{ route('parents.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('parents.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-users text-lg {{ request()->routeIs('parents.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Padres') }}</span>
            </a>

            <!-- Docente -->
            <a href="{{ route('teacher.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('teacher.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-user-bolt text-lg {{ request()->routeIs('teacher.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Docente') }}</span>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('user.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-user-circle text-lg {{ request()->routeIs('user.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Usuarios') }}</span>
            </a>

            <!-- Académico (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('classes.*') || request()->routeIs('section.*') || request()->routeIs('subject.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('academico*') ? 'text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-book-2 text-lg {{ request()->routeIs('classes.*') || request()->routeIs('section.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Académico') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('classes.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('classes.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-subtask text-base"></i> {{ __('Clase') }}
                    </a>
                    <a href="{{ route('topic.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('topic.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-stack-2 text-base"></i> {{ __('Tema') }}
                    </a>
                    <a href="{{ route('section.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('section.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-star text-base"></i> {{ __('Sección') }}
                    </a>
                    <a href="{{ route('syllabus.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('syllabus.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-folder text-base"></i> {{ __('Plan De Estudios') }}
                    </a>
                    <a href="{{ route('assignment.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('assignment.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-copy text-base"></i> {{ __('Asignación') }}
                    </a>
                    <a href="{{ route('routine.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('routine.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-clock-hour-4 text-base"></i> {{ __('Horarios') }}
                    </a>
                </div>
            </div>

            <!-- Asistencia (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('attendance.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('attendance*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-calendar-check text-lg {{ request()->routeIs('attendance.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Asistencia') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('attendance.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('attendance.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-check text-base"></i> {{ __('Asistencia Al Estudiante') }}
                    </a>
                    <a href="{{ route('tattendance.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('tattendance.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-cog text-base"></i> {{ __('Asistencia Del Docente') }}
                    </a>
                </div>
            </div>

            <!-- Examen (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('exam.*', 'grade.*', 'examschedule.*', 'exam_attendance.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('exam*', 'grade*', 'examschedule*', 'exam_attendance*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-file-certificate text-lg {{ request()->routeIs('exam.*', 'grade.*', 'examschedule.*', 'exam_attendance.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Examen') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('exam.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('exam.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-pencil text-base"></i> {{ __('Examen') }}
                    </a>
                    <a href="{{ route('examschedule.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('examschedule.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-calendar-event text-base"></i> {{ __('Horario Del Examen') }}
                    </a>
                    <a href="{{ route('grade.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('grade.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-chart-bar text-base"></i> {{ __('Grado') }}
                    </a>
                    <a href="{{ route('exam_attendance.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('exam_attendance.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-search text-base"></i> {{ __('Asistencia Al Examen') }}
                    </a>
                </div>
            </div>

            <!-- Calificación (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('mark.*', 'markpercentage.*', 'promotion.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('mark*', 'markpercentage*', 'promotion*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-report-analytics text-lg {{ request()->routeIs('mark.*', 'markpercentage.*', 'promotion.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-400' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Calificación') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('mark.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('mark.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-test-pipe text-base"></i> {{ __('Calificación') }}
                    </a>
                    <a href="{{ route('markpercentage.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('markpercentage.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-notebook text-base"></i> {{ __('Porcentaje De Calificación') }}
                    </a>
                    <a href="{{ route('promotion.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('promotion.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-trending-up text-base"></i> {{ __('Promoción') }}
                    </a>
                </div>
            </div>

            <!-- Conversación -->
            <a href="{{ route('conversation.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('conversation.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-messages text-lg {{ request()->routeIs('conversation.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Conversación') }}</span>
            </a>

            <!-- Compartir -->
            <a href="{{ route('media.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('media.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-share text-lg {{ request()->routeIs('media.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Compartir') }}</span>
            </a>

            <!-- Correo -->
            <a href="{{ route('mailandsms.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('mailandsms.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }}">
                <i
                    class="ti ti-mail text-lg {{ request()->routeIs('mailandsms.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Correo') }}</span>
            </a>

            <!-- Biblioteca (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('library.*') || request()->routeIs('book.*') || request()->routeIs('lmember.*') || request()->routeIs('issue.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('lmember*') || request()->is('book*') || request()->is('issue*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-books text-lg {{ request()->routeIs('library.*') || request()->is('lmember*') || request()->is('book*') || request()->is('issue*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Biblioteca') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('lmember.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('lmember.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user text-base"></i> {{ __('Miembro') }}
                    </a>
                    <a href="{{ route('book.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('book.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-book text-base"></i> {{ __('Libros') }}
                    </a>
                    <a href="{{ route('issue.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('issue.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-shopping-cart text-base"></i> {{ __('Prestamo') }}
                    </a>
                </div>
            </div>

            <!-- Transporte (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('transport.*') || request()->routeIs('tmember.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('transport*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-bus text-lg {{ request()->routeIs('transport.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Transporte') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('transport.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('transport.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-route text-base"></i> {{ __('Transporte') }}
                    </a>
                    <a href="{{ route('tmember.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('tmember.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user text-base"></i> {{ __('Miembro') }}
                    </a>
                </div>
            </div>

            <!-- Hospedaje (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('hostel.*') || request()->routeIs('category.*') || request()->routeIs('hmember.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('hostel*') || request()->is('category*') || request()->is('hmember*') ? 'text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-building-community text-lg {{ request()->routeIs('hostel.*') || request()->routeIs('category.*') || request()->routeIs('hmember.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Hospedaje') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('hostel.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('hostel.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-bed text-base"></i> {{ __('Hospedaje') }}
                    </a>
                    <a href="{{ route('category.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('category.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-leaf text-base"></i> {{ __('Categoría') }}
                    </a>
                    <a href="{{ route('hmember.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('hmember.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-shield text-base"></i> {{ __('Miembro') }}
                    </a>
                </div>
            </div>

            <!-- Facturación (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('feetypes.*') || request()->routeIs('invoice.*') || request()->routeIs('payment.*') || request()->routeIs('expense.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('feetypes*') || request()->is('invoice*') || request()->is('payment*') || request()->is('expense*') ? 'text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-wallet text-lg {{ request()->routeIs('feetypes.*') || request()->routeIs('invoice.*') || request()->routeIs('payment.*') || request()->routeIs('expense.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Facturación') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('feetypes.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('feetypes.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-coin text-base"></i> {{ __('Tipos De Tarifas') }}
                    </a>
                    <a href="{{ route('invoice.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('invoice.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-file-invoice text-base"></i> {{ __('Factura') }}
                    </a>
                    <a href="{{ route('payment.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('payment.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-history text-base"></i> {{ __('Pagos') }}
                    </a>
                    <a href="{{ route('expense.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('expense.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-users-group text-base"></i> {{ __('Gastos') }}
                    </a>
                </div>
            </div>

            <!-- Anuncio (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('notice.*') || request()->routeIs('event.*') || request()->routeIs('holiday.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('notice*') || request()->is('event*') || request()->is('holiday*') ? 'text-indigo-600 dark:text-indigo-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-speakerphone text-lg {{ request()->routeIs('notice.*') || request()->routeIs('event.*') || request()->routeIs('holiday.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Anuncio') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('notice.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('notice.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-speakerphone text-base"></i> {{ __('Noticias') }}
                    </a>
                    <a href="{{ route('event.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('event.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-calendar-event text-base"></i> {{ __('Evento') }}
                    </a>
                    <a href="{{ route('holiday.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('holiday.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-beach text-base"></i> {{ __('Vacaciones') }}
                    </a>
                </div>
            </div>

            <!-- Reportes (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('report.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('report*') ? 'text-amber-600 dark:text-amber-400' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-file-analytics text-lg {{ request()->routeIs('report.*') ? 'text-amber-600 dark:text-amber-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Reportes') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-amber-600 dark:text-amber-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('report.class') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('report.class') ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-report text-base"></i> {{ __('Informe De Clase') }}
                    </a>
                    <a href="{{ route('report.attendance') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('report.attendance') ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-report-medical text-base"></i> {{ __('Informe De Asistencia') }}
                    </a>
                    <a href="{{ route('report.student') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('report.student') ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-address-book text-base"></i> {{ __('Informe Del Estudiante') }}
                    </a>
                </div>
            </div>

            <!-- Administrador (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('schoolyear.*') || request()->routeIs('systemadmin.*') || request()->routeIs('usertype.*') || request()->routeIs('setting.*') || request()->routeIs('permission.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('schoolyear*') || request()->is('systemadmin*') || request()->is('usertype*') || request()->is('setting*') || request()->is('permission*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                    <div class="flex items-center gap-3">
                        <i
                            class="ti ti-settings-automation text-lg {{ request()->routeIs('schoolyear.*') || request()->routeIs('systemadmin.*') || request()->routeIs('usertype.*') || request()->routeIs('setting.*') || request()->routeIs('permission.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                        <span class="text-sm tracking-wide capitalize">{{ __('Administrador') }}</span>
                    </div>
                    <i class="ti ti-chevron-down text-xs transition-transform duration-300"
                        :class="open ? 'rotate-180 text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500'"></i>
                </button>
                <div x-show="open" x-collapse x-cloak class="mt-1 space-y-0.5">
                    <a href="{{ route('schoolyear.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('schoolyear.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-calendar-plus text-base"></i> {{ __('Año Académico') }}
                    </a>
                    <a href="{{ route('systemadmin.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('systemadmin.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-exclamation text-base"></i> {{ __('Administrador Del Sistema') }}
                    </a>
                    <a href="{{ route('usertype.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('usertype.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-user-cog text-base"></i> {{ __('Rol de Usuarios') }}
                    </a>
                    <a href="{{ route('permission.index') }}"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors {{ request()->routeIs('permission.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30' }}">
                        <i class="ti ti-shield-lock text-base"></i> {{ __('Permisos') }}
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 pl-10 py-2 text-sm rounded-lg hover:text-slate-900 dark:hover:text-white transition-colors text-slate-500 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/30 opacity-50 cursor-not-allowed">
                        <i class="ti ti-key text-base"></i> {{ __('Restablecer Contraseña') }}
                    </a>
                </div>
            </div>

            <!-- Ajustes Generales -->
            <a href="{{ route('setting.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('setting.*') ? 'text-indigo-600 dark:text-indigo-400 font-bold bg-slate-100 dark:bg-slate-800/50' : 'hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-slate-200' }} group">
                <i
                    class="ti ti-settings text-lg {{ request()->routeIs('setting.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500' }}"></i>
                <span class="text-sm tracking-wide capitalize">{{ __('Ajustes Generales') }}</span>
            </a>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
