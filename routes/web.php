<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Livewire\BookManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/books', 'books.index')->name('books');

    Route::get('/categories', function () {
        return view('categories.index');
    })->name('categories');


    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
