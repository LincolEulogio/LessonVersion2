<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('mailandsms.index') }}"
                class="inline-flex items-center text-slate-400 hover:text-white transition-colors mb-4">
                <i class="ti ti-arrow-left mr-2"></i>
                Volver al historial
            </a>
            <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-400 border border-yellow-500/20">
                    <i class="ti ti-send text-xl"></i>
                </span>
                Enviar Notificación
            </h1>
        </div>

        <div class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('mailandsms.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Type -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Tipo de
                            Mensaje</label>
                        <select name="type" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 transition-all outline-none">
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                        </select>
                    </div>

                    <!-- User Group -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Grupo de
                            Destinatarios</label>
                        <select name="usertypeID" id="usertypeID" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 transition-all outline-none">
                            <option value="">Seleccionar Grupo...</option>
                            <option value="all">Todos los Usuarios</option>
                            @foreach ($usertypes as $usertype)
                                <option value="{{ $usertype->usertypeID }}">{{ $usertype->usertype }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Specific Users (Dynamic) -->
                <div class="space-y-2 relative" id="user-select-container">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Destinatarios
                        Específicos</label>
                    <select name="userID" id="userID" disabled
                        class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 transition-all outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                        <option value="all">Todos los del grupo seleccionado</option>
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Dejar en "Todos" para enviar masivamente al grupo.</p>
                </div>

                <!-- Message -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Mensaje</label>
                    <textarea name="message" rows="6" required
                        class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 transition-all outline-none placeholder-slate-600 resize-none"
                        placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-4 border-t border-slate-700/30">
                    <button type="submit"
                        class="px-8 py-3 bg-yellow-600 hover:bg-yellow-500 text-black rounded-xl shadow-lg shadow-yellow-600/30 font-bold text-sm uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                        <i class="ti ti-send"></i>
                        Enviar Notificación
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('usertypeID').addEventListener('change', function() {
                const usertypeID = this.value;
                const userSelect = document.getElementById('userID');

                // RESET
                userSelect.innerHTML = '<option value="all">Cargando usuarios...</option>';
                userSelect.disabled = true;

                if (usertypeID && usertypeID !== 'all') {
                    fetch(`/api/users/${usertypeID}`)
                        .then(response => response.json())
                        .then(data => {
                            userSelect.innerHTML = '<option value="all">Todos los del grupo seleccionado</option>';
                            data.forEach(user => {
                                const option = document.createElement('option');
                                option.value = user.id;
                                option.textContent = user.name;
                                userSelect.appendChild(option);
                            });
                            userSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching users:', error);
                            userSelect.innerHTML = '<option value="all">Error al cargar usuarios</option>';
                        });
                } else {
                    userSelect.innerHTML = '<option value="all">Todos (Selección masiva)</option>';
                    // If 'all' groups selected, distinct user selection disabled implies 'all users'.
                }
            });
        </script>
    @endpush
</x-app-layout>
