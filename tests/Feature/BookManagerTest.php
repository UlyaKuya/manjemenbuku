<?php

namespace Tests\Feature;

use App\Livewire\BookManager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolePermissionSeeder;

class BookManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }

    public function test_book_manager_dapat_di_render(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->assertStatus(200);
    }

    public function test_petugas_dapat_membuat_buku(): void
    {
        $user = User::factory()->create();

        $user->assignRole('petugas');

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->call('create')
            ->set('title', 'Buku Testing Laravel')
            ->set('author', 'Penulis Test')
            ->set('publisher', 'Penerbit Test')
            ->set('year', '2025')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('books', [
            'title' => 'Buku Testing Laravel',
            'author' => 'Penulis Test',
            'publisher' => 'Penerbit Test',
            'year' => 2025,
        ]);
    }

    public function test_member_tidak_dapat_membuat_buku(): void
    {
        $user = User::factory()->create();

        $user->assignRole('member');

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->call('create')
            ->assertForbidden();
    }

    public function test_petugas_dapat_mengubah_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $book = \App\Models\Book::factory()->create([
            'title' => 'Judul Lama',
            'author' => 'Penulis Lama',
            'publisher' => 'Penerbit Lama',
            'year' => 2020,
        ]);

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->call('edit', $book->id)
            ->set('title', 'Judul Baru')
            ->set('author', 'Penulis Baru')
            ->set('publisher', 'Penerbit Baru')
            ->set('year', '2025')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Judul Baru',
            'author' => 'Penulis Baru',
            'publisher' => 'Penerbit Baru',
            'year' => 2025,
        ]);
    }

    public function test_member_tidak_dapat_mengubah_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        $book = \App\Models\Book::factory()->create([
            'title' => 'Judul Asli',
            'author' => 'Penulis Asli',
            'publisher' => 'Penerbit Asli',
            'year' => 2020,
        ]);

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->call('edit', $book->id)
            ->assertForbidden();
    }

    public function test_admin_dapat_menghapus_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $book = \App\Models\Book::factory()->create();

        $this->assertTrue(
            $user->can('delete', $book)
        );

        $book->delete();

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_member_tidak_dapat_menghapus_buku(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        $book = \App\Models\Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->call('confirmDelete', $book->id)
            ->assertForbidden();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }

    public function test_validasi_buku_menolak_data_kosong(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('title', '')
            ->set('author', '')
            ->set('publisher', '')
            ->set('year', '')
            ->call('save')
            ->assertHasErrors([
                'title',
                'author',
                'publisher',
                'year',
            ]);
    }
    public function test_validasi_buku_menolak_data_tidak_valid(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('title', 'AB')
            ->set('author', 'AB')
            ->set('publisher', 'AB')
            ->set('year', '25')
            ->call('save')
            ->assertHasErrors([
                'title' => 'min',
                'author' => 'min',
                'publisher' => 'min',
                'year' => 'digits',
            ]);
    }

    public function test_data_buku_valid_lolos_validasi(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('title', 'Buku Valid')
            ->set('author', 'Penulis Valid')
            ->set('publisher', 'Penerbit Valid')
            ->set('year', '2025')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('books', [
            'title' => 'Buku Valid',
            'author' => 'Penulis Valid',
            'publisher' => 'Penerbit Valid',
            'year' => 2025,
        ]);
    }

    public function test_pencarian_buku_berdasarkan_judul(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        \App\Models\Book::factory()->create([
            'title' => 'Belajar Laravel 12',
            'author' => 'Penulis A',
            'publisher' => 'Penerbit A',
            'year' => 2025,
        ]);

        \App\Models\Book::factory()->create([
            'title' => 'Belajar PHP',
            'author' => 'Penulis B',
            'publisher' => 'Penerbit B',
            'year' => 2024,
        ]);

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('search', 'Laravel')
            ->assertSee('Belajar Laravel 12')
            ->assertDontSee('Belajar PHP');
    }

    public function test_pencarian_buku_berdasarkan_penulis(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        \App\Models\Book::factory()->create([
            'title' => 'Buku A',
            'author' => 'J.K. Rowling',
            'publisher' => 'Penerbit A',
            'year' => 2020,
        ]);

        \App\Models\Book::factory()->create([
            'title' => 'Buku B',
            'author' => 'Tere Liye',
            'publisher' => 'Penerbit B',
            'year' => 2021,
        ]);

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('search', 'Rowling')
            ->assertSee('Buku A')
            ->assertDontSee('Buku B');
    }

    public function test_pencarian_buku_berdasarkan_penerbit(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        \App\Models\Book::factory()->create([
            'title' => 'Buku A',
            'author' => 'Penulis A',
            'publisher' => 'Gramedia',
            'year' => 2020,
        ]);

        \App\Models\Book::factory()->create([
            'title' => 'Buku B',
            'author' => 'Penulis B',
            'publisher' => 'Erlangga',
            'year' => 2021,
        ]);

        $this->actingAs($user);

        Livewire::test(BookManager::class)
            ->set('search', 'Gramedia')
            ->assertSee('Buku A')
            ->assertDontSee('Buku B');
    }

    public function test_user_belum_login_tidak_dapat_mengakses_halaman_buku(): void
    {
        $response = $this->get('/books');

        $response->assertRedirect('/login');
    }
    public function test_user_login_dapat_mengakses_halaman_buku(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->assignRole('member');

        $this->actingAs($user);

        $response = $this->get('/books');

        $response->assertStatus(200);
    }
}
