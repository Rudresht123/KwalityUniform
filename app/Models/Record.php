<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogsAllActivity;

class Record extends Model
{
    use LogsAllActivity;

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

    public function scopeSearch($query, array $filters = [])
    {
        foreach ($filters as $field => $filter) {
            // Ignore empty values
            if ($filter === null || $filter === '') {
                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | Relation Support
        |--------------------------------------------------------------------------
        */

            if (str_contains($field, '.')) {
                [$relation, $column] = explode('.', $field, 2);

                $query->whereHas($relation, function ($q) use ($column, $filter) {
                    if (is_array($filter) && isset($filter['operator'])) {
                        $operator = strtolower($filter['operator']);

                        switch ($operator) {
                            case 'like':
                                $q->where($column, 'LIKE', "%{$filter['value']}%");
                                break;

                            default:
                                $q->where($column, $filter['operator'], $filter['value']);
                        }
                    } else {
                        $q->where($column, $filter);
                    }
                });

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | whereIn
        |--------------------------------------------------------------------------
        */

            if (is_array($filter) && array_is_list($filter)) {
                $query->whereIn($field, $filter);
                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | Between
        |--------------------------------------------------------------------------
        */

            if (is_array($filter) && isset($filter['from']) && isset($filter['to'])) {
                $query->whereBetween($field, [$filter['from'], $filter['to']]);

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | Operators
        |--------------------------------------------------------------------------
        */

            if (is_array($filter) && isset($filter['operator'])) {
                switch (strtolower($filter['operator'])) {
                    case 'like':
                        $query->where($field, 'LIKE', "%{$filter['value']}%");
                        break;

                    case 'null':
                        $query->whereNull($field);
                        break;

                    case 'not_null':
                        $query->whereNotNull($field);
                        break;

                    default:
                        $query->where($field, $filter['operator'], $filter['value']);
                }

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | Default Where
        |--------------------------------------------------------------------------
        */

            $query->where($field, $filter);
        }

        return $query;
    }
}
