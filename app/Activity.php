<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'title', 'content', 'link', 'category_id', 'type_id', 'user_id',
    ];

    public function type() {
        return $this->belongsTo('App\Type');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
