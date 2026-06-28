<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'schools';
    protected $primaryKey = 'school_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->school_id)) {
                $model->school_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    protected $fillable = [
        'school_id',
        'school_name',
        'principal_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'is_active',
        'user_id',
        'school_type_id',
        'school_board_id',
        'created_by',
        'updated_by',
        'image_id',
    ];

    public function file()
    {
        return $this->belongsTo(\App\Models\File::class, 'image_id');
    }

    public function schoolType()
    {
        return $this->belongsTo(SchoolType::class, 'school_type_id');
    }

    public function board()
    {
        return $this->belongsTo(SchoolBoard::class, 'school_board_id');
    }

    public function standards(): HasMany
    {
        return $this->hasMany(SchoolStandard::class, 'school_id', 'school_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
