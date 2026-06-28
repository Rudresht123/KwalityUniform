<?php

namespace App\Services;

use App\Models\SuperAdmin\SchoolSection;
use Illuminate\Support\Facades\DB;

class SchoolSectionService
{
    public function getSectionsForStandard(string $standardId)
    {
        return SchoolSection::where('school_standard_id', $standardId)->latest()->get();
    }

    public function createSection(array $data)
    {
        return DB::transaction(function () use ($data) {
            return SchoolSection::create($data);
        });
    }

    public function deleteSection(SchoolSection $section)
    {
        return DB::transaction(function () use ($section) {
            return $section->delete();
        });
    }
}
