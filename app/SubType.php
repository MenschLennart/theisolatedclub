<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function activities() {
        $this->belongsTo('App\Type');
    }
}
