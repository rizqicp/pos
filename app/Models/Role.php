<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = "roles";
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function user() {
        return $this->belongsToMany(User::class);
    }
}
