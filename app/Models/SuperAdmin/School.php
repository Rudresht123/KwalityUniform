<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Database\Factories\SchoolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class School extends Record
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'school_id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'user_id',
        'school_name',
        'principal_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'affiliation_no',
        'logo_url',
        'is_active',
        'created_by',
        'updated_by'
    ];

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
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Generate UUID for new schools.
         */
        static::creating(function ($model) {
            if (!$model->school_id) {
                $model->school_id = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'school_id';
    }

    /**
     * Factory instance for the model.
     */
    protected static function newFactory()
    {
        return SchoolFactory::new();
    }

    /**
     * Get the classes for the school.
     */
    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'school_id', 'school_id');
    }

    /**
     * Scope a query to only include active schools.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the user associated with the school.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who created the school.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who updated the school.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
