<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = [
        'name', 'description'
    ];

    public function activities() {
        $this->hasMany('App\Activity');
    }

    public function types() {
        $this->belongsToMany('App\Types');
    }
}
