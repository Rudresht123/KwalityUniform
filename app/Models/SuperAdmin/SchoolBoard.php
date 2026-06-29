<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolBoard extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class, 'school_board_id');
    }
}
