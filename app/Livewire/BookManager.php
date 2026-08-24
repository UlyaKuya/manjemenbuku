<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class BookManager extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $deleteId = null;

    public ?int $bookId = null;

    public bool $isEdit = false;

    public ?int $category_id = null;

    #[Validate('required|min:3')]
    public string $title = '';

    #[Validate('required|min:3')]
    public string $author = '';

    #[Validate('required|min:3')]
    public string $publisher = '';

    #[Validate('required|digits:4')]
    public string $year = '';

    public function render()
    {
        $books = Book::with('category')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('author', 'like', "%{$this->search}%")
                        ->orWhere('publisher', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(3);

        $categories = Category::orderBy('name')->get();

        return view('livewire.book-manager', compact(
            'books',
            'categories'
        ));
    }

    public function create()
    {
        $this->authorize('create', Book::class);

        $this->reset([
            'bookId',
            'title',
            'author',
            'publisher',
            'year',
            'category_id',
        ]);

        $this->isEdit = false;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {

            $book = Book::findOrFail($this->bookId);

            $this->authorize('update', $book);

            $book->update([
                'title' => $this->title,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'year' => $this->year,
                'category_id' => $this->category_id,
            ]);

            session()->flash('success', 'Buku berhasil diperbarui.');

        } else {

            $this->authorize('create', Book::class);

            Book::create([
                'title' => $this->title,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'year' => $this->year,
                'category_id' => $this->category_id,
            ]);

            session()->flash('success', 'Buku berhasil ditambahkan.');
        }

        $this->reset([
            'bookId',
            'title',
            'author',
            'publisher',
            'year',
            'category_id',
        ]);

        $this->isEdit = false;
        $this->showModal = false;
    }

    public function edit(Book $book)
    {
        $this->bookId = $book->id;

        $this->title = $book->title;
        $this->author = $book->author;
        $this->publisher = $book->publisher;
        $this->year = $book->year;
        $this->category_id = $book->category_id;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function confirmDelete(int $bookId)
    {
        $book = Book::findOrFail($bookId);

        $this->authorize('delete', $book);

        $this->deleteId = $book->id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $book = Book::findOrFail($this->deleteId);

        $this->authorize('delete', $book);

        $book->delete();

        $this->deleteId = null;
        $this->showDeleteModal = false;

        $this->resetPage();

        session()->flash('success', 'Buku berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->reset([
            'bookId',
            'title',
            'author',
            'publisher',
            'year',
            'category_id',
        ]);

        $this->isEdit = false;
        $this->showModal = false;
    }

    public function closeDeleteModal()
    {
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }
}