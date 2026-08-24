<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // =========================
    // MANAJEMEN BUKU
    // =========================

    Route::view('/books', 'books.index')
        ->name('books');


    // =========================
    // MANAJEMEN KATEGORI
    // =========================

    Route::get('/categories', function () {
        return view('categories.index');
    })->name('categories');


    // =========================
    // MANAJEMEN USER
    // =========================

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');


    // =========================
    // PROFILE
    // =========================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // =========================
    // TEST N+1
    // =========================

    Route::get('/test-n1', function () {

        $queries = [];

        \Illuminate\Support\Facades\DB::listen(function ($query) use (&$queries) {
            $queries[] = [
                'sql' => $query->sql,
                'time' => $query->time,
            ];
        });

        $books = \App\Models\Book::with('category')->get();

        $result = [];

        foreach ($books as $book) {
            $result[] = [
                'title' => $book->title,
                'category' => $book->category?->name ?? 'Tanpa Kategori',
            ];
        }

        return response()->json([
            'total_queries' => count($queries),
            'queries' => $queries,
            'data' => $result,
        ]);
    });


    // =========================
    // TEST CACHE
    // =========================

    Route::get('/test-cache', function () {

        $queries = [];

        \Illuminate\Support\Facades\DB::listen(function ($query) use (&$queries) {
            $queries[] = [
                'sql' => $query->sql,
                'time' => $query->time,
            ];
        });

        $categories = \Illuminate\Support\Facades\Cache::remember(
            'book_categories',
            600,
            function () {
                return \App\Models\Category::orderBy('name')->get();
            }
        );

        return response()->json([
            'total_queries' => count($queries),
            'queries' => $queries,
            'total_categories' => $categories->count(),
            'data' => $categories,
        ]);
    });

});

require __DIR__ . '/auth.php';