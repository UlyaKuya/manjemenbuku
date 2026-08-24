<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white shadow-sm rounded-xl border border-gray-200">

        {{-- HEADER --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    📚 Manajemen Buku
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola data buku perpustakaan.
                </p>
            </div>

            {{-- TAMBAH BUKU --}}
            @can('create', App\Models\Book::class)
            <x-ui.button
                wire:click="create"
                variant="primary">
                Tambah Buku
            </x-ui.button>
            @endcan

        </div>


        {{-- SUCCESS MESSAGE --}}
        {{-- SUCCESS MESSAGE --}}
        @if(session()->has('success'))

        <div class="px-6 pt-4">

            <x-ui.alert variant="success">
                {{ session('success') }}
            </x-ui.alert>

        </div>

        @endif


        {{-- ERROR MESSAGE --}}
        @if(session()->has('error'))

        <div class="px-6 pt-4">

            <x-ui.alert variant="error">
                {{ session('error') }}
            </x-ui.alert>

        </div>

        @endif


        {{-- WARNING MESSAGE --}}
        @if(session()->has('warning'))

        <div class="px-6 pt-4">

            <x-ui.alert variant="warning">
                {{ session('warning') }}
            </x-ui.alert>

        </div>

        @endif





        {{-- CONTENT --}}
        <div class="p-6">

            {{-- SEARCH --}}
            <div class="flex justify-between mb-5">

                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari judul, penulis, atau penerbit..."
                    class="w-80 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">

                <span class="text-gray-500 text-sm">
                    Total Buku :
                    <strong>{{ $books->total() }}</strong>
                </span>

            </div>


            {{-- TABLE / EMPTY STATE --}}
            <div class="overflow-x-auto">

                @php
                $showAction =
                auth()->user()->hasPermission('books.update')
                || auth()->user()->hasPermission('books.delete');
                @endphp


                @if($books->count() > 0)

                {{-- TABLE --}}
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>

                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Judul</th>
                            <th class="px-4 py-3 text-left">Penulis</th>
                            <th class="px-4 py-3 text-left">Penerbit</th>
                            <th class="px-4 py-3 text-left">Tahun</th>
                            <th class="px-4 py-3 text-left">Kategori</th>

                            @if($showAction)
                            <th class="px-4 py-3 text-center">
                                Aksi
                            </th>
                            @endif

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-gray-100 bg-white">

                        @foreach($books as $book)

                        <tr
                            wire:key="book-{{ $book->id }}"
                            class="hover:bg-gray-50">

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

                            <td class="px-4 py-3">
                                {{ $book->category?->name ?? '-' }}
                            </td>


                            {{-- ACTION --}}
                            @if($showAction)

                            <td class="px-4 py-3 text-center space-x-2">

                                {{-- EDIT --}}
                                @can('update', $book)

                                <x-ui.button
                                    wire:click="edit({{ $book->id }})"
                                    variant="secondary"
                                    size="sm">
                                    Edit
                                </x-ui.button>

                                @endcan


                                {{-- DELETE --}}
                                @can('delete', $book)

                                <x-ui.button
                                    wire:click="confirmDelete({{ $book->id }})"
                                    variant="danger"
                                    size="sm">
                                    Hapus
                                </x-ui.button>

                                @endcan

                            </td>

                            @endif

                        </tr>

                        @endforeach

                    </tbody>

                </table>


                @else

                {{-- EMPTY STATE --}}
                <x-ui.empty-state
                    icon="📚"
                    title="Belum ada data buku"
                    subtitle="Silakan tambahkan buku pertama ke perpustakaan.">

                    <x-slot:action>

                        @can('create', App\Models\Book::class)

                        <x-ui.button
                            wire:click="create"
                            variant="primary">
                            Tambah Buku
                        </x-ui.button>

                        @endcan

                    </x-slot:action>

                </x-ui.empty-state>

                @endif

            </div>


            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $books->links() }}
            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL TAMBAH / EDIT --}}
    {{-- ========================================================= --}}

    @if($showModal)

    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg">

            {{-- MODAL HEADER --}}
            <div class="border-b px-6 py-4">

                <h2 class="text-xl font-semibold">

                    {{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}

                </h2>

            </div>


            {{-- FORM --}}
            <div class="p-6 space-y-4">

                {{-- TITLE --}}
                <div>

                    <input
                        wire:model.live="title"
                        type="text"
                        placeholder="Judul Buku"
                        class="w-full rounded-lg border-gray-300">

                    @error('title')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- AUTHOR --}}
                <div>

                    <input
                        wire:model.live="author"
                        type="text"
                        placeholder="Penulis"
                        class="w-full rounded-lg border-gray-300">

                    @error('author')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- PUBLISHER --}}
                <div>

                    <input
                        wire:model.live="publisher"
                        type="text"
                        placeholder="Penerbit"
                        class="w-full rounded-lg border-gray-300">

                    @error('publisher')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- YEAR --}}
                <div>

                    <input
                        wire:model.live="year"
                        type="number"
                        placeholder="Tahun"
                        class="w-full rounded-lg border-gray-300">

                    @error('year')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori
                    </label>

                    <select
                        wire:model="category_id"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">

                        <option value="">Pilih Kategori</option>

                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @endforeach

                    </select>
                </div>

            </div>


            {{-- MODAL FOOTER --}}
            <div class="border-t px-6 py-4 flex justify-end gap-2">

                <button
                    type="button"
                    wire:click="closeModal"
                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
                    Batal
                </button>

                <x-ui.button
                    wire:click="save"
                    variant="primary">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </x-ui.button>

            </div>

        </div>

    </div>

    @endif


    {{-- ========================================================= --}}
    {{-- MODAL DELETE --}}
    {{-- ========================================================= --}}

    @if($showDeleteModal)

    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b">

                <h2 class="text-xl font-semibold text-red-600">
                    Hapus Buku
                </h2>

            </div>


            {{-- CONTENT --}}
            <div class="p-6">

                <p class="text-gray-600">
                    Apakah Anda yakin ingin menghapus buku ini?
                </p>

            </div>


            {{-- FOOTER --}}
            <div class="px-6 py-4 border-t flex justify-end gap-2">

                <x-ui.button
                    wire:click="closeDeleteModal"
                    variant="secondary">
                    Batal
                </x-ui.button>

                <x-ui.button
                    wire:click="delete"
                    variant="danger">
                    Ya, Hapus
                </x-ui.button>

            </div>

        </div>

    </div>

    @endif

</div>