<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-400 border border-yellow-500/20">
                    <i class="ti ti-mail text-xl"></i>
                </span>
                Mail / SMS
            </h1>

            <a href="{{ route('mailandsms.add') }}"
                class="px-6 py-3 bg-yellow-600 hover:bg-yellow-500 text-black rounded-xl shadow-lg shadow-yellow-600/30 font-bold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                <i class="ti ti-plus"></i>
                Enviar Nuevo
            </a>
        </div>

        <!-- History Table -->
        <div class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-xs font-bold text-slate-400 border-b border-slate-700/50 uppercase tracking-wider">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Mensaje</th>
                            <th class="px-6 py-4">Tipo</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50 text-sm">
                        @forelse($messages as $index => $message)
                            <tr class="hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-mono text-slate-500">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="line-clamp-2 text-slate-300 group-hover:text-white transition-colors max-w-md">
                                        {{ strip_tags($message->message) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($message->type == 'email')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-yellow-500/10 text-yellow-500 font-bold text-xs uppercase border border-yellow-500/20">
                                            <i class="ti ti-mail"></i> Email
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-500/10 text-blue-400 font-bold text-xs uppercase border border-blue-500/20">
                                            <i class="ti ti-message-2"></i> SMS
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ \Carbon\Carbon::parse($message->create_date)->format('d M, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('mailandsms.view', $message->mailandsmsID) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-700 text-slate-400 hover:bg-yellow-500/20 hover:text-yellow-400 transition-all"
                                        title="Ver Detalles">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="ti ti-inbox-off text-4xl mb-3 text-slate-600"></i>
                                        <p>No se encontraron mensajes enviados.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-700/50">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
