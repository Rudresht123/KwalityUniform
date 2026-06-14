<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\LogsAllActivity;

#[Fillable(['business_name', 'owner_name', 'email', 'phone', 'address', 'city', 'state', 'pincode', 'gstin', 'pan_number', 'bank_account_no', 'ifsc_code', 'commission_rate', 'status', 'logo_url', 'is_active', 'created_by', 'updated_by'])]
class Vendor extends Record
{
    use HasFactory, SoftDeletes;

      protected static function newFactory()
    {
        return VendorFactory::new();
    }

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'vendor_id';

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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'commission_rate' => 'decimal:2',
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
         * Generate UUID for new vendors.
         */
        static::creating(function ($model) {
            if (!$model->vendor_id) {
                $model->vendor_id = Str::uuid();
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
        return 'vendor_id';
    }

    /**
     * Scope a query to only include approved vendors.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include pending vendors.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include suspended vendors.
     */
    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    /**
     * Check if vendor is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
