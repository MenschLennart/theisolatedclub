<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = [
        'name', 'description'
    ];

    public function activities() {
        return $this->hasMany('App\Activity');
    }

    public function types() {
        return $this->belongsToMany(Type::class);
    }
}
