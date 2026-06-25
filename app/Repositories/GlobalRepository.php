<?php
namespace App\Repositories;

use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\ParentCategory;
use App\Models\SuperAdmin\Vendor;

class GlobalRepository
{
    public function vendors($search = null)
    {
        return Vendor::orderBy('business_name')->search($search)->get();
    }

      public function category($search = null)
    {
        return ParentCategory::query()->search($search)->get();
    }

      public function subcategory($search = null)
    {
        return Category::query()->search($search)->get();
    }
}
?>
