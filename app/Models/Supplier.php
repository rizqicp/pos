<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $table = "supplier";
    public $timestamps = false;

    protected $fillable = [
        'name', 'phone', 'address'
    ];

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}
