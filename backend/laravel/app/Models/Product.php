<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'product_table'; // Add this line
    protected $primaryKey = 'product_id'; // Ensure this matches
    protected $fillable = ['product_name', 'product_type', 'product_parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Product::class, 'product_parent_id');
    }
}