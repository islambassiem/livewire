<?php

namespace App\Livewire;

use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public ?Category $category = null;

    public string $name = '';
    public string $slug = '';

    public bool $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function updatedName(): void
    {
        $this->slug = Str::slug($this->name);
    }

    public function save()
    {
        $this->validate();
        Category::create($this->only('name', 'slug'));
        $this->reset('showModal');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['nullable', 'string'],
        ];
    }
    public function render()
    {
        $categories = Category::paginate(10);

        return view('livewire.category-list', [
            'categories' => $categories
        ]);
    }
}
