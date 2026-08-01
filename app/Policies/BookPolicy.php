<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Semua role boleh melihat daftar buku
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('books.view');
    }

    /**
     * Semua role yang memiliki permission view boleh melihat detail buku
     */
    public function view(User $user, Book $book): bool
    {
        return $user->hasPermission('books.view');
    }

    /**
     * Hanya role yang memiliki permission create
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('books.create');
    }

    /**
     * Hanya role yang memiliki permission update
     */
    public function update(User $user, Book $book): bool
    {
        return $user->hasPermission('books.update');
    }

    /**
     * Hanya role yang memiliki permission delete
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->hasPermission('books.delete');
    }
}