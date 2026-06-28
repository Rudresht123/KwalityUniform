<?php

namespace App\Services;

use App\Models\SuperAdmin\Size;
use Illuminate\Support\Facades\DB;

class SizeService
{
    public function getAllSizes()
    {
        return Size::latest();
    }

    public function createSize(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Size::create($data);
        });
    }

    public function updateSize(Size $size, array $data)
    {
        return DB::transaction(function () use ($size, $data) {
            $size->update($data);
            return $size;
        });
    }

    public function deleteSize(Size $size)
    {
        return DB::transaction(function () use ($size) {
            return $size->delete();
        });
    }
}
