<?php

namespace App\Services;

use App\Models\SuperAdmin\SchoolStandard;
use App\Models\SuperAdmin\SchoolSection;
use Illuminate\Support\Facades\DB;

class SchoolStandardService
{
    public function getAllStandards()
    {
        return SchoolStandard::latest();
    }

    public function createStandard(array $data)
    {
        return DB::transaction(function () use ($data) {
            return SchoolStandard::create($data);
        });
    }

    public function updateStandard(SchoolStandard $standard, array $data)
    {
        return DB::transaction(function () use ($standard, $data) {
            $standard->update($data);
            return $standard;
        });
    }

    public function deleteStandard(SchoolStandard $standard)
    {
        return DB::transaction(function () use ($standard) {
            return $standard->delete();
        });
    }

    public function getStandardsForSchool(string $schoolId)
    {
        return SchoolStandard::where('school_id', $schoolId)->latest()->get();
    }
}
