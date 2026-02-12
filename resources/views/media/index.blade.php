<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span
                    class="w-10 h-10 rounded-xl bg-white dark:bg-teal-500/10 flex items-center justify-center text-teal-600 dark:text-teal-400 border border-slate-200 dark:border-teal-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-folder text-xl"></i>
                </span>
                Gestor de Archivos
            </h1>

            <div class="flex gap-3">
                <button onclick="document.getElementById('createFolderModal').showModal()"
                    class="px-6 py-3 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-700 dark:text-white border border-slate-200 dark:border-transparent rounded-xl font-bold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2 shadow-sm dark:shadow-none">
                    <i class="ti ti-folder-plus text-lg"></i>
                    Nueva Carpeta
                </button>
                <button onclick="document.getElementById('uploadFileModal').showModal()"
                    class="px-6 py-3 bg-teal-600 hover:bg-teal-500 text-white rounded-xl shadow-lg shadow-teal-600/30 font-bold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                    <i class="ti ti-upload"></i>
                    Subir Archivo
                </button>
            </div>
        </div>

        <!-- Breadcrumbs -->
        <div class="mb-6 flex items-center gap-2 text-[10px] font-black uppercase tracking-widest">
            <a href="{{ route('media.index') }}"
                class="flex items-center gap-1 text-slate-400 dark:text-slate-500 hover:text-teal-600 dark:hover:text-white transition-all">
                <i class="ti ti-home text-base"></i>
                Inicio
            </a>
            @if ($currentFolder)
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-teal-600 dark:text-teal-400">{{ $currentFolder->folder_name }}</span>
            @endif
        </div>

        <!-- Content Grid -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl rounded-2xl p-6 min-h-[600px]">

            @if ($folders->count() == 0 && $files->count() == 0)
                <div class="flex flex-col items-center justify-center h-[500px] text-center">
                    <div
                        class="w-24 h-24 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mb-6 shadow-inner">
                        <i class="ti ti-folder-off text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Carpeta Vacía</h3>
                    <p class="text-slate-400 dark:text-slate-500 max-w-sm">No hay archivos ni carpetas aquí. Comienza
                        subiendo un archivo o
                        creando una carpeta.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    <!-- Folders -->
                    @foreach ($folders as $folder)
                        <div class="group relative">
                            <a href="{{ route('media.view', $folder->media_categoryID) }}" class="block">
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 hover:bg-teal-600/5 dark:hover:bg-teal-500/10 border border-slate-100 dark:border-slate-600 hover:border-teal-500/30 rounded-2xl p-6 transition-all aspect-square flex flex-col items-center justify-center gap-3 text-center shadow-sm hover:shadow-none">
                                    <i
                                        class="ti ti-folder-filled text-5xl text-yellow-400 group-hover:scale-110 transition-transform drop-shadow-sm"></i>
                                    <span
                                        class="text-slate-700 dark:text-white font-bold text-sm truncate w-full px-2">{{ $folder->folder_name }}</span>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500">{{ \Carbon\Carbon::parse($folder->create_date)->format('d M, Y') }}</span>
                                </div>
                            </a>
                            @if ($folder->userID == Auth::id())
                                <form action="{{ route('media.deletef', $folder->media_categoryID) }}" method="POST"
                                    class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                                    onsubmit="return confirm('¿Eliminar carpeta y su contenido?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-full bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white flex items-center justify-center transition-colors">
                                        <i class="ti ti-trash text-xs"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach

                    <!-- Files -->
                    @foreach ($files as $file)
                        <div class="group relative">
                            <a href="{{ asset('uploads/media/' . $file->file_name) }}" target="_blank" class="block">
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-600/50 border border-slate-100 dark:border-slate-600 hover:border-slate-200 dark:hover:border-slate-500 rounded-2xl p-4 transition-all aspect-square flex flex-col items-center justify-between shadow-sm hover:shadow-none">
                                    <div class="flex-1 flex items-center justify-center w-full">
                                        @php
                                            $ext = strtolower($file->file_type);
                                            $icon = 'ti-file';
                                            $color = 'text-slate-400';
                                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $icon = 'ti-photo';
                                                $color = 'text-purple-400';
                                            } elseif (in_array($ext, ['pdf'])) {
                                                $icon = 'ti-file-type-pdf';
                                                $color = 'text-red-400';
                                            } elseif (in_array($ext, ['doc', 'docx'])) {
                                                $icon = 'ti-file-type-doc';
                                                $color = 'text-blue-400';
                                            } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                $icon = 'ti-file-type-xls';
                                                $color = 'text-green-400';
                                            }
                                        @endphp
                                        <i
                                            class="ti {{ $icon }} text-5xl {{ $color }} group-hover:scale-110 transition-transform"></i>
                                    </div>
                                    <div class="w-full text-center mt-3">
                                        <p class="text-slate-700 dark:text-white font-bold text-xs truncate mb-1"
                                            title="{{ $file->m_name }}">{{ $file->m_name }}</p>
                                        <p
                                            class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">
                                            {{ $ext }}</p>
                                    </div>
                                </div>
                            </a>
                            @if ($file->userID == Auth::id())
                                <form action="{{ route('media.delete', $file->mediaID) }}" method="POST"
                                    class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                                    onsubmit="return confirm('¿Eliminar archivo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-full bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-white flex items-center justify-center transition-colors">
                                        <i class="ti ti-trash text-xs"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Create Folder Modal -->
    <dialog id="createFolderModal" class="bg-transparent">
        <div
            class="fixed inset-0 bg-slate-900/60 dark:bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div
                class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl w-full max-w-md p-6 shadow-2xl transform transition-all">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Nueva Carpeta</h3>
                <form action="{{ route('media.create_folder') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Nombre</label>
                            <input type="text" name="folder_name" required autofocus
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-3 text-slate-700 dark:text-slate-200 focus:border-teal-500/50 focus:ring-2 focus:ring-teal-500/10 transition-all outline-none placeholder-slate-400 dark:placeholder-slate-600"
                                placeholder="Ej: Documentos Importantes">
                        </div>
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" onclick="document.getElementById('createFolderModal').close()"
                                class="px-4 py-2 text-slate-400 dark:text-slate-500 hover:text-slate-800 dark:hover:text-white font-bold transition-colors">Cancelar</button>
                            <button type="submit"
                                class="px-6 py-2 bg-teal-600 hover:bg-teal-500 text-white rounded-xl font-bold transition-all shadow-lg shadow-teal-600/20 active:scale-95">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Upload File Modal -->
    <dialog id="uploadFileModal" class="bg-transparent">
        <div
            class="fixed inset-0 bg-slate-900/60 dark:bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div
                class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl w-full max-w-md p-6 shadow-2xl transform transition-all">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Subir Archivo</h3>
                <form action="{{ route('media.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="folderID"
                        value="{{ $currentFolder ? $currentFolder->media_categoryID : 0 }}">
                    <div class="space-y-4">
                        <div
                            class="border-2 border-dashed border-slate-100 dark:border-slate-600 rounded-xl p-8 text-center hover:border-teal-500/50 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all cursor-pointer relative bg-slate-50/50 dark:bg-slate-900/20 shadow-inner">
                            <input type="file" name="file" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer text-sm">
                            <i class="ti ti-cloud-upload text-4xl text-slate-300 dark:text-slate-500 mb-2"></i>
                            <p class="text-slate-500 dark:text-slate-300 font-bold text-sm">Haz clic o arrastra un
                                archivo aquí</p>
                            <p
                                class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500 mt-1">
                                Soporta hasta 10MB</p>
                        </div>
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" onclick="document.getElementById('uploadFileModal').close()"
                                class="px-4 py-2 text-slate-400 dark:text-slate-500 hover:text-slate-800 dark:hover:text-white font-bold transition-colors">Cancelar</button>
                            <button type="submit"
                                class="px-6 py-2 bg-teal-600 hover:bg-teal-500 text-white rounded-xl font-bold transition-all shadow-lg shadow-teal-600/20 active:scale-95">Subir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</x-app-layout>
