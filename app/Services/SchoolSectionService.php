<?php

namespace App\Services;

use App\Models\SuperAdmin\SchoolSection;
use Illuminate\Support\Facades\DB;

class SchoolSectionService
{
    public function getSectionsForSchool(string $schoolId)
    {
        return SchoolSection::where('school_id', $schoolId)->latest()->get();
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
