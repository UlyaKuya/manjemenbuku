<x-app-layout>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-sm rounded-xl border border-gray-200">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b">

                <h1 class="text-2xl font-bold text-gray-800">
                    👤 Tambah User
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan pengguna baru ke dalam aplikasi.
                </p>

            </div>


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('users.store') }}"
                class="p-6 space-y-5">

                @csrf


                {{-- NAMA --}}
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
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                    @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- EMAIL --}}
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
                        value="{{ old('email') }}"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                    @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- PASSWORD --}}
                <div>

                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                    @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div>

                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password
                    </label>

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="w-full rounded-lg border-gray-300
                        focus:border-indigo-500 focus:ring-indigo-500">

                </div>


                {{-- ROLE --}}
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
                            @selected(old('role_id')==$role->id)>

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


                {{-- BUTTON --}}
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

                        Simpan User

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>