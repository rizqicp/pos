<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "category";
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}
