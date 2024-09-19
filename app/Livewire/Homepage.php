<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Homepage extends Component
{
    use WithPagination;
    #[Url]
    public $selected_categories = [];
    #[Url]
    public $selected_brands = [];

    #[Url]
    public $searchTerm = '';

    #[Url]
    public $price_range = 0;
    #[Url]
    public $nicotine_range = 0;

    #[Url]
    public $highest_price = 0;
    #[Url]
    public $highest_nicotine = 0;

    public function mount() {
        $this->highest_price = Product::max('price');
        $this->highest_nicotine = Product::max('nicotine');
    }

    public function render()
    {
        $productQuery = Product::query()->where("is_active", 1);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn("category_id", $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn("brand_id", $this->selected_brands);
        }

        if (!empty($this->searchTerm)) {
            $productQuery->where("name", 'like', '%' . $this->searchTerm . '%');
        }

        if($this->price_range) {
            $productQuery->whereBetween('price',[0,$this->price_range]);
        }
        if($this->nicotine_range) {
            $productQuery->whereBetween('nicotine',[0,$this->nicotine_range]);
        }
        
        return view('livewire.homepage', [
            'products' => $productQuery->paginate(8),
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
