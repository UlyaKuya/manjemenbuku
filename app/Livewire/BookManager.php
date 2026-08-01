<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class BookManager extends Component

{
    use WithPagination;

    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $deleteId = null;

    public ?int $bookId = null;

    public bool $isEdit = false;

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
        $books = Book::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('author', 'like', "%{$this->search}%")
                        ->orWhere('publisher', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(3);

        return view('livewire.book-manager', compact('books'));
    }

    public function create()
    {
        $this->reset([
            'bookId',
            'title',
            'author',
            'publisher',
            'year',
        ]);

        $this->isEdit = false;
        $this->showModal = true;
    }





    public function save()
    {
        $this->validate();

        if ($this->isEdit) {

            Book::findOrFail($this->bookId)->update([
                'title' => $this->title,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'year' => $this->year,
            ]);

            session()->flash('success', 'Buku berhasil diperbarui.');
        } else {

            Book::create([
                'title'     => $this->title,
                'author'    => $this->author,
                'publisher' => $this->publisher,
                'year'      => $this->year,
            ]);

            session()->flash('success', 'Buku berhasil ditambahkan.');
        }

        $this->reset([
            'bookId',
            'title',
            'author',
            'publisher',
            'year',
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

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function confirmDelete(Book $book)
    {
        $this->deleteId = $book->id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Book::findOrFail($this->deleteId)->delete();

        $this->deleteId = null;
        $this->showDeleteModal = false;

        // Reset ke halaman yang valid
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
