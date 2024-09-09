<?php

namespace App\Livewire\Partials;

use App\Models\Category;
use Livewire\Component;

class SubNav extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.partials.sub-nav', ['categories'=> $categories]);
    }
}
