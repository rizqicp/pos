<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'supplier_id', 'name', 'description', 'buy_price', 'sell_price', 'quantity', 'image'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function transaction() {
        return $this->belongsToMany(Transaction::class);
    }
}
