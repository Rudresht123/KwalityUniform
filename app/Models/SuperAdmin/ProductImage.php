<?php

namespace App\Models\SuperAdmin;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'product_image_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'product_image_id',
        'product_id',
        'file_id',
        'sort_order',
        'is_primary'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->product_image_id) {
                $model->product_image_id = (string) Str::uuid();
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    /**
     * Get image URL directly.
     */
    public function getUrlAttribute()
    {
        return $this->file ? $this->file->url : asset('images/no_image.png');
    }
}
