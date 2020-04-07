<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];

    public function activities() {
        return $this->hasMany('App\Activity');
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
