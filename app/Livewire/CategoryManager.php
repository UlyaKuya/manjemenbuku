<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CategoryManager extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $categoryId = null;

    public ?int $deleteId = null;

    public bool $isEdit = false;

    #[Validate('required|min:3')]
    public string $name = '';

    public function render()
    {
        $categories = Category::query()
            ->withCount('books')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('name')
            ->paginate(5);

        return view('livewire.category-manager', compact('categories'));
    }

    public function create(): void
    {
        $this->authorize('create', Category::class);

        $this->reset([
            'categoryId',
            'name',
        ]);

        $this->isEdit = false;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->isEdit) {
            $category = Category::findOrFail($this->categoryId);

            $this->authorize('update', $category);

            $category->update([
                'name' => $this->name,
            ]);

            session()->flash('success', 'Kategori berhasil diperbarui.');
        } else {
            $this->authorize('create', Category::class);

            Category::create([
                'name' => $this->name,
            ]);

            session()->flash('success', 'Kategori berhasil ditambahkan.');
        }

        $this->reset([
            'categoryId',
            'name',
        ]);

        $this->isEdit = false;
        $this->showModal = false;
    }

    public function edit(int $categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        $this->authorize('update', $category);

        $this->categoryId = $category->id;
        $this->name = $category->name;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function confirmDelete(int $categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        $this->authorize('delete', $category);

        $this->deleteId = $category->id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $category = Category::findOrFail($this->deleteId);

        $this->authorize('delete', $category);

        $category->delete();

        $this->deleteId = null;
        $this->showDeleteModal = false;

        $this->resetPage();

        session()->flash('success', 'Kategori berhasil dihapus.');
    }

    public function closeModal(): void
    {
        $this->reset([
            'categoryId',
            'name',
        ]);

        $this->isEdit = false;
        $this->showModal = false;
    }

    public function closeDeleteModal(): void
    {
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }
}
