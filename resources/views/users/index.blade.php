<x-app-layout>

    {{-- SUCCESS --}}
    @if(session()->has('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <x-ui.alert variant="success">
            {{ session('success') }}
        </x-ui.alert>
    </div>
    @endif


    {{-- ERROR --}}
    @if(session()->has('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <x-ui.alert variant="error">
            {{ session('error') }}
        </x-ui.alert>
    </div>
    @endif


    {{-- WARNING --}}
    @if(session()->has('warning'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <x-ui.alert variant="warning">
            {{ session('warning') }}
        </x-ui.alert>
    </div>
    @endif


    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-sm rounded-xl border border-gray-200">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b flex items-center justify-between">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        👥 Manajemen User
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar pengguna aplikasi.
                    </p>
                </div>

                @can('create', App\Models\User::class)

                <a
                    href="{{ route('users.create') }}"
                    class="px-4 py-2 rounded-lg bg-indigo-600
                   hover:bg-indigo-700 text-white
                   text-sm font-medium">

                    + Tambah User

                </a>

                @endcan

            </div>


            {{-- TABLE --}}
            <div class="p-6">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                No
                            </th>

                            <th class="px-4 py-3 text-left">
                                Nama
                            </th>

                            <th class="px-4 py-3 text-left">
                                Email
                            </th>

                            <th class="px-4 py-3 text-left">
                                Role
                            </th>

                            <th class="px-4 py-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($users as $user)

                        <tr>

                            <td class="px-4 py-3">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3">

                                @forelse($user->roles as $role)

                                <span class="px-2 py-1 rounded bg-gray-100 text-sm">
                                    {{ $role->label }}
                                </span>

                                @empty

                                -

                                @endforelse

                            </td>


                            <td class="px-4 py-3 text-center">

                                @can('update', $user)

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="px-3 py-1 rounded bg-amber-500 text-white">
                                    Edit
                                </a>

                                @endcan


                                @can('delete', $user)

                                @can('delete', $user)

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy', $user) }}"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="px-3 py-1 rounded bg-red-600 text-white">

                                        Hapus

                                    </button>

                                </form>

                                @endcan

                                @endcan

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-10 text-gray-500">

                                Belum ada user.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>


                {{-- PAGINATION --}}
                <div class="mt-6">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>