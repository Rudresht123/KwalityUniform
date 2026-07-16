<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsAllActivity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SchoolClass extends Record
{
    use HasFactory, SoftDeletes, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'school_classes';

    protected $fillable = ['school_id', 'class_name', 'is_active', 'created_by', 'updated_by'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }
}
