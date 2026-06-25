<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ProductApprovalHistory extends Record
{
    use HasFactory;

    protected $table = 'product_approval_histories';
    protected $primaryKey = 'history_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'history_id',
        'product_id',
        'action_type',
        'old_status',
        'new_status',
        'remarks',
        'performed_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->history_id) {
                $model->history_id = (string) Str::uuid();
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
