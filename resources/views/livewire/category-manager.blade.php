<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Kategori
            </h1>

            <p class="text-sm text-gray-500">
                Kelola kategori buku perpustakaan.
            </p>
        </div>

        @can('create', \App\Models\Category::class)
        <button
            wire:click="create"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            + Tambah Kategori
        </button>
        @endcan
    </div>


    {{-- Flash Message --}}
    @if (session()->has('success'))
    <div class="rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif


    {{-- Search --}}
    <div>
        <input
            type="text"
            wire:model.live="search"
            placeholder="Cari kategori..."
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                        Nama Kategori
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                        Jumlah Buku
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse ($categories as $category)
                <tr>

                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $category->name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $category->books_count }} buku
                    </td>

                    <td class="px-6 py-4 text-right text-sm">

                        @can('update', $category)
                        <button
                            wire:click="edit({{ $category->id }})"
                            class="mr-2 font-semibold text-blue-600 hover:text-blue-800">
                            Edit
                        </button>
                        @endcan

                        @can('delete', $category)
                        <button
                            wire:click="confirmDelete({{ $category->id }})"
                            class="font-semibold text-red-600 hover:text-red-800">
                            Hapus
                        </button>
                        @endcan

                    </td>

                </tr>

                @empty
                <tr>
                    <td
                        colspan="3"
                        class="px-6 py-8 text-center text-sm text-gray-500">
                        Belum ada kategori.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>


    {{-- Pagination --}}
    <div>
        {{ $categories->links() }}
    </div>


    {{-- Create / Edit Modal --}}
    @if ($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">

            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $isEdit ? 'Edit Kategori' : 'Tambah Kategori' }}
                </h2>
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    wire:model="name"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: Teknologi">

                @error('name')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-2">

                <button
                    wire:click="closeModal"
                    class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300">
                    Batal
                </button>

                <button
                    wire:click="save"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    {{ $isEdit ? 'Perbarui' : 'Simpan' }}
                </button>

            </div>

        </div>
    </div>
    @endif


    {{-- Delete Confirmation Modal --}}
    @if ($showDeleteModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">

            <h2 class="text-xl font-bold text-gray-800">
                Hapus Kategori?
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Apakah kamu yakin ingin menghapus kategori ini?
            </p>

            <div class="mt-6 flex justify-end gap-2">

                <button
                    wire:click="closeDeleteModal"
                    class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300">
                    Batal
                </button>

                <button
                    wire:click="delete"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>

            </div>

        </div>
    </div>
    @endif

</div>