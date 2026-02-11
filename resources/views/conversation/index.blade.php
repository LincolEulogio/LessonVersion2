<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-[95%] mx-auto">
        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center text-pink-400 border border-pink-500/20">
                    <i class="ti ti-messages text-xl"></i>
                </span>
                Mensajes
            </h1>
            <a href="{{ route('conversation.create') }}"
                class="px-6 py-3 bg-pink-600 hover:bg-pink-500 text-white rounded-xl shadow-lg shadow-pink-600/30 font-bold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus"></i>
                Redactar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1 space-y-4">
                <div class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-2xl p-4 shadow-xl">
                    <nav class="space-y-2">
                        <a href="{{ route('conversation.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ $active === 'inbox' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/20' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                            <i class="ti ti-inbox text-lg"></i>
                            <span class="font-bold">Bandeja de Entrada</span>
                            @if (isset($unread_count) && $unread_count > 0)
                                <span
                                    class="ml-auto bg-pink-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unread_count }}</span>
                            @endif
                        </a>
                        <a href="{{ route('conversation.sent') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ $active === 'sent' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/20' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                            <i class="ti ti-send text-lg"></i>
                            <span class="font-bold">Enviados</span>
                        </a>
                        <a href="{{ route('conversation.draft') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ $active === 'draft' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/20' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                            <i class="ti ti-file-text text-lg"></i>
                            <span class="font-bold">Borradores</span>
                        </a>
                        <a href="{{ route('conversation.trash') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ $active === 'trash' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/20' : 'text-slate-400 hover:bg-slate-700/50 hover:text-white' }}">
                            <i class="ti ti-trash text-lg"></i>
                            <span class="font-bold">Papelera</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Message List -->
            <div class="lg:col-span-3">
                <div
                    class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-2xl shadow-xl overflow-hidden min-h-[600px]">
                    @if (count($conversations) > 0)
                        <div class="divide-y divide-slate-700/50">
                            @foreach ($conversations as $conversation)
                                <a href="{{ route('conversation.view', $conversation->id ?? $conversation->conversation_id) }}"
                                    class="block p-5 hover:bg-slate-700/30 transition-colors group relative">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-12 h-12 rounded-full bg-slate-700 flex items-center justify-center text-slate-400 flex-shrink-0 group-hover:bg-pink-500/20 group-hover:text-pink-400 transition-colors">
                                                <span
                                                    class="font-black text-lg">{{ substr($conversation->sender_name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h3
                                                        class="font-bold text-white text-lg group-hover:text-pink-400 transition-colors">
                                                        {{ $conversation->sender_name ?? 'Desconocido' }}
                                                    </h3>
                                                    @if (isset($conversation->attach) && $conversation->attach)
                                                        <i
                                                            class="ti ti-paperclip text-slate-500 transform rotate-45"></i>
                                                    @endif
                                                </div>
                                                <h4 class="font-semibold text-slate-300 mb-1">
                                                    {{ $conversation->subject }}</h4>
                                                <p class="text-slate-500 text-sm line-clamp-1">
                                                    {{ strip_tags($conversation->msg) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end gap-2">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                                {{ \Carbon\Carbon::parse($conversation->msg_date ?? $conversation->create_date)->diffForHumans() }}
                                            </span>
                                            @if (isset($conversation->fav_status) && $conversation->fav_status)
                                                <i class="ti ti-star-filled text-yellow-400"></i>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-[600px] text-center p-8">
                            <div
                                class="w-24 h-24 rounded-full bg-slate-800 flex items-center justify-center text-slate-600 mb-6">
                                <i class="ti ti-mail-off text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No hay mensajes</h3>
                            <p class="text-slate-500 max-w-sm">No se encontraron conversaciones en esta carpeta.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
