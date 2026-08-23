<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}