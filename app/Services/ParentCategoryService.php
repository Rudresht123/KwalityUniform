<?php

namespace App\Services;

use App\Models\SuperAdmin\ParentCategory;
use Illuminate\Support\Facades\DB;

class ParentCategoryService
{
    public function getAllParentCategories()
    {
        return ParentCategory::active()->latest();
    }

    public function createParentCategory(array $data)
    {
        return DB::transaction(function () use ($data) {
            return ParentCategory::create($data);
        });
    }

    public function updateParentCategory(ParentCategory $parentCategory, array $data)
    {
        return DB::transaction(function () use ($parentCategory, $data) {
            $parentCategory->update($data);
            return $parentCategory;
        });
    }

    public function deleteParentCategory(ParentCategory $parentCategory)
    {
        return DB::transaction(function () use ($parentCategory) {
            return $parentCategory->delete();
        });
    }
}
