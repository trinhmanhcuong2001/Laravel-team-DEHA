<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'thumb',
        'status',
        'old_price',
        'sale_price',
        'status',
    ];

    public function path($imageName)
    {
        return asset(Storage::url('uploads/product/' . $imageName));
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['category']) && $filters['category'] !== 'all') {
            $query->whereHas('categories', function ($query) use ($filters) {
                $query->where('category_id', $filters['category']);
            });
        }

        if (isset($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', 'like', '%'.$filters['status'].'%');
        }

        if (isset($filters['key'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['key'] . '%')
                    ->orWhere('sale_price', 'like', '%' . $filters['key'] . '%');
            });
        }
    }
}
