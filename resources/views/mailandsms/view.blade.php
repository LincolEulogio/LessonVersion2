<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('mailandsms.index') }}"
                class="inline-flex items-center text-slate-400 hover:text-white transition-colors mb-4">
                <i class="ti ti-arrow-left mr-2"></i>
                Volver al historial
            </a>
            <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-400 border border-yellow-500/20">
                    <i class="ti ti-file-text text-xl"></i>
                </span>
                Detalles del Mensaje
            </h1>
        </div>

        <div class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
            <div class="grid grid-cols-2 gap-6 mb-8 border-b border-slate-700/50 pb-8">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-1">Tipo</span>
                    <span class="font-bold text-white uppercase">{{ $message->type }}</span>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-1">Fecha</span>
                    <span
                        class="font-bold text-white">{{ \Carbon\Carbon::parse($message->create_date)->format('d M, Y h:i A') }}</span>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-1">Grupo
                        Destino</span>
                    <span class="font-bold text-white bg-slate-700 px-2 py-1 rounded text-sm">
                        @if ($message->usertypeID == 0 || $message->usertypeID == 'all')
                            Todos
                        @else
                            ID: {{ $message->usertypeID }} (Necesita Mapping)
                        @endif
                    </span>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-1">Usuario
                        ID</span>
                    <span class="font-bold text-white">{{ $message->user_id }}</span>
                </div>
            </div>

            <div>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-3">Contenido del
                    Mensaje</span>
                <div
                    class="bg-slate-900/50 p-6 rounded-2xl border border-slate-700/50 text-slate-200 leading-relaxed font-mono text-sm">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
