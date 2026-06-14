<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Record extends Model
{
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && empty($model->created_by)) {
                $model->created_by = Auth::id();
            }

            if (Auth::check() && empty($model->updated_by)) {
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    // Scope Method

   public function scopeSearch($query, ?array $filters = [])
{
    // Select columns if provided
    if (!empty($filters['columns'])) {
        $query->select($filters['columns']);
        unset($filters['columns']);
    }

    if(!empty($filters)){
    foreach ($filters as $field => $value) {

        if (blank($value)) {
            continue;
        }

        if (is_array($value) && isset($value['operator'])) {

            $operator = $value['operator'];
            $searchValue = $value['value'] ?? null;

            match ($operator) {
                'like' => $query->where($field, 'LIKE', "%{$searchValue}%"),
                'in'   => $query->whereIn($field, $searchValue),
                '>='   => $query->where($field, '>=', $searchValue),
                '<='   => $query->where($field, '<=', $searchValue),
                '='    => $query->where($field, $searchValue),
                default => null,
            };

        } else {

            $query->where($field, $value);
        }
    }
    }

    return $query;
}
}
