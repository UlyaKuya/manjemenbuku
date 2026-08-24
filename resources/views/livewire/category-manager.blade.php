<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER --}}
    <div class="mb-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                📂 Manajemen Kategori
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola kategori buku perpustakaan.
            </p>
        </div>

        @can('create', \App\Models\Category::class)

        <button
            wire:click="create"
            type="button"
            class="inline-flex items-center rounded-lg bg-indigo-600
                       px-4 py-2 text-sm font-semibold text-white
                       shadow-sm hover:bg-indigo-700
                       focus:outline-none focus:ring-2
                       focus:ring-indigo-500 focus:ring-offset-2">

            + Tambah Kategori

        </button>

        @endcan

    </div>


    {{-- FLASH MESSAGE --}}
    @if (session()->has('success'))

    <div class="mb-6">

        <x-ui.alert variant="success">
            {{ session('success') }}
        </x-ui.alert>

    </div>

    @endif


    {{-- MAIN CARD --}}
    <div class="overflow-hidden rounded-xl border border-gray-200
                bg-white shadow-sm">

        {{-- SEARCH --}}
        <div class="border-b border-gray-200 p-6">

            <div class="relative max-w-md">

                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Cari kategori..."
                    class="w-full rounded-lg border-gray-300 pl-4 pr-4
                           py-2.5 text-sm shadow-sm
                           focus:border-indigo-500
                           focus:ring-indigo-500">

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs
                                   font-semibold uppercase tracking-wider
                                   text-gray-500">
                            No
                        </th>

                        <th class="px-6 py-3 text-left text-xs
                                   font-semibold uppercase tracking-wider
                                   text-gray-500">
                            Nama Kategori
                        </th>

                        <th class="px-6 py-3 text-left text-xs
                                   font-semibold uppercase tracking-wider
                                   text-gray-500">
                            Jumlah Buku
                        </th>

                        <th class="px-6 py-3 text-right text-xs
                                   font-semibold uppercase tracking-wider
                                   text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse ($categories as $category)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-4 text-sm text-gray-500">

                            {{ $categories->firstItem() + $loop->index }}

                        </td>


                        {{-- NAMA --}}
                        <td class="px-6 py-4">

                            <div class="font-medium text-gray-900">
                                {{ $category->name }}
                            </div>

                        </td>


                        {{-- JUMLAH BUKU --}}
                        <td class="px-6 py-4">

                            <span
                                class="inline-flex items-center rounded-full
                                           bg-indigo-50 px-2.5 py-1
                                           text-xs font-semibold
                                           text-indigo-700">

                                {{ $category->books_count }} buku

                            </span>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-right">

                            <div class="inline-flex items-center gap-2">

                                @can('update', $category)

                                <button
                                    wire:click="edit({{ $category->id }})"
                                    type="button"
                                    class="rounded-lg bg-amber-500
                                                   px-3 py-1.5 text-sm
                                                   font-medium text-white
                                                   hover:bg-amber-600">

                                    Edit

                                </button>

                                @endcan


                                @can('delete', $category)

                                <button
                                    wire:click="confirmDelete({{ $category->id }})"
                                    type="button"
                                    class="rounded-lg bg-red-600
                                                   px-3 py-1.5 text-sm
                                                   font-medium text-white
                                                   hover:bg-red-700">

                                    Hapus

                                </button>

                                @endcan

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-6 py-12 text-center">

                            <div class="text-gray-400 text-4xl mb-3">
                                📂
                            </div>

                            <p class="text-sm text-gray-500">
                                Belum ada kategori.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($categories->hasPages())

        <div class="border-t border-gray-200 px-6 py-4">

            {{ $categories->links() }}

        </div>

        @endif

    </div>


    {{-- ========================= --}}
    {{-- CREATE / EDIT MODAL --}}
    {{-- ========================= --}}

    @if ($showModal)

    <div
        class="fixed inset-0 z-50 flex items-center justify-center
                   bg-black/50 px-4">

        <div
            class="w-full max-w-md rounded-xl bg-white shadow-2xl">

            {{-- MODAL HEADER --}}
            <div class="border-b border-gray-200 px-6 py-5">

                <h2 class="text-xl font-bold text-gray-800">

                    {{ $isEdit
                            ? '✏️ Edit Kategori'
                            : '📂 Tambah Kategori'
                        }}

                </h2>

                <p class="mt-1 text-sm text-gray-500">

                    {{ $isEdit
                            ? 'Perbarui nama kategori.'
                            : 'Tambahkan kategori buku baru.'
                        }}

                </p>

            </div>


            {{-- MODAL BODY --}}
            <div class="px-6 py-5">

                <label
                    class="mb-2 block text-sm font-medium text-gray-700">

                    Nama Kategori

                </label>

                <input
                    type="text"
                    wire:model="name"
                    autofocus
                    placeholder="Contoh: Teknologi"
                    class="w-full rounded-lg border-gray-300
                               shadow-sm focus:border-indigo-500
                               focus:ring-indigo-500">

                @error('name')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

                @enderror

            </div>


            {{-- MODAL FOOTER --}}
            <div
                class="flex justify-end gap-2 border-t
                           border-gray-200 px-6 py-4">

                <button
                    wire:click="closeModal"
                    type="button"
                    class="rounded-lg bg-gray-200 px-4 py-2
                               text-sm font-semibold text-gray-700
                               hover:bg-gray-300">

                    Batal

                </button>

                <button
                    wire:click="save"
                    type="button"
                    class="rounded-lg bg-indigo-600 px-4 py-2
                               text-sm font-semibold text-white
                               hover:bg-indigo-700">

                    {{ $isEdit ? 'Perbarui' : 'Simpan' }}

                </button>

            </div>

        </div>

    </div>

    @endif


    {{-- ========================= --}}
    {{-- DELETE MODAL --}}
    {{-- ========================= --}}

    @if ($showDeleteModal)

    <div
        class="fixed inset-0 z-50 flex items-center justify-center
                   bg-black/50 px-4">

        <div
            class="w-full max-w-md rounded-xl bg-white shadow-2xl">

            <div class="px-6 py-6">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center
                                   justify-center rounded-full bg-red-100">

                        🗑️

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-gray-800">
                            Hapus Kategori?
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Apakah kamu yakin ingin menghapus kategori ini?
                        </p>

                    </div>

                </div>

            </div>


            <div
                class="flex justify-end gap-2 border-t
                           border-gray-200 px-6 py-4">

                <button
                    wire:click="closeDeleteModal"
                    type="button"
                    class="rounded-lg bg-gray-200 px-4 py-2
                               text-sm font-semibold text-gray-700
                               hover:bg-gray-300">

                    Batal

                </button>

                <button
                    wire:click="delete"
                    type="button"
                    class="rounded-lg bg-red-600 px-4 py-2
                               text-sm font-semibold text-white
                               hover:bg-red-700">

                    Ya, Hapus

                </button>

            </div>

        </div>

    </div>

    @endif

</div>