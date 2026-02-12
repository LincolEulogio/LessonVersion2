<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('conversation.index') }}"
                class="inline-flex items-center text-slate-400 dark:text-slate-500 hover:text-pink-600 dark:hover:text-white transition-colors font-bold text-sm">
                <i class="ti ti-arrow-left mr-2"></i>
                Volver a la bandeja
            </a>

            <div class="flex items-center gap-3">
                <form action="{{ route('conversation.delete', $conversation->id) }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de querer eliminar esta conversación?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 hover:bg-rose-500/10 dark:hover:bg-red-500/20 hover:text-rose-600 dark:hover:text-red-400 hover:border-rose-500/30 border border-slate-200 dark:border-transparent transition-all shadow-sm dark:shadow-none"
                        title="Eliminar">
                        <i class="ti ti-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Conversation Thread -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden mb-8">
            <!-- Initial Message -->
            <div class="p-8 border-b border-slate-100 dark:border-slate-700/50">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <h1 class="text-2xl font-black text-slate-800 dark:text-white leading-tight">
                        {{ $conversation->subject ?? 'Sin Asunto' }}
                    </h1>
                    <span
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest whitespace-nowrap bg-slate-50 dark:bg-slate-900/50 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-700/30 shadow-inner">
                        {{ \Carbon\Carbon::parse($conversation->create_date)->format('d M, Y h:i A') }}
                    </span>
                </div>

                @foreach ($messages as $message)
                    <div class="flex gap-6 mb-8 {{ $message->user_id == Auth::id() ? 'flex-row-reverse' : '' }}">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 border border-slate-100 dark:border-slate-600 shadow-inner">
                                <span class="font-black">{{ substr($message->sender_name ?? 'U', 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 max-w-3xl">
                            <div
                                class="flex items-baseline gap-3 mb-2 {{ $message->user_id == Auth::id() ? 'justify-end' : '' }}">
                                <span
                                    class="font-bold text-slate-800 dark:text-white">{{ $message->sender_name }}</span>
                                <span
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ \Carbon\Carbon::parse($message->create_date)->diffForHumans() }}</span>
                            </div>
                            <div
                                class="p-6 rounded-2xl {{ $message->user_id == Auth::id() ? 'bg-pink-600/10 dark:bg-pink-600/20 border border-pink-500/20 dark:border-pink-500/30 text-slate-800 dark:text-white rounded-tr-none' : 'bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded-tl-none' }}">
                                <div class="prose prose-slate dark:prose-invert max-w-none text-sm leading-relaxed">
                                    {!! nl2br(e($message->msg)) !!}
                                </div>
                                @if ($message->attach)
                                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-white/10">
                                        <a href="{{ asset('uploads/attach/' . $message->attach) }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest hover:underline {{ $message->user_id == Auth::id() ? 'text-pink-600 dark:text-pink-300' : 'text-pink-600 dark:text-pink-400' }}">
                                            <i class="ti ti-download text-lg"></i>
                                            Descargar Adjunto ({{ $message->attach_file_name ?? 'Archivo' }})
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reply Box -->
            <div class="p-8 bg-slate-50/50 dark:bg-slate-900/30">
                <form action="{{ route('conversation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                    <input type="hidden" name="subject" value="RE: {{ $conversation->subject }}">

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 hidden md:block">
                            <div
                                class="w-12 h-12 rounded-full bg-pink-500/20 border border-pink-500/30 flex items-center justify-center text-pink-400">
                                <i class="ti ti-reply"></i>
                            </div>
                        </div>
                        <div class="flex-1 space-y-4">
                            <textarea name="message" rows="4" required
                                class="w-full bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-3 text-slate-700 dark:text-slate-200 focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all outline-none placeholder-slate-400 dark:placeholder-slate-600 resize-none"
                                placeholder="Escribe tu respuesta..."></textarea>

                            <div class="flex items-center justify-between">
                                <label
                                    class="flex items-center gap-2 cursor-pointer text-slate-400 dark:text-slate-500 hover:text-pink-600 dark:hover:text-pink-400 transition-colors text-[10px] font-black uppercase tracking-widest">
                                    <i class="ti ti-paperclip text-lg"></i>
                                    <span>Adjuntar</span>
                                    <input type="file" name="attachment" class="hidden">
                                </label>

                                <button type="submit"
                                    class="px-6 py-2.5 bg-pink-600 hover:bg-pink-500 text-white rounded-xl shadow-lg shadow-pink-600/30 font-bold text-xs uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                    <i class="ti ti-send"></i>
                                    Responder
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
