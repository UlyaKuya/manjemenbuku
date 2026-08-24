<x-app-layout>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-sm rounded-xl border border-gray-200">

            <div class="px-6 py-5 border-b">

                <h1 class="text-2xl font-bold text-gray-800">
                    ✏️ Edit User
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Perbarui data pengguna.
                </p>

            </div>

            <form
                method="POST"
                action="{{ route('users.update', $user) }}"
                class="p-6 space-y-5">

                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>

                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Nama
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Role --}}
                <div>

                    <label
                        for="role_id"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Role
                    </label>

                    <select
                        id="role_id"
                        name="role_id"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                        <option value="">
                            Pilih Role
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected(
                                    old(
                                        'role_id',
                                        $user->roles->first()?->id
                                    ) == $role->id
                                )>

                                {{ $role->label }}

                            </option>

                        @endforeach

                    </select>

                    @error('role_id')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Tombol --}}
                <div class="border-t pt-5 flex justify-end gap-2">

                    <a
                        href="{{ route('users.index') }}"
                        class="px-4 py-2 rounded-lg bg-gray-200
                        hover:bg-gray-300 text-gray-700">

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600
                        hover:bg-indigo-700 text-white">

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>