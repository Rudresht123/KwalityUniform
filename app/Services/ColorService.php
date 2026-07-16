<?php

namespace App\Services;

use App\Models\SuperAdmin\Color;
use Illuminate\Support\Facades\DB;

class ColorService
{
    public function getAllColors($vendorId = null)
    {
        $query = Color::latest();
        if ($vendorId) {
            $query->forVendor($vendorId);
        }
        return $query;
    }

    public function createColor(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Color::create($data);
        });
    }

    public function updateColor(Color $color, array $data)
    {
        return DB::transaction(function () use ($color, $data) {
            $color->update($data);
            return $color;
        });
    }

    public function deleteColor(Color $color)
    {
        return DB::transaction(function () use ($color) {
            return $color->delete();
        });
    }
}
