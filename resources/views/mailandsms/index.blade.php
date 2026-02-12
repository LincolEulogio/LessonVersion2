<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-white dark:bg-yellow-500/10 flex items-center justify-center text-yellow-600 dark:text-yellow-400 border border-slate-200 dark:border-yellow-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-mail text-xl"></i>
                </span>
                Mail / SMS
            </h1>

            <a href="{{ route('mailandsms.add') }}"
                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-slate-900 rounded-xl shadow-lg shadow-yellow-500/20 font-bold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                <i class="ti ti-send"></i>
                Enviar Nuevo
            </a>
        </div>

        <!-- History Table -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-700/50 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Mensaje</th>
                            <th class="px-6 py-4">Tipo</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-sm">
                        @forelse($messages as $index => $message)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all group">
                                <td class="px-6 py-4 font-mono text-slate-400 dark:text-slate-500">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="line-clamp-2 text-slate-600 dark:text-slate-300 group-hover:text-slate-950 dark:group-hover:text-white transition-colors max-w-md font-medium">
                                        {{ strip_tags($message->message) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($message->type == 'email')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 font-bold text-[10px] uppercase border border-yellow-500/20 tracking-widest">
                                            <i class="ti ti-mail"></i> Email
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold text-[10px] uppercase border border-blue-500/20 tracking-widest">
                                            <i class="ti ti-message-2"></i> SMS
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400 dark:text-slate-500 font-medium">
                                    {{ \Carbon\Carbon::parse($message->create_date)->format('d M, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('mailandsms.view', $message->mailandsmsID) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-700 text-slate-400 dark:text-slate-500 hover:bg-yellow-500/20 hover:text-yellow-600 dark:hover:text-yellow-400 transition-all shadow-sm dark:shadow-none"
                                        title="Ver Detalles">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mb-4 shadow-inner">
                                            <i class="ti ti-inbox-off text-3xl"></i>
                                        </div>
                                        <p class="font-bold text-sm">No se encontraron mensajes enviados.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
