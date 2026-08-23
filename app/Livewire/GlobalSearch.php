<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\User;
use Livewire\Component;

class GlobalSearch extends Component
{
    public bool $open = false;

    public string $search = '';

    public function openSearch(): void
    {
        $this->open = true;
    }

    public function closeSearch(): void
    {
        $this->open = false;
        $this->search = '';
    }

    public function render()
    {
        $books = collect();
        $users = collect();

        if (strlen($this->search) >= 2) {

            $books = Book::query()
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('author', 'like', "%{$this->search}%")
                ->limit(5)
                ->get();

            $users = User::query()
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->limit(5)
                ->get();
        }

        return view('livewire.global-search', [
            'books' => $books,
            'users' => $users,
        ]);
    }
}
