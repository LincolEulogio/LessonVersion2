<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('conversation.index') }}"
                class="inline-flex items-center text-slate-400 hover:text-white transition-colors mb-4">
                <i class="ti ti-arrow-left mr-2"></i>
                Volver a la bandeja
            </a>
            <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center text-pink-400 border border-pink-500/20">
                    <i class="ti ti-edit text-xl"></i>
                </span>
                Redactar Mensaje
            </h1>
        </div>

        <div class="bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('conversation.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User Group / Role -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Grupo de
                            Usuario</label>
                        <select name="usertypeID" id="usertypeID" required
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all outline-none">
                            <option value="">Seleccionar Grupo...</option>
                            @foreach ($usertypes as $usertype)
                                <option value="{{ $usertype->usertypeID }}">{{ $usertype->usertype }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Specific User (Dynamic) -->
                    <div class="space-y-2" id="user-select-container">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Usuario</label>
                        <select name="userID" id="userID" disabled
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">Seleccione un grupo primero</option>
                        </select>
                    </div>
                </div>

                <!-- Subject -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Asunto</label>
                    <input type="text" name="subject" required
                        class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all outline-none placeholder-slate-600"
                        placeholder="Escribe el asunto del mensaje...">
                </div>

                <!-- Message -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Mensaje</label>
                    <textarea name="message" rows="8" required
                        class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl px-4 py-3 text-slate-200 focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all outline-none placeholder-slate-600 resize-none"
                        placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>

                <!-- Attachment & Actions -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between gap-6 pt-4 border-t border-slate-700/30">
                    <div class="w-full md:w-auto">
                        <label
                            class="flex items-center gap-3 px-4 py-2 bg-slate-900/50 border border-slate-700/50 rounded-xl cursor-pointer hover:bg-slate-700/50 transition-colors group">
                            <i class="ti ti-paperclip text-slate-400 group-hover:text-pink-400 transition-colors"></i>
                            <span
                                class="text-sm font-bold text-slate-400 group-hover:text-white transition-colors">Adjuntar
                                Archivo</span>
                            <input type="file" name="attachment" class="hidden">
                        </label>
                    </div>

                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="draft" value="1"
                                class="w-5 h-5 rounded bg-slate-900 border-slate-700 text-pink-600 focus:ring-pink-500/20">
                            <span
                                class="text-sm font-bold text-slate-500 group-hover:text-slate-300 transition-colors">Guardar
                                como borrador</span>
                        </label>

                        <button type="submit"
                            class="px-8 py-3 bg-pink-600 hover:bg-pink-500 text-white rounded-xl shadow-lg shadow-pink-600/30 font-bold text-sm uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                            <i class="ti ti-send"></i>
                            Enviar
                        </button>
                    </div>
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
                userSelect.innerHTML = '<option value="">Cargando usuarios...</option>';
                userSelect.disabled = true;

                if (usertypeID) {
                    fetch(`/api/users/${usertypeID}`)
                        .then(response => response.json())
                        .then(data => {
                            userSelect.innerHTML = '<option value="">Seleccionar Usuario...</option>';
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
                            userSelect.innerHTML = '<option value="">Error al cargar usuarios</option>';
                        });
                } else {
                    userSelect.innerHTML = '<option value="">Seleccione un grupo primero</option>';
                }
            });
        </script>
    @endpush
</x-app-layout>
