<?php

namespace App\Services;

use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\ParentCategory;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::with('parentCategory')->latest();
    }

    public function getActiveParents()
    {
        return ParentCategory::active()->get();
    }

    public function createCategory(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Category::create($data);
        });
    }

    public function updateCategory(Category $category, array $data)
    {
        return DB::transaction(function () use ($category, $data) {
            $category->update($data);
            return $category;
        });
    }

    public function deleteCategory(Category $category)
    {
        return DB::transaction(function () use ($category) {
            return $category->delete();
        });
    }
}
