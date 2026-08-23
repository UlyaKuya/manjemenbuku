<div
    x-data="{ open: @entangle('open') }"
    x-on:keydown.window.ctrl.k.prevent="$wire.openSearch()"
    x-on:keydown.window.escape="$wire.closeSearch()">


    @if($open)
    <div class="fixed inset-0 z-[9999] bg-black/50 flex items-start justify-center pt-24">

        <div class="w-full max-w-2xl bg-white rounded-xl shadow-2xl">

            <div class="p-4 border-b">
                <input
                    type="text"
                    wire:model.live="search"
                    autofocus
                    placeholder="Cari buku atau pengguna..."
                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="p-6">

                @if(strlen($search) < 2)

                    <p class="text-center text-gray-500">
                    Ketik minimal 2 karakter untuk mencari.
                    </p>

                    @else

                    @if($books->count())

                    <h3 class="font-semibold text-gray-700 mb-2">
                        📚 Buku
                    </h3>

                    @foreach($books as $book)

                    <div class="p-3 rounded-lg hover:bg-gray-100">
                        <div class="font-medium">
                            {{ $book->title }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $book->author }}
                        </div>
                    </div>

                    @endforeach

                    @endif


                    @if($users->count())

                    <h3 class="font-semibold text-gray-700 mt-5 mb-2">
                        👤 Pengguna
                    </h3>

                    @foreach($users as $user)

                    <div class="p-3 rounded-lg hover:bg-gray-100">
                        <div class="font-medium">
                            {{ $user->name }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $user->email }}
                        </div>
                    </div>

                    @endforeach

                    @endif


                    @if(!$books->count() && !$users->count())

                    <p class="text-center text-gray-500">
                        Tidak ditemukan hasil.
                    </p>

                    @endif

                    @endif

            </div>

            <div class="border-t px-4 py-3 text-xs text-gray-400 flex justify-between">

                <span>ESC untuk menutup</span>

                <span>Ctrl + K untuk membuka</span>

            </div>

        </div>

    </div>
    @endif
</div>