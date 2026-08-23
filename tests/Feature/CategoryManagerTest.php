<?php

namespace Tests\Feature;

use App\Livewire\CategoryManager;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryManagerTest extends TestCase
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

    public function test_category_manager_dapat_di_render(): void
    {
        $user = User::factory()->create();

        $user->assignRole('member');

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->assertStatus(200);
    }
    public function test_petugas_dapat_membuat_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->call('create')
            ->set('name', 'Teknologi')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'name' => 'Teknologi',
        ]);
    }

    public function test_member_tidak_dapat_membuat_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->call('create')
            ->assertForbidden();
    }
    public function test_petugas_dapat_mengubah_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $category = \App\Models\Category::create([
            'name' => 'Teknologi',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->call('edit', $category->id)
            ->set('name', 'Teknologi Informasi')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Teknologi Informasi',
        ]);
    }

    public function test_member_tidak_dapat_mengubah_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        $category = \App\Models\Category::create([
            'name' => 'Teknologi',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->call('edit', $category->id)
            ->assertForbidden();
    }
    public function test_admin_dapat_menghapus_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $category = \App\Models\Category::create([
            'name' => 'Teknologi',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->set('deleteId', $category->id)
            ->set('showDeleteModal', true)
            ->call('delete')
            ->assertSet('deleteId', null)
            ->assertSet('showDeleteModal', false);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
    public function test_member_tidak_dapat_menghapus_kategori(): void
    {
        $user = User::factory()->create();
        $user->assignRole('member');

        $category = \App\Models\Category::create([
            'name' => 'Teknologi',
        ]);

        $this->actingAs($user);

        Livewire::test(CategoryManager::class)
            ->call('confirmDelete', $category->id)
            ->assertForbidden();

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_user_belum_login_tidak_dapat_mengakses_halaman_kategori(): void
    {
        $response = $this->get('/categories');

        $response->assertRedirect('/login');
    }
}
