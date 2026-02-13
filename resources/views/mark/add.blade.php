<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-[95%] mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2">
                    <i class="ti ti-smart-home text-sm"></i>
                    {{ __('Dashboard') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('mark.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Calificaciones') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Registro Detallado') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Ingreso de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Notas') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500/30 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                            {{ __('Filtre por clase, sección, materia y examen para registrar calificaciones') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="mb-12 p-8 rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl">
            <form action="{{ route('mark.add') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-3">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Clase') }}</label>
                    <div class="relative">
                        <i
                            class="ti ti-school absolute left-4 top-1/2 -translate-y-1/2 text-emerald-500 pointer-events-none"></i>
                        <select name="classesID" onchange="this.form.submit()"
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">{{ __('Seleccionar...') }}</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Sección') }}</label>
                    <div class="relative">
                        <i
                            class="ti ti-section absolute left-4 top-1/2 -translate-y-1/2 text-emerald-500 pointer-events-none"></i>
                        <select name="sectionID" onchange="this.form.submit()"
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">{{ __('Seleccionar...') }}</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->sectionID }}"
                                    {{ $sectionID == $section->sectionID ? 'selected' : '' }}>
                                    {{ $section->section }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Materia') }}</label>
                    <div class="relative">
                        <i
                            class="ti ti-notebook absolute left-4 top-1/2 -translate-y-1/2 text-emerald-500 pointer-events-none"></i>
                        <select name="subjectID" onchange="this.form.submit()"
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">{{ __('Seleccionar...') }}</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subjectID }}"
                                    {{ $subjectID == $subject->subjectID ? 'selected' : '' }}>
                                    {{ $subject->subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Examen') }}</label>
                    <div class="relative">
                        <i
                            class="ti ti-file-certificate absolute left-4 top-1/2 -translate-y-1/2 text-emerald-500 pointer-events-none"></i>
                        <select name="examID" onchange="this.form.submit()"
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">{{ __('Seleccionar...') }}</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->examID }}" {{ $examID == $exam->examID ? 'selected' : '' }}>
                                    {{ $exam->exam }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        @if (isset($students) && count($students) > 0)
            <div
                class="overflow-hidden bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 rounded-[3rem] shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50/50 dark:bg-slate-900/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                <th
                                    class="p-8 min-w-[80px] text-center border-b border-r border-slate-100 dark:border-slate-800">
                                    #</th>
                                <th class="p-8 min-w-[300px] border-b border-r border-slate-100 dark:border-slate-800">
                                    {{ __('Estudiante') }}</th>
                                @foreach ($mark_percentages as $percentage)
                                    <th
                                        class="p-6 text-center border-b border-r border-slate-100 dark:border-slate-800 min-w-[150px]">
                                        <div class="flex flex-col items-center">
                                            <span>{{ $percentage->markpercentage }}</span>
                                            <span
                                                class="text-[9px] text-emerald-500 mt-1">({{ $percentage->markpercentage_numeric }}%)</span>
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                            @foreach ($students as $index => $student)
                                <tr class="group hover:bg-emerald-500/[0.02] transition-colors relative">
                                    <td
                                        class="p-8 text-center text-slate-400 font-black italic border-r border-slate-100 dark:border-slate-800">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="p-8 border-r border-slate-100 dark:border-slate-800">
                                        <div class="flex items-center gap-6">
                                            <div
                                                class="w-14 h-14 rounded-2xl bg-slate-100 dark:bg-slate-900 overflow-hidden ring-4 ring-slate-100 dark:ring-slate-800/50 transition-all group-hover:scale-105 group-hover:ring-emerald-500/20">
                                                <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div
                                                    class="text-sm font-black text-slate-700 dark:text-white uppercase italic tracking-tight group-hover:text-emerald-500 transition-colors">
                                                    {{ $student->name }}
                                                </div>
                                                <div class="flex items-center gap-3 mt-1.5">
                                                    <span
                                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 dark:bg-slate-900/50 px-2 py-0.5 rounded-full">
                                                        ROLL: {{ $student->roll }}
                                                    </span>
                                                    <span
                                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                                                        ID: {{ $student->studentID }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach ($mark_percentages as $percentage)
                                        <td class="p-6 border-r border-slate-100 dark:border-slate-800 group/cell">
                                            <div class="flex flex-col items-center gap-2">
                                                <input type="number" data-student="{{ $student->studentID }}"
                                                    data-percentage="{{ $percentage->markpercentageID }}"
                                                    value="{{ $student->mark_relations->get($percentage->markpercentageID) }}"
                                                    min="0" max="{{ $percentage->markpercentage_numeric }}"
                                                    class="mark-input w-24 text-center bg-slate-100 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl py-3 text-slate-900 dark:text-white font-black italic focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all placeholder-slate-300 dark:placeholder-slate-700 no-spinner"
                                                    placeholder="-">
                                                <span
                                                    class="text-[9px] text-rose-500 font-bold hidden error-{{ $percentage->markpercentageID }}-{{ $student->studentID }}">
                                                </span>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div class="fixed bottom-10 right-10 z-50">
                <button type="button" onclick="saveMarks()" id="saveBtn"
                    class="group px-10 py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] shadow-2xl shadow-emerald-600/30 font-black text-[11px] uppercase tracking-[0.2em] transition-all hover:scale-105 active:scale-95 flex items-center gap-4 overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                    <i class="ti ti-device-floppy text-xl"></i>
                    <span>{{ __('Guardar Calificaciones') }}</span>
                </button>
            </div>
        @elseif(request('classesID'))
            <div
                class="mt-12 py-32 text-center rounded-[4rem] border-4 border-dashed border-slate-100 dark:border-slate-800/30 bg-slate-50/30 dark:bg-slate-900/10">
                <div
                    class="w-32 h-32 bg-white dark:bg-slate-800 rounded-[3rem] flex items-center justify-center text-slate-200 dark:text-slate-700 mx-auto mb-8 shadow-inner">
                    <i class="ti ti-users text-6xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white uppercase tracking-tighter mb-3">
                    {{ __('Aún no se han encontrado estudiantes') }}</h3>
                <p
                    class="text-[11px] font-black text-slate-400 uppercase tracking-widest max-w-sm mx-auto leading-relaxed">
                    {{ __('Seleccione los filtros superiores para cargar la lista de estudiantes y registrar sus notas.') }}
                </p>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function saveMarks() {
                const btn = document.getElementById('saveBtn');
                const btnIcon = btn.querySelector('i');
                const btnText = btn.querySelector('span');
                const originalText = btnText.textContent;
                const originalIcon = btnIcon.className;

                const inputs = document.querySelectorAll('.mark-input');
                const data = [];

                // Clear previous error messages
                document.querySelectorAll('[class^="text-[9px] text-rose-500"]').forEach(el => el.classList.add('hidden'));

                inputs.forEach(input => {
                    if (input.value !== '') {
                        data.push({
                            mark: input.dataset.percentage + '-' + input.dataset.student,
                            value: input.value
                        });
                    }
                });

                if (data.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sin datos',
                        text: 'No ha ingresado ninguna calificación para guardar.',
                        confirmButtonColor: '#10b981',
                        background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                    });
                    return;
                }

                btn.disabled = true;
                btnText.textContent = "{{ __('Guardando...') }}";
                btnIcon.className = 'ti ti-loader animate-spin text-xl';
                btn.classList.add('opacity-80', 'cursor-not-allowed');

                fetch("{{ route('mark.save') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            examID: '{{ $examID }}',
                            classesID: '{{ $classesID }}',
                            sectionID: '{{ $sectionID }}',
                            subjectID: '{{ $subjectID }}',
                            inputs: data
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            btnText.textContent = "{{ __('¡Completado!') }}";
                            btnIcon.className = 'ti ti-check text-xl';
                            btn.classList.replace('bg-emerald-600', 'bg-blue-600');

                            Swal.fire({
                                icon: 'success',
                                title: '¡Perfecto!',
                                text: data.message,
                                confirmButtonColor: '#10b981',
                                background: document.documentElement.classList.contains('dark') ? '#1e293b' :
                                    '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                            });

                            setTimeout(() => {
                                btnText.textContent = originalText;
                                btnIcon.className = originalIcon;
                                btn.disabled = false;
                                btn.classList.remove('opacity-80', 'cursor-not-allowed');
                                btn.classList.replace('bg-blue-600', 'bg-emerald-600');
                            }, 3000);
                        } else {
                            if (data.errors) {
                                // Handled backend errors
                                Object.keys(data.errors).forEach(key => {
                                    // Parse key if it maps to specific inputs or general module
                                    const errorDiv = document.querySelector(`.error-${key}`);
                                    if (errorDiv) {
                                        errorDiv.textContent = data.errors[key][0];
                                        errorDiv.classList.remove('hidden');
                                    }
                                });
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Ocurrió un error inesperado.',
                                confirmButtonColor: '#10b981',
                                background: document.documentElement.classList.contains('dark') ? '#1e293b' :
                                    '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                            });

                            btn.disabled = false;
                            btnText.textContent = originalText;
                            btnIcon.className = originalIcon;
                            btn.classList.remove('opacity-80', 'cursor-not-allowed');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Red',
                            text: 'No se pudo conectar con el servidor.',
                            confirmButtonColor: '#10b981',
                            background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                            color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                        });
                        btn.disabled = false;
                        btnText.textContent = originalText;
                        btnIcon.className = originalIcon;
                        btn.classList.remove('opacity-80', 'cursor-not-allowed');
                    });
            }
        </script>
    @endpush

    <style>
        .no-spinner::-webkit-inner-spin-button,
        .no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-spinner {
            -moz-appearance: textfield;
        }
    </style>
</x-app-layout>
