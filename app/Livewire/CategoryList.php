<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::paginate(10);

        return view('livewire.category-list', [
            'categories' => $categories
        ]);
    }
}
