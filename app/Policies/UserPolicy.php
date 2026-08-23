<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Melihat daftar user
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('users.view');
    }

    /**
     * Melihat detail user
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasPermission('users.view');
    }

    /**
     * Membuat user
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('users.create');
    }

    /**
     * Mengubah user
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasPermission('users.update');
    }

    /**
     * Menghapus user
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('users.delete');
    }
}