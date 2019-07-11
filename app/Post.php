<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['img_filename', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favorite_users() {
      return $this->belongsToMany(User::class, 'favorites', 'favorite_postid', 'user_id')->withTimestamps();
    }
}
