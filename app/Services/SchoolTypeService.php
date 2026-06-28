<?php

namespace App\Services;

use App\Models\SuperAdmin\SchoolType;
use Illuminate\Support\Facades\DB;

class SchoolTypeService
{
    public function getAllSchoolTypes()
    {
        return SchoolType::where('is_active', true)->get();
    }

    public function createSchoolType(array $data)
    {
        return DB::transaction(function () use ($data) {
            return SchoolType::create($data);
        });
    }

    public function updateSchoolType(SchoolType $schoolType, array $data)
    {
        return DB::transaction(function () use ($schoolType, $data) {
            $schoolType->update($data);
            return $schoolType;
        });
    }

    public function deleteSchoolType(SchoolType $schoolType)
    {
        return DB::transaction(function () use ($schoolType) {
            return $schoolType->delete();
        });
    }
}
