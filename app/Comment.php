<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'subject', 'text', 'activity_id', 'user_id', 'reply_to'
    ];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
