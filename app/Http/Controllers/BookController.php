<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Book;


class BookController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Book::class);

        $books = Book::latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $this->authorize('view', $book);

        return view('books.show', compact('book'));
    }

    public function store()
    {
        $this->authorize('create', Book::class);

        // Contoh penggunaan Policy untuk aksi create
    }

    public function update(Book $book)
    {
        $this->authorize('update', $book);

        // Contoh penggunaan Policy untuk aksi update
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        // Contoh penggunaan Policy untuk aksi delete
    }
}
