<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name', 'product_type', 'product_parent_id'];

    public function parent()
    {
        return $this->belongsTo(Product::class, 'product_parent_id', 'product_id');
    }

    public function children()
    {
        return $this->hasMany(Product::class, 'product_parent_id', 'product_id');
    }
}