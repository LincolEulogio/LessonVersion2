<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-3 text-slate-400 mb-3">
                    <a href="{{ route('topic.index') }}" class="hover:text-emerald-500 transition-colors">
                        <i class="ti ti-books text-lg"></i>
                    </a>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Temas') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Detalles') }}</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Detalles del Tema') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1 uppercase tracking-tighter">
                    {{ __('Información completa del contenido académico') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('topic.edit', $topic->topicID) }}"
                    class="group flex items-center gap-3 px-6 py-4 bg-amber-500 hover:bg-amber-400 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-edit text-xl"></i>
                    {{ __('Editar') }}
                </a>
                <button type="button" onclick="window.location.href='{{ route('topic.index') }}'"
                    class="group flex items-center gap-3 px-6 py-4 bg-slate-600 hover:bg-slate-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-arrow-left text-xl"></i>
                    {{ __('Volver') }}
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Main Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Content Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden transition-all">
                    <div class="p-8 md:p-12 space-y-8">
                        <div>
                            <h2 class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-4">
                                {{ __('Título del Tema') }}
                            </h2>
                            <h3 class="text-3xl font-black text-slate-900 dark:text-white leading-tight">
                                {{ $topic->title }}
                            </h3>
                        </div>

                        <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>

                        <div>
                            <h2 class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-4">
                                {{ __('Descripción Detallada') }}
                            </h2>
                            <div class="prose dark:prose-invert max-w-none">
                                <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed italic">
                                    "{{ $topic->description }}"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sidebar Info -->
            <div class="space-y-8">
                <!-- Context Card -->
                <div
                    class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden p-8">
                    <h2
                        class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-8">
                        {{ __('Contexto Académico') }}
                    </h2>

                    <div class="space-y-8">
                        <!-- Class -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 shrink-0">
                                <i class="ti ti-school text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                    {{ __('Clase / Grado') }}</p>
                                <p class="text-base font-black text-slate-800 dark:text-white">
                                    {{ $topic->classes->classes ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 shrink-0">
                                <i class="ti ti-book text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                    {{ __('Materia') }}</p>
                                <p class="text-base font-black text-slate-800 dark:text-white">
                                    {{ $topic->subject->subject ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Numeric Value (From Class if available) -->
                        @if (isset($topic->classes->classes_numeric))
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 shrink-0">
                                    <i class="ti ti-hash text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                        {{ __('Valor Numérico') }}</p>
                                    <p class="text-base font-black text-slate-800 dark:text-white">
                                        {{ $topic->classes->classes_numeric }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Registration info -->
                <div
                    class="bg-slate-50 dark:bg-slate-900/50 rounded-[32px] p-6 border border-slate-100 dark:border-slate-700/30">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        <h4 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">
                            {{ __('Registro de Sistema') }}</h4>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-xs">
                            <span
                                class="text-slate-400 font-bold uppercase tracking-tighter">{{ __('ID Registro') }}</span>
                            <span
                                class="font-black text-slate-700 dark:text-slate-200">#{{ sprintf('%04d', $topic->topicID) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span
                                class="text-slate-400 font-bold uppercase tracking-tighter">{{ __('Fecha') }}</span>
                            <span
                                class="font-black text-slate-700 dark:text-slate-200">{{ $topic->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden Delete Form -->
        <form id="delete-form-{{ $topic->topicID }}" action="{{ route('topic.destroy', $topic->topicID) }}"
            method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <script>
        function confirmDelete(id, title) {
            Swal.fire({
                title: '¿ELIMINAR TEMA?',
                text: `Vas a borrar "${title}". Esta acción es definitiva y el tema ya no estará disponible en el plan de estudios.`,
                icon: 'warning',
                iconColor: '#f43f5e',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'SÍ, BORRAR TEMA',
                cancelButtonText: 'CANCELAR',
                background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                borderRadius: '40px',
                customClass: {
                    popup: 'border border-slate-200 dark:border-slate-700 shadow-2xl backdrop-blur-xl',
                    title: 'text-2xl font-black tracking-tight mt-4',
                    htmlContainer: 'text-sm font-medium leading-relaxed opacity-70',
                    confirmButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] transition-all hover:scale-105 active:scale-95 m-2',
                    cancelButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] m-2 transition-all hover:scale-105 active:scale-95'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
