<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReturnReason extends Model
{
    protected $table = 'return_reasons';

    protected $fillable = [
        'reason_text',
    ];

    public function returns(): HasMany
    {
        return $this->hasMany(\App\Models\OrderReturn::class, 'return_reason_id');
    }
}
