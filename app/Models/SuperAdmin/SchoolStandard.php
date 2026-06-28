<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsAllActivity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SchoolStandard extends Record
{
    use HasFactory, SoftDeletes, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'school_standards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['school_id', 'standard_name', 'is_active', 'created_by', 'updated_by', 'user_id'];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the school that owns the standard.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    /**
     * Get the product approvals associated with this standard.
     */
    public function productApprovals()
    {
        return $this->hasMany(SchoolProductStandardApproval::class, 'standard_id', 'id');
    }

    /**
     * Get the sections associated with this standard.
     */
    public function sections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SchoolSection::class, 'standard_id', 'id');
    }

    /**
     * Get the product assignments associated with this standard.
     */
    public function productAssignments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductAssignment::class, 'standard_id', 'id');
    }
}
