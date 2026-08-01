<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white shadow-sm rounded-xl border border-gray-200">

        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    📚 Manajemen Buku
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola data buku perpustakaan.
                </p>
            </div>

            <button
                wire:click="create"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg transition">
                + Tambah Buku
            </button>

        </div>

        @if(session()->has('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
        @endif


        <div class="p-6">

            <div class="flex justify-between mb-5">

                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari judul, penulis, atau penerbit..."
                    class="w-80 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">

                <span class="text-gray-500 text-sm">
                    Total Buku :
                    <strong>{{ $books->count() }}</strong>
                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Judul</th>
                            <th class="px-4 py-3 text-left">Penulis</th>
                            <th class="px-4 py-3 text-left">Penerbit</th>
                            <th class="px-4 py-3 text-left">Tahun</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($books as $book)

                        <tr wire:key="book-{{ $book->id }}" class="hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $books->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $book->title }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $book->author }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $book->publisher }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $book->year }}
                            </td>

                            <td class="px-4 py-3 text-center space-x-2">

                                <button
                                    wire:click="edit({{ $book->id }})"
                                    class="px-3 py-1 rounded bg-amber-500 hover:bg-amber-600 text-white">
                                    Edit
                                </button>

                                <button
                                    wire:click="confirmDelete({{ $book->id }})"
                                    class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white">
                                    Hapus
                                </button>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">
                                Belum ada data buku.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $books->links() }}
                </div>

            </div>

        </div>

    </div>




    {{-- MODAL TAMBAH / EDIT --}}
    @if($showModal)

    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg">

            <div class="border-b px-6 py-4">
                <h2 class="text-xl font-semibold">
                    {{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}
                </h2>
            </div>

            <div class="p-6 space-y-4">

                <div>
                    <input
                        wire:model.live="title"
                        type="text"
                        placeholder="Judul Buku"
                        class="w-full rounded-lg border-gray-300">

                    @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        wire:model.live="author"
                        type="text"
                        placeholder="Penulis"
                        class="w-full rounded-lg border-gray-300">

                    @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        wire:model.live="publisher"
                        type="text"
                        placeholder="Penerbit"
                        class="w-full rounded-lg border-gray-300">

                    @error('publisher')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input
                        wire:model.live="year"
                        type="number"
                        placeholder="Tahun"
                        class="w-full rounded-lg border-gray-300">

                    @error('year')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="border-t px-6 py-4 flex justify-end gap-2">

                <button
                    wire:click="closeModal"
                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
                    Batal
                </button>

                <button
                    wire:click="save"
                    class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>

            </div>

        </div>

    </div>

    @endif


    {{-- MODAL DELETE --}}
    @if($showDeleteModal)

    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">

            <div class="px-6 py-5 border-b">
                <h2 class="text-xl font-semibold text-red-600">
                    Hapus Buku
                </h2>
            </div>

            <div class="p-6">
                <p class="text-gray-600">
                    Apakah Anda yakin ingin menghapus buku ini?
                </p>
            </div>

            <div class="px-6 py-4 border-t flex justify-end gap-2">

                <button
                    wire:click="$set('showDeleteModal', false)"
                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
                    Batal
                </button>

                <button
                    wire:click="delete"
                    class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                    Ya, Hapus
                </button>

            </div>

        </div>

    </div>

    @endif

</div>