<x-app-layout>
    <div class="min-h-screen bg-[#0f172a] text-white font-sans selection:bg-blue-500/30">
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            
            <!-- Header Section -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold bg-linear-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                        📚 Gestión de Libros
                    </h1>
                    <p class="mt-2 text-slate-400">Administra el inventario de la biblioteca escolar.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('book.create') }}" 
                       class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold transition-all shadow-lg shadow-blue-500/20 flex items-center gap-2">
                        <i class="ti ti-plus text-lg"></i>
                        Nuevo Libro
                    </a>
                </div>
            </div>

            <!-- Library Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="p-6 rounded-2xl bg-linear-to-br from-blue-500/10 to-transparent border border-blue-500/20 backdrop-blur-xl group hover:border-blue-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Total Libros</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $books->sum('quantity') }}</h3>
                        </div>
                        <div class="p-3 bg-blue-500/20 rounded-xl text-blue-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-books text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-linear-to-br from-cyan-500/10 to-transparent border border-cyan-500/20 backdrop-blur-xl group hover:border-cyan-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Libros Prestados</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $books->sum('due_quantity') }}</h3>
                        </div>
                        <div class="p-3 bg-cyan-500/20 rounded-xl text-cyan-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-book-upload text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-linear-to-br from-emerald-500/10 to-transparent border border-emerald-500/20 backdrop-blur-xl group hover:border-emerald-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Disponibles</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $books->sum('quantity') - $books->sum('due_quantity') }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-500/20 rounded-xl text-emerald-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-book-check text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Table Card -->
            <div class="rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm p-6 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-sm font-medium border-b border-slate-700/50">
                                <th class="pb-4 px-4">#</th>
                                <th class="pb-4 px-4">Libro</th>
                                <th class="pb-4 px-4">Autor</th>
                                <th class="pb-4 px-4">Cód. Materia</th>
                                <th class="pb-4 px-4">Rack</th>
                                <th class="pb-4 px-4">Cant.</th>
                                <th class="pb-4 px-4">Disp.</th>
                                <th class="pb-4 px-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/30">
                            @foreach($books as $book)
                            <tr class="group hover:bg-slate-700/20 transition-colors">
                                <td class="py-4 px-4 text-slate-400 text-sm">{{ $book->bookID }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                                            <i class="ti ti-book text-xl"></i>
                                        </div>
                                        <span class="font-bold text-slate-200">{{ $book->book }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-slate-300">{{ $book->author }}</td>
                                <td class="py-4 px-4 text-slate-400">
                                    <span class="px-2 py-1 rounded-md bg-slate-700/50 text-xs border border-slate-600/50">{{ $book->subject_code }}</span>
                                </td>
                                <td class="py-4 px-4 text-slate-400 text-sm">{{ $book->rack }}</td>
                                <td class="py-4 px-4 text-slate-300 font-medium">{{ $book->quantity }}</td>
                                <td class="py-4 px-4 text-slate-300 font-medium">
                                    <span class="px-2 py-1 rounded-full {{ ($book->quantity - $book->due_quantity) > 0 ? 'bg-emerald-500/10 text-emerald-400' : 'bg-red-500/10 text-red-400' }} text-xs border border-current/20">
                                        {{ $book->quantity - $book->due_quantity }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('book.edit', $book->bookID) }}" 
                                           class="p-2 rounded-lg bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-all">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('book.destroy', $book->bookID) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all"
                                                    onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
